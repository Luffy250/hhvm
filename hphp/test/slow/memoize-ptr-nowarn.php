<?hh

function foo(int $a) { echo "foo($a)\n"; }
class A { static function b(int $a) { echo "A::b($a)\n"; } }

<<__Memoize>>
function memo_fptr($func, int $x) {
  var_dump($func);
  $func($x);
}

<<__Memoize>>
function memo_cptr($cptr, int $x) {
  var_dump($cptr);
  $cptr($x);
}

<<__EntryPoint>>
function main() {
  memo_fptr(foo<>, 1);
  memo_fptr(__hhvm_intrinsics\launder_value(foo<>), 2);

  memo_fptr(foo<>, 1);
  memo_fptr(__hhvm_intrinsics\launder_value(foo<>), 2);

  memo_fptr('foo', 1);
  memo_fptr(__hhvm_intrinsics\launder_value('foo'), 2);

  memo_fptr('foo', 1);
  memo_fptr(__hhvm_intrinsics\launder_value('foo'), 2);

  memo_cptr(A::b<>, 3);
  memo_cptr(__hhvm_intrinsics\launder_value(A::b<>), 4);

  memo_cptr(A::b<>, 3);
  memo_cptr(__hhvm_intrinsics\launder_value(A::b<>), 4);

  memo_cptr(varray[A::class, 'b'], 3);
  memo_cptr(__hhvm_intrinsics\launder_value(varray[A::class, 'b']), 4);

  memo_cptr(varray[A::class, 'b'], 3);
  memo_cptr(__hhvm_intrinsics\launder_value(varray[A::class, 'b']), 4);
}
