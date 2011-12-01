<?php
require_once dirname(__DIR__).'/Arry.php';

$ret = arr([1, 2, 3, 4, 5])->filter(function($v) {
  return $v % 2;
})->y();

//var_dump($ret);

arr()
  ->push(['name' => 'Tigers', 'win' => 68, 'lose' => 70])
  ->push(['name' => 'Dragons', 'win' => 75, 'lose' => 59])
  ->push(['name' => 'Giants', 'win' => 71, 'lose' => 62])
  ->push(['name' => 'Swallows', 'win' => 70, 'lose' => 59])
  ->push(['name' => 'Carp', 'win' => 60, 'lose' => 76])
  ->push(['name' => 'Baystars', 'win' => 47, 'lose' => 86])
  ->map(function($v) {
    $v['percent'] = $v['win'] / ($v['win'] + $v['lose']);
    return $v;
  })->usort(function($v1, $v2) {
    return $v1['percent'] < $v2['percent'] ? 1 : -1;
  })->walk(function($v, $k) {
    $no = $k + 1;
    printf("%d. %-10s %02d %02d %.3f\n", $no, $v['name'], $v['win'], $v['lose'], $v['percent']);
  });
