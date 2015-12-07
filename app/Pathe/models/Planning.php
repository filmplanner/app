<?php

namespace Pathe\Models;
use Pathe\Models\Movie;
use Pathe\Models\Show;
use Pathe\Helpers\ArrayHelper;

class Planning
{
  public static function get($theaters, $date, $movies)
  {
    // Set IN array for query
    foreach($theaters as $theater) $theaterIds[] = $theater->id;

    foreach($movies as $movie)
    {
      // get all shows of movie by theaters and date
      $array[] = Show::with("movie")
                        ->with("theater")
                        ->whereIn("theater_id", $theaterIds)
                        ->where("date", date("Y-m-d", strtotime($date)))
                        ->where("movie_id", $movie->id)
                        ->whereRaw('CONCAT(date, " ", start) > NOW()')
                        ->orderByRaw('start asc')
                        ->get()->toArray();
    }

    // get all combinations between shows (cartesian product)
    $cartesianProduct = ArrayHelper::getCartesianProductOf($array);

    // get all possible combinations of shows
    $combinations = self::getCombinations($cartesianProduct);

    if(count($combinations) < 1) return false;

    // sort by show amount and waittime
    $combinations = ArrayHelper::orderBy($combinations, "amount", SORT_DESC, "waittime", SORT_ASC);

    // get best 5 combinations
    $data = array_slice($combinations, 0, 5, true);

    // store result
    $result = new Result;
    $result->data = json_encode($data);
    $result->save();

    return $result->id;
  }

  private static function getCombinations($arrays)
  {
    $results = array();

    foreach($arrays as $shows)
    {
      // sort array by show start
      $shows = ArrayHelper::orderBy($shows, "start", SORT_ASC);

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
      if($result["amount"] > 1 && !ArrayHelper::multiSearch($result["id"], $results)) {
        $results[] = $result;
      }
    }
    return $results;
  }

  private static function checkTimes($array, $index = 0)
  {
    $array[$index]["waittime"] = 0;
    $array[$index]["traveltime"] = 0;

    if(array_key_exists($index + 1, $array) && is_array($array[$index + 1])) {
        // get next show in array
        $next = $array[$index + 1];
        $end = $array[$index]["end"];

        // check for distance between theaters
        $theaterFrom = $array[$index]["theater"];
        $theaterTo = $next["theater"];
        $distanceExists = Distance::where(function ($query) use($theaterFrom, $theaterTo) {
                            $query->where('from_id', $theaterFrom["id"])
                                  ->where('to_id', $theaterTo["id"]);
                            })
                            ->orWhere(function ($query) use($theaterFrom, $theaterTo) {
                            $query->where('from_id', $theaterTo["id"])
                                  ->where('to_id', $theaterFrom["id"]);
                            })->first();

        if($distanceExists != null) {
          $array[$index]["traveltime"] = $distanceExists->minutes;
          $array[$index]["nextTheater"] = $next["theater"]["name"];
          $end =  date("H:i:s", strtotime('+ '.((int)$distanceExists->minutes).' minutes', strtotime($array[$index]["end"])));
        }

        // check if show time does not overlap
        if($next["start"] < $end || $array[$index]["start"] > date("H:i:s", strtotime('- '.((int)$array[$index]["duration"]).' minutes', strtotime($next["start"])))) {
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

  private static function getWaitTime($end, $start)
  {
    $end = new \DateTime("2015-11-28 " . $end);
    $start = new \DateTime("2015-11-28 " . $start);

    $minutes = ($start->diff($end)->format("%h%") * 60) + $start->diff($end)->format("%i%");

    return $minutes;
  }

}
