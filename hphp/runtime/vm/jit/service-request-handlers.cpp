/*
   +----------------------------------------------------------------------+
   | HipHop for PHP                                                       |
   +----------------------------------------------------------------------+
   | Copyright (c) 2010-2016 Facebook, Inc. (http://www.facebook.com)     |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
*/

#include "hphp/runtime/vm/jit/service-request-handlers.h"

#include "hphp/runtime/vm/jit/func-guard.h"
#include "hphp/runtime/vm/jit/mcgen.h"
#include "hphp/runtime/vm/jit/mc-generator.h"
#include "hphp/runtime/vm/jit/perf-counters.h"
#include "hphp/runtime/vm/jit/prof-data.h"
#include "hphp/runtime/vm/jit/service-requests.h"
#include "hphp/runtime/vm/jit/smashable-instr.h"
#include "hphp/runtime/vm/jit/translator-inline.h"
#include "hphp/runtime/vm/jit/unwind-itanium.h"

#include "hphp/runtime/vm/runtime.h"
#include "hphp/runtime/vm/treadmill.h"

#include "hphp/ppc64-asm/decoded-instr-ppc64.h"
#include "hphp/vixl/a64/decoder-a64.h"

#include "hphp/util/arch.h"
#include "hphp/util/ringbuffer.h"
#include "hphp/util/trace.h"

TRACE_SET_MOD(mcg);

