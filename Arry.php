<?php
/**
 * Arry
 *
 * @author shin1x1 <shin1x1@gmail.com>
 */
class Arry {
  /**
   * @var array
   */
  protected $_values;

  /**
   * __construct
   *
   * @param array $values
   */
  public function __construct(array $values) {
    $this->_values = $values;
  }

  /**
   * push
   *
   * @param mixed $value
   * @return Arry
   */
  public function push($value) {
    array_push($this->_values, $value);
    return $this->returnInstance($this->_values);
  }

  /**
   * get
   *
   * @param string $key
   * @return mixed
   */
  public function get($key) {
    $keys = explode('.', $key);

    $ret = $this->_values;
    foreach ($keys as $k) {
      if (!is_array($ret)) {
        return null;
      }
      if (!array_key_exists($k, $ret)) {
        return null;
      }

      $ret = $ret[$k];
    }

    return $ret;
  }

  /**
   * exists
   *
   * @param mixed $value
   * @return boolean
   */
  public function exists($value) {
    return array_key_exists($value, $this->_values);
  }

  /**
   * filter
   *
   * @param mixed $func
   * @return Arry
   */
  public function filter($func) {
    $ret = array_filter($this->_values, $func);
    return $this->returnInstance($ret);
  }

  /**
   * map
   *
   * @param mixed $func
   * @return Arry
   */
  public function map($func) {
    $ret = array_map($func, $this->_values);
    return $this->returnInstance($ret);
  }

  /**
   * reduce
   *
   * @param mixed $func
   * @return Arry
   */
  public function reduce($func) {
    $ret = array_reduce($this->_values, $func);
    return $ret;
  }

  /**
   * walk
   *
   * @param mixed $func
   * @param mixed $option
   * @return Arry
   */
  public function walk($func, $option = null) {
    $ret = array_walk($this->_values, $func, $option);
    return $ret;
  }

  /**
   * shuffle
   *
   * @return Arry
   */
  public function shuffle() {
    shuffle($this->_values);
    return $this->returnInstance($this->_values);
  }

  /**
   * usort
   *
   * @param mixed $func
   * @return Arry
   */
  public function usort($func) {
    $values = $this->_values;
    usort($values, $func);
    return $this->returnInstance($values);
  }

  /**
   * toArray
   *
   * @return array
   */
  public function y() {
    return $this->_values;
  }

  /**
   * returnInstance
   *
   * @param array $v
   * @return Arry
   */
  protected function returnInstance(array $v) {
    $obj = new Arry($v);
    return $obj;
  }
}

/**
 * arr
 *
 * @param array $values
 * @return Arr
 */
function arr(array $values = array()) {
  $obj = new Arry($values);
  return $obj;
}
