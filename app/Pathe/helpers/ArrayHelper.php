<?php
namespace Pathe\Helpers;

class ArrayHelper
{
  public static function orderBy()
  {
      $args = func_get_args();
      $data = array_shift($args);
      foreach ($args as $n => $field) {
          if (is_string($field)) {
              $tmp = array();
              foreach ($data as $key => $row)
                  $tmp[$key] = $row[$field];
              $args[$n] = $tmp;
              }
      }
      $args[] = &$data;
      call_user_func_array('array_multisort', $args);
      return array_pop($args);
  }

  public static function getCartesianProductOf($arrays)
  {
    $result = array();
    $keys = array_keys($arrays);
    $reverse_keys = array_reverse($keys);
    $size = intval(count($arrays) > 0);
    foreach ($arrays as $array) {
      $size *= count($array);
    }
    for ($i = 0; $i < $size; $i ++) {
      $result[$i] = array();
      foreach ($keys as $j) {
        $result[$i][$j] = current($arrays[$j]);
      }
      foreach ($reverse_keys as $j) {
        if (next($arrays[$j])) {
          break;
        }
        elseif (isset ($arrays[$j])) {
          reset($arrays[$j]);
        }
      }
    }
    return $result;
  }

  public static function multiSearch($needle, $haystack)
  {
      if(in_array($needle, $haystack, true)) {
           return true;
      }
      foreach($haystack as $element) {
           if(is_array($element) && self::multiSearch($needle, $element))
                return true;
      }
    return false;
  }
}
