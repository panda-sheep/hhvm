<?hh



<<__EntryPoint>>
function main_951() {
$i = 0;
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==true) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==true) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = true;
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== true	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==false) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==false) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = false;
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== false	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 1;
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== 1	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==0) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==0) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 0;
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== 0	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==-1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==-1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = -1;
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== -1	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!=='1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !=='1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '1';
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== '1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!=='0') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !=='0') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '0';
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== '0'	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!=='-1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !=='-1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '-1';
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== '-1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==null) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==null) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = null;
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== null	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==array()) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==array()) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array();
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array()	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==varray[1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==varray[1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[1];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array(1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==varray[2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==varray[2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[2];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array(2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==varray['1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==varray['1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['1'];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array('1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==darray['0' => '1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==darray['0' => '1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['0' => '1'];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array('0' => '1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==varray['a']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==varray['a']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['a'];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array('a')	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==darray['a' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==darray['a' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array('a' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==darray['b' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==darray['b' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['b' => 1];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array('b' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1, 'b' => 2];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array('a' => 1, 'b' => 2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==varray[darray['a' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==varray[darray['a' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['a' => 1]];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array(array('a' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!==varray[darray['b' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !==varray[darray['b' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['b' => 1]];
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== array(array('b' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!=='php') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !=='php') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 'php';
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== 'php'	";
 print "\n";
 print ++$i;
 print "\t";
 print (darray['a' => 1]!=='') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = darray['a' => 1];
 print ($a !=='') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '';
 print (darray['a' => 1]!==$b) ? 'Y' : 'N';
 print ($a !==$b) ? 'Y' : 'N';
 print "\t";
 print "array('a' => 1) !== ''	";
 print "\n";
}
