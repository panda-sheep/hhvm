// Copyright (c) Facebook, Inc. and its affiliates.
//
// This source code is licensed under the MIT license found in the
// LICENSE file in the "hack" directory of this source tree.
//
// @generated SignedSource<<0b201cbac6efa5581e15ea0daf349bac>>
//
// To regenerate this file, run:
//   hphp/hack/src/oxidized/regen.sh

use ocamlrep_derive::OcamlRep;
use ocamlvalue_macro::Ocamlvalue;

use crate::file_info;
use crate::stats_container;

#[derive(Clone, Debug, OcamlRep, Ocamlvalue)]
pub struct FullFidelityParserEnv {
    pub hhvm_compat_mode: bool,
    pub php5_compat_mode: bool,
    pub codegen: bool,
    pub disable_lval_as_an_expression: bool,
    pub disable_nontoplevel_declarations: bool,
    pub mode: Option<file_info::Mode>,
    pub stats: Option<stats_container::StatsContainer>,
    pub rust: bool,
    pub disable_legacy_soft_typehints: bool,
    pub allow_new_attribute_syntax: bool,
    pub disable_legacy_attribute_syntax: bool,
    pub leak_rust_tree: bool,
}
