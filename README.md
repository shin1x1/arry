arry
=====

method chain inteface for PHP array

method chain
---------------------
<pre>
$ret = arr(range(1, 100))
  ->filter(function($v) {
  return $v % 10 == 0;
})->map(function($v) {
  return $v * 2;
})->usort(function($v1, $v2) {
  return $v1 < $v2 ? 1 : -1;
})->y();
</pre>


get($key)
---------
<pre>
$ret = arry($array)->get('1.name');
</pre>

