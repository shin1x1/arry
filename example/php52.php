<?php
require_once dirname(dirname(__FILE__)).'/Arry.php';

arr()
  ->push(array('name' => 'Tigers', 'win' => 68, 'lose' => 70))
  ->push(array('name' => 'Dragons', 'win' => 75, 'lose' => 59))
  ->push(array('name' => 'Giants', 'win' => 71, 'lose' => 62))
  ->push(array('name' => 'Swallows', 'win' => 70, 'lose' => 59))
  ->push(array('name' => 'Carp', 'win' => 60, 'lose' => 76))
  ->push(array('name' => 'Baystars', 'win' => 47, 'lose' => 86))
  ->map(function($v) {
    $v['percent'] = $v['win'] / ($v['win'] + $v['lose']);
    return $v;
  })->usort(function($v1, $v2) {
    return $v1['percent'] < $v2['percent'] ? 1 : -1;
  })->walk(function($v, $k) {
    $no = $k + 1;
    printf("%d. %-10s %02d %02d %.3f\n", $no, $v['name'], $v['win'], $v['lose'], $v['percent']);
  });
