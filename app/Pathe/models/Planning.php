<?php

namespace Pathe\Models;
use Pathe\Models\Movie;
use Pathe\Models\Show;

// TODO: Algoritme drastisch sneller maken
class Planning {

 /**
 *
 * Returns id of planning result
 *
 * @param     int     $theaterId Identification of selected theater
 * @param     string  $date Date of selected day
 * @param     array   $movies List of selected movies
 * @param     object  $app Instance to access db
 * @return    id
 *
 */
  public static function get($theaterId, $date, $movies)
  {
    foreach($movies as $movie)
    {
      // get all shows of movie by theater and date
      $array[] = Show::with("movie")
                        ->with("theater")
                        ->where("theater_id", $theaterId)
                        ->where("date", date("Y-m-d", strtotime($date)))
                        ->where("movie_id", $movie->id)
                        ->whereRaw('CONCAT(date, " ", start) > NOW()')
                        ->orderByRaw('start asc')
                        ->get()->toArray();
    }

    // get all combinations between shows (cartesian product)
    $cartesianProduct = self::getCartesianProductOf($array);

    // get all possible combinations of shows
    $combinations = self::getCombinations($cartesianProduct);

    if(count($combinations) < 1) return false;

    // sort by show amount and waittime
    $combinations = self::sortByAmountAndWaittime($combinations);

    // get best 5 combinations
    $data = array_slice($combinations, 0, 5, true);

    // store result
    $result = new Result;
    $result->data = json_encode($data);
    $result->save();

    return $result->id;
  }

  /**
  *
  * Returns the cartesian product of a 2D array (default cartesian product method)
  *
  * @param     array     $arrays 2D array of movie => shows
  * @return    array
  *
  */
  private static function getCartesianProductOf($arrays)
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

  /**
  *
  * Filters out all bad combinations of shows and returns all possible combinations
  *
  * @param     array     $arrays Cartesian product of all shows of selected movies
  * @return    array
  *
  */
  private static function getCombinations($arrays)
  {
    $results = array();

    foreach($arrays as $shows)
    {
      // sort array by show start
      $shows = self::sortByStartTime($shows);

      // check if times do not overlap eachother
      $result["shows"] = self::checkTimes($shows);

      // set date, waittime and identifier
      $id = "";
      $waitTime = 0;
      foreach($result["shows"] as $show) {
          $id = $id . "M" . $show['id'];
          $waitTime += $show['waittime'];
      }

      // set result
      $result["id"] = $id;
      $result["date"] = date("d-m-Y", strtotime($result["shows"][0]["date"]));
      $result["waittime"] = $waitTime;
      $result["amount"] = count($result["shows"]);

      // put in results when amount of movies is greater then 1 and not already is in array
      if($result["amount"] > 1 && !self::search_array($result["id"], $results)) {
        $results[] = $result;
      }
    }
    return $results;
  }

  /**
  *
  * Filters out all bad combinations of shows and returns all possible combinations
  *
  * @param     array     $arrays Cartesian product of all shows of selected movies
  * @return    array
  *
  */
  private static function checkTimes($array, $index = 0)
  {
    $array[$index]["waittime"] = 0;

    if(array_key_exists($index + 1, $array) && is_array($array[$index + 1])) {
        // get next show in array
        $next = $array[$index + 1];
        // check if show time does not overlap
        if($next["start"] < $array[$index]["end"] || $array[$index]["start"] > date("H:i:s", strtotime('- '.((int)$array[$index]["duration"]).' minutes', strtotime($next["start"])))) {
            // delete next show from array
            unset($array[$index + 1]);
            $array = array_values($array);
            return self::checkTimes($array, $index);
        } else {
            // set waittime and identification
            $array[$index]["waittime"] = self::getWaitTime($array[$index]["end"], $next["start"]);

            $array = array_values($array);
            return self::checkTimes($array, $index + 1);
        }
    }

    return $array;
  }

  /**
  *
  * Sort array by start time of show
  *
  * @param     array     $array Array of shows
  * @return    array
  *
  */
  private static function sortByStartTime($array)
  {
    foreach ($array as $key => $row) {
        $sort[$key]  = $row['start'];
    }

    array_multisort($sort, SORT_ASC, $array);
    return $array;
  }

  public static function sortByAmountAndWaittime($array)
  {
    foreach ($array as $key => $row) {
      $amounts[$key] = $row["amount"];
      $waittimes[$key]  = $row["waittime"];
    }

    array_multisort($amounts, SORT_DESC, $waittimes, SORT_ASC, $array);
    return $array;
  }

  private static function getWaitTime($end, $start)
  {
    $end = new \DateTime("2015-11-28 " . $end);
    $start = new \DateTime("2015-11-28 " . $start);

    $minutes = ($start->diff($end)->format("%h%") * 60) + $start->diff($end)->format("%i%");

    return $minutes;
  }

  public static function search_array($needle, $haystack)
  {
      if(in_array($needle, $haystack, true)) {
           return true;
      }
      foreach($haystack as $element) {
           if(is_array($element) && self::search_array($needle, $element))
                return true;
      }
    return false;
 }

}
