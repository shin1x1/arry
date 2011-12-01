<?php
require_once dirname(__DIR__).'/Arry.php';

/**
 * Test class for Arry.
 */
class ArryTest extends PHPUnit_Framework_TestCase {
  /**
   * test_push
   */
  public function test_push() {
    $actual = arr(range(1, 5))->push(10)->y();

    $expected = array(1, 2, 3, 4, 5, 10);
    $this->assertEquals($expected, $actual);
  }

  /**
   * test_filter
   */
  public function test_filter() {
    $actual = arr(range(1, 10))->filter(function($v) {
      return $v % 2;
    })->y();

    $expected = array(
      0 => 1,
      2 => 3,
      4 => 5,
      6 => 7,
      8 => 9,
    );
    $this->assertEquals($expected, $actual);
  }

  /**
   * test_map
   */
  public function test_map() {
    $actual = arr(range(1, 5))->map(function($v) {
      return $v * 2;
    })->y();

    $expected = array(2, 4, 6, 8, 10);
    $this->assertEquals($expected, $actual);
  }

  /**
   * test_reduce
   */
  public function test_reduce() {
    $actual = arr(range(1, 5))->reduce(function($v, $total) {
      return $total += $v;
    });

    $expected = 15;
    $this->assertEquals($expected, $actual);
  }

  /**
   * test_walk
   */
  public function test_walk() {
    ob_start();

    arr(range(1, 5))->walk(function($v, $k, $option) {
      printf("[%d]=%d -- %s\n", $k, $v, $option);
    }, 'php');

    $actual = ob_get_clean();

    $expected = <<<EOT
[0]=1 -- php
[1]=2 -- php
[2]=3 -- php
[3]=4 -- php
[4]=5 -- php

EOT;
    $this->assertEquals($expected, $actual);
  }

  /**
   * test_usort
   */
  public function test_usort() {
    $actual = arr(range(1, 5))->usort(function($v1, $v2) {
      return $v1 < $v2 ? 1 : -1;
    })->y();

    $expected = array(5, 4, 3, 2, 1);
    $this->assertEquals($expected, $actual);
  }

  /**
   * test_exists
   */
  public function test_exists() {
    $values = array(
      '1' => 'A',
      '2' => 'B',
      '3' => null,
    );

    $this->assertTrue(arr($values)->exists(1));
    $this->assertTrue(arr($values)->exists(2));
    $this->assertTrue(arr($values)->exists(3));

    $this->assertFalse(arr($values)->exists(0));
    $this->assertFalse(arr($values)->exists(4));
    $this->assertFalse(arr($values)->exists(null));
  }

  /**
   * test_method_chain
   */
  public function test_method_chain() {
    $actual = arr(range(1, 100))
      ->filter(function($v) {
      return $v % 10 == 0;
    })->map(function($v) {
      return $v * 2;
    })->usort(function($v1, $v2) {
      return $v1 < $v2 ? 1 : -1;
    })->y();

    $expected = array(200, 180, 160, 140, 120, 100, 80, 60, 40, 20);
    $this->assertEquals($expected, $actual);
  }
}