namespace HPHP { namespace jit { namespace svcreq {

namespace {

/*
 * Runtime service handler that patches a jmp to the translation of u:dest from
 * toSmash.
 */
TCA bindJmp(TCA toSmash, SrcKey destSk, ServiceRequest req, TransFlags trflags,
            bool& smashed) {
  auto args = TransArgs{destSk};
  args.flags = trflags;
  auto tDest = getTranslation(args);
  if (!tDest) return nullptr;

  LeaseHolder writer(Translator::WriteLease(), destSk.func(),
                     TransKind::Profile);
  if (!writer) return tDest;

  auto const sr = mcg->srcDB().find(destSk);
  always_assert(sr);
  // The top translation may have changed while we waited for the write lease,
  // so read it again.  If it was replaced with a new translation, then bind to
  // the new one.  If it was invalidated, then don't bind the jump.
  tDest = sr->getTopTranslation();
  if (tDest == nullptr) return nullptr;

  auto codeLock = mcg->lockCode();

  if (req == REQ_BIND_ADDR) {
    auto addr = reinterpret_cast<TCA*>(toSmash);
    if (*addr == tDest) {
      // Already smashed
      return tDest;
    }
    sr->chainFrom(IncomingBranch::addr(addr));
    smashed = true;
    return tDest;
  }

  auto const isJcc = [&] {
    switch (arch()) {
      case Arch::X64: {
        x64::DecodedInstruction di(toSmash);
        return (di.isBranch() && !di.isJmp());
      }

      case Arch::ARM: {
        using namespace vixl;
        struct JccDecoder : public Decoder {
          void VisitConditionalBranch(Instruction* inst) override {
            cc = true;
          }
          bool cc = false;
        };
        JccDecoder decoder;
        decoder.Decode(Instruction::Cast(toSmash));
        return decoder.cc;
      }

      case Arch::PPC64:
        ppc64_asm::DecodedInstruction di(toSmash);
        return (di.isBranch() && !di.isJmp());
    }
    not_reached();
  }();

  if (isJcc) {
    auto const target = smashableJccTarget(toSmash);
    assertx(target);

    // Return if already smashed.
    if (target == tDest) return tDest;
    sr->chainFrom(IncomingBranch::jccFrom(toSmash));
  } else {
    auto const target = smashableJmpTarget(toSmash);
    assertx(target);

    // Return if already smashed.
    if (!target || target == tDest) return tDest;
    sr->chainFrom(IncomingBranch::jmpFrom(toSmash));
  }

  smashed = true;
  return tDest;
}

///////////////////////////////////////////////////////////////////////////////
}

TCA handleServiceRequest(ReqInfo& info) noexcept {
  FTRACE(1, "handleServiceRequest {}\n", svcreq::to_name(info.req));

  assert_native_stack_aligned();
  tl_regState = VMRegState::CLEAN; // partially a lie: vmpc() isn't synced

  if (Trace::moduleEnabled(Trace::ringbuffer, 1)) {
    Trace::ringbufferEntry(
      Trace::RBTypeServiceReq, (uint64_t)info.req, (uint64_t)info.args[0].tca
    );
  }

  TCA start = nullptr;
  SrcKey sk;
  auto smashed = false;

  switch (info.req) {
    case REQ_BIND_JMP:
    case REQ_BIND_ADDR: {
      auto const toSmash = info.args[0].tca;
      sk = SrcKey::fromAtomicInt(info.args[1].sk);
      auto const trflags = info.args[2].trflags;
      start = bindJmp(toSmash, sk, info.req, trflags, smashed);
      break;
    }

    case REQ_RETRANSLATE: {
      INC_TPC(retranslate);
      sk = SrcKey{liveFunc(), info.args[0].offset, liveResumed()};
      auto trflags = info.args[1].trflags;
      auto args = TransArgs{sk};
      args.flags = trflags;
      start = retranslate(args);
      SKTRACE(2, sk, "retranslated @%p\n", start);
      break;
    }

    case REQ_RETRANSLATE_OPT: {
      sk = SrcKey::fromAtomicInt(info.args[0].sk);
      auto transID = info.args[1].transID;
      start = retranslateOpt(sk, transID);
      SKTRACE(2, sk, "retranslated-OPT: transId = %d  start: @%p\n", transID,
              start);
      break;
    }

    case REQ_POST_INTERP_RET: {
      // This is only responsible for the control-flow aspect of the Ret:
      // getting to the destination's translation, if any.
      auto ar = info.args[0].ar;
      auto caller = info.args[1].ar;
      assertx(caller == vmfp());
      // If caller is a resumable (aka a generator) then whats likely happened
      // here is that we're resuming a yield from. That expression happens to
      // cause an assumption that we made earlier to be violated (that `ar` is
      // on the stack), so if we detect this situation we need to fix up the
      // value of `ar`.
      if (UNLIKELY(caller->resumed() &&
                   caller->func()->isNonAsyncGenerator())) {
        auto gen = frame_generator(caller);
        if (gen->m_delegate.m_type == KindOfObject) {
          auto delegate = gen->m_delegate.m_data.pobj;
          // We only checked that our delegate is an object, but we can't get
          // into this situation if the object itself isn't a Generator
          assert(delegate->getVMClass() == Generator::getClass());
          // Ok so we're in a `yield from` situation, we know our ar is garbage.
          // The ar that we're looking for is the ar of the delegate generator,
          // so grab that here.
          ar = Generator::fromObject(delegate)->actRec();
        }
      }
      Unit* destUnit = caller->func()->unit();
      // Set PC so logging code in getTranslation doesn't get confused.
      vmpc() = destUnit->at(caller->m_func->base() + ar->m_soff);
      if (ar->isFCallAwait()) {
        // If there was an interped FCallAwait, and we return via the
        // jit, we need to deal with the suspend case here.
        assert(ar->m_r.m_aux.u_fcallAwaitFlag < 2);
        if (ar->m_r.m_aux.u_fcallAwaitFlag) {
          start = mcg->ustubs().fcallAwaitSuspendHelper;
          break;
        }
      }
      sk = SrcKey{caller->func(), vmpc(), caller->resumed()};
      start = getTranslation(TransArgs{sk});
      TRACE(3, "REQ_POST_INTERP_RET: from %s to %s\n",
            ar->m_func->fullName()->data(),
            caller->m_func->fullName()->data());
      break;
    }

    case REQ_POST_DEBUGGER_RET: {
      auto fp = vmfp();
      auto caller = fp->func();
      assert(g_unwind_rds.isInit());
      vmpc() = caller->unit()->at(caller->base() +
                                  g_unwind_rds->debuggerReturnOff);
      FTRACE(3, "REQ_DEBUGGER_RET: pc {} in {}\n",
             vmpc(), fp->func()->fullName()->data());
      sk = SrcKey{fp->func(), vmpc(), fp->resumed()};
      start = getTranslation(TransArgs{sk});
      break;
    }
  }

  if (smashed && info.stub) {
    auto const stub = info.stub;
    Treadmill::enqueue([stub] { mcg->freeRequestStub(stub); });
  }

  if (start == nullptr) {
    vmpc() = sk.unit()->at(sk.offset());
    start = mcg->ustubs().interpHelperSyncedPC;
  }

  if (Trace::moduleEnabled(Trace::ringbuffer, 1)) {
    auto skData = sk.valid() ? sk.toAtomicInt() : uint64_t(-1LL);
    Trace::ringbufferEntry(Trace::RBTypeResumeTC, skData, (uint64_t)start);
  }

  tl_regState = VMRegState::DIRTY;
  return start;
}

TCA handleBindCall(TCA toSmash, ActRec* calleeFrame, bool isImmutable) {
  Func* func = const_cast<Func*>(calleeFrame->m_func);
  int nArgs = calleeFrame->numArgs();
  TRACE(2, "bindCall %s, ActRec %p\n", func->fullName()->data(), calleeFrame);
  TCA start = getFuncPrologue(func, nArgs);
  TRACE(2, "bindCall -> %p\n", start);
  if (start && !isImmutable) {
    // We dont know we're calling the right function, so adjust start to point
    // to the dynamic check of ar->m_func.
    start = funcGuardFromPrologue(start, func);
  } else {
    TRACE(2, "bindCall immutably %s -> %p\n", func->fullName()->data(), start);
  }

  if (start && !RuntimeOption::EvalFailJitPrologs) {
    LeaseHolder writer(Translator::WriteLease(), func, TransKind::Profile);
    if (!writer) return start;

    // Someone else may have changed the func prologue while we waited for
    // the write lease, so read it again.
    start = getFuncPrologue(func, nArgs);
    if (start && !isImmutable) start = funcGuardFromPrologue(start, func);

    auto codeLock = mcg->lockCode();

    if (start && smashableCallTarget(toSmash) != start) {
      assertx(smashableCallTarget(toSmash));
      TRACE(2, "bindCall smash %p -> %p\n", toSmash, start);
      smashCall(toSmash, start);

      bool is_profiled = false;
      // For functions to be PGO'ed, if their current prologues are still
      // profiling ones (living in code.prof()), then save toSmash as a
      // caller to the prologue, so that it can later be smashed to call a
      // new prologue when it's generated.
      int calleeNumParams = func->numNonVariadicParams();
      int calledPrologNumArgs = (nArgs <= calleeNumParams ?
                                 nArgs :  calleeNumParams + 1);
      auto const profData = jit::profData();
      if (profData != nullptr && mcg->code().prof().contains(start)) {
        auto rec = profData->prologueTransRec(
          func,
          calledPrologNumArgs
        );
        if (isImmutable) {
          rec->addMainCaller(toSmash);
        } else {
          rec->addGuardCaller(toSmash);
        }
        is_profiled = true;
      }

      // We need to be able to reclaim the function prologues once the unit
      // associated with this function is treadmilled-- so record all of the
      // callers that will need to be re-smashed
      //
      // Additionally for profiled calls we need to remove them from the main
      // and guard caller maps.
      if (RuntimeOption::EvalEnableReusableTC) {
        if (debug || is_profiled || !isImmutable) {
          auto metaLock = mcg->lockMetadata();
          recordFuncCaller(func, toSmash, isImmutable,
                           is_profiled, calledPrologNumArgs);
        }
      }
    }
  } else {
    // We couldn't get a prologue address. Return a stub that will finish
    // entering the callee frame in C++, then call handleResume at the callee's
    // entry point.
    start = mcg->ustubs().fcallHelperThunk;
  }

  return start;
}

TCA handleFCallAwaitSuspend() {
  assert_native_stack_aligned();
  FTRACE(1, "handleFCallAwaitSuspend\n");

  tl_regState = VMRegState::CLEAN;

  vmJitCalledFrame() = vmfp();
  SCOPE_EXIT { vmJitCalledFrame() = nullptr; };

  auto start = suspendStack(vmpc());
  tl_regState = VMRegState::DIRTY;
  return start ? start : mcg->ustubs().resumeHelper;
}

TCA handleResume(bool interpFirst) {
  assert_native_stack_aligned();
  FTRACE(1, "handleResume({})\n", interpFirst);

  if (!vmRegsUnsafe().pc) return mcg->ustubs().callToExit;

  tl_regState = VMRegState::CLEAN;

  auto sk = SrcKey{liveFunc(), vmpc(), liveResumed()};
  TCA start;
  if (interpFirst) {
    start = nullptr;
    INC_TPC(interp_bb_force);
  } else {
    start = getTranslation(TransArgs(sk));
  }

  vmJitCalledFrame() = vmfp();
  SCOPE_EXIT { vmJitCalledFrame() = nullptr; };

  // If we can't get a translation at the current SrcKey, interpret basic
  // blocks until we end up somewhere with a translation (which we may have
  // created, if the lease holder dropped it).
  while (!start) {
    INC_TPC(interp_bb);
    if (auto retAddr = HPHP::dispatchBB()) {
      start = retAddr;
      break;
    }

    assertx(vmpc());
    sk = SrcKey{liveFunc(), vmpc(), liveResumed()};
    start = getTranslation(TransArgs{sk});
  }

  if (Trace::moduleEnabled(Trace::ringbuffer, 1)) {
    auto skData = sk.valid() ? sk.toAtomicInt() : uint64_t(-1LL);
    Trace::ringbufferEntry(Trace::RBTypeResumeTC, skData, (uint64_t)start);
  }

  tl_regState = VMRegState::DIRTY;
  return start;
}

}}}
