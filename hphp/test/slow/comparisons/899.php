<?hh



<<__EntryPoint>>
function main_899() {
$i = 0;
 print ++$i;
 print "\t";
 print (array()!=true) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=true) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = true;
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != true	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=false) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=false) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = false;
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != false	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 1;
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != 1	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=0) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=0) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 0;
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != 0	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=-1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=-1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = -1;
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != -1	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!='1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !='1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '1';
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != '1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!='0') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !='0') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '0';
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != '0'	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!='-1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !='-1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '-1';
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != '-1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=null) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=null) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = null;
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != null	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=array()) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=array()) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array();
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array()	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=varray[1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=varray[1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[1];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array(1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=varray[2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=varray[2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[2];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array(2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=varray['1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=varray['1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['1'];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array('1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=darray['0' => '1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=darray['0' => '1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['0' => '1'];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array('0' => '1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=varray['a']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=varray['a']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['a'];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array('a')	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=darray['a' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=darray['a' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array('a' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=darray['b' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=darray['b' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['b' => 1];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array('b' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1, 'b' => 2];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array('a' => 1, 'b' => 2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=varray[darray['a' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=varray[darray['a' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['a' => 1]];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array(array('a' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!=varray[darray['b' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !=varray[darray['b' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['b' => 1]];
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != array(array('b' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!='php') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !='php') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 'php';
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != 'php'	";
 print "\n";
 print ++$i;
 print "\t";
 print (array()!='') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = array();
 print ($a !='') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '';
 print (array()!=$b) ? 'Y' : 'N';
 print ($a !=$b) ? 'Y' : 'N';
 print "\t";
 print "array() != ''	";
 print "\n";
}
