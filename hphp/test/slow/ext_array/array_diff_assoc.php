<?hh

function a() {
  $array1 = array(
    "a" => "green",
    "b" => "brown",
    "c" => "blue",
    "red"
  );
  $array2 = array(
    "a" => "green",
    "yellow",
    "red"
  );

  $result = array_diff_assoc($array1, $array2);
  var_dump($result);
}

function b() {
  $array1 = varray[0, 1, 2];
  $array2 = varray["00", "01", "2"];
  $result = array_diff_assoc($array1, $array2);
  var_dump($result);
}


<<__EntryPoint>>
function main_array_diff_assoc() {
a();
b();
}
