<?php

namespace Pathe\Models;
use Pathe\Models\Movie;
use Pathe\Models\Show;

class Planning {

 /**
 *
 * Returns array of 5 possible movie combinations
 *
 * @param     int     $theaterId Identification of selected theater
 * @param     string  $date Date of selected day
 * @param     array   $movies List of selected movies
 * @param     object  $app Instance to access db
 * @return    array
 *
 */
  public static function get($theaterId, $date, $movies)
  {
    foreach($movies as $movie)
    {
      // get all shows of movie by theater and date
      $array[] = Show::where("theater_id", $theaterId)
                        ->where("date", date("Y-m-d", strtotime($date)))
                        ->where("movie_id", $movie->id)
                        ->whereRaw('CONCAT(date, " ", start) > NOW()')
                        ->orderByRaw('start asc')
                        ->get()->toArray();
    }

    // get all combinations between shows (cartesian product)
    $cartesianProduct = self::sortByStartTime((self::getCartesianProductOf($array)));


  }

  /**
  *
  * Returns the cartesian product of a 2D array
  *
  * @param     array     $arrays 2D array of movie => shows
  * @return    array
  *
  */
  public static function getCartesianProductOf($arrays) {
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
    return $results;
  }

  public static function sortByStartTime($arrays)
  {
    foreach($result as $r) {
        foreach ($r as $key => $show) {
            $sort[$key]  = $show["start"];
        }

        array_multisort($sort, SORT_ASC, $r);
        $results[] = $r;
    }
  }
}
