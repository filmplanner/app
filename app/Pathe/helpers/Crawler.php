<?php
namespace Pathe\Helpers;

use Pathe\Models\Theater;
use Pathe\Models\Movie;
use Pathe\Models\Show;
use Pathe\Models\Log;
use Pathe\Models\Distance;
use Pathe\Helpers\GoogleAPIHelper;

class Crawler
{
  public static $BASE_URL = "http://www.pathe.nl";

  public static function getTheaters()
  {
    $html = htmlqp(self::$BASE_URL . "/bioscoopagenda");

    // rows to get data from each theater
    $cities = $html->find(".module-filter dt");
    $theaterContainer = $html->find(".module-filter dd");

    foreach($cities as $key => $city)
    {
      $cityName = $city->text();
      $cityAlias = str_replace("')", "", str_replace("Linkable('/bioscoopagenda/", "", $city->attr("onclick")));
      $rows = $theaterContainer->eq($key)->find("ul li a");

      foreach($rows as $row)
      {
        $name = $row->text();
        $alias = str_replace("/bioscoopagenda?cinema=", "", $row->attr("href"));
        $city = $city;

        // store object of theater
      	$theater = new Theater;
      	$theater->name = $name;
      	$theater->city = $cityName;
      	$theater->alias = $alias;
        $theater->city_alias = $cityAlias;
      	$theater->save();
      }
    }

    // store distances between each theater
    $theaterCities = Theater::all()->groupBy("city");

    foreach($theaterCities as $city => $theaters)
    {
      if(count($theaters) > 1)
      {
        foreach($theaters as $theater)
        {
          $theaterFrom = $theater;
          foreach($theaters as $t)
          {
            $theaterTo = $t;
            if($theaterFrom->id != $theaterTo->id)
            {
              $distanceExists = Distance::where(function ($query) use($theaterFrom, $theaterTo) {
                                        $query->where('from_id', $theaterFrom->id)
                                              ->where('to_id', $theaterTo->id);
                                        })
                                        ->orWhere(function ($query) use($theaterFrom, $theaterTo) {
                                        $query->where('from_id', $theaterTo->id)
                                              ->where('to_id', $theaterFrom->id);
                                        })->get();
              if(count($distanceExists) < 1) {
                $distance = GoogleAPIHelper::getDistance($theaterFrom, $theaterTo);
                $distance->save();
              }
            }
          }
        }
      }
    }
  }

  public static function getShows($selectedTheaters, $date)
  {
    $cityAlias = $selectedTheaters[0]->city_alias;

    $html = htmlqp(self::$BASE_URL . "/bioscoopagenda/". $cityAlias ."?date=". $date);
    $rows = $html->find(".schedule-movie");

    $theaters = Theater::where("city_alias", $cityAlias)->get();
    $date = date("Y-m-d", strtotime($date));

    foreach($rows as $row)
    {
      $movie = self::getMovie($row);
      $duration = self::calculateMinutes($row);

      $theatersSchedule = $row->find(".table-schedule tr");

      foreach($theatersSchedule as $schedule)
      {
        $times = $schedule->find(".table-btn");
        $theater = $theaters->where("name", $schedule->find("th")->text())->first();

        foreach($times as $time)
        {
          $start = substr(trim($time->text()), 0, 5);
          $end = self::calculateEndtime($start, $duration);

          // store show object of movie
          $show = Show::where("theater_id", $theater->id)
                        ->where("movie_id", $movie->id)
                        ->where("date", $date)
                        ->where("start", $start)
                        ->where("end", $end)
                        ->first();

          if($show == null) {
            $show = new Show;
          }

          $show->movie_id = $movie->id;
          $show->theater_id = $theater->id;
          $show->date = $date;
          $show->start = $start;
          $show->end = $end;
          $show->duration = $duration;
          $show->type = ($time->find("span:nth-child(2)")->text() != null) ? trim($time->find("span:nth-child(2)")->text()) : "Normaal";
          $show->url = self::$BASE_URL . $time->attr("href");
          $show->save();
        }
      }
    }

    // store log of succesful Crawl
    $log = new Log;
    $log->city_alias = $cityAlias;
    $log->date = $date;
    $log->save();
  }

  public static function getMovie($html)
  {
    $title = $html->find(".poster img")->first()->attr("alt");

    // check if movie exists in database
    $movie = Movie::where("title", $title)->first();

    if($movie == null)
    {
      // store movie object
      $movie = new Movie;
      $movie->title = $title;
      $movie->image = $html->find(".poster img")->first()->attr("src");
      $movie->save();
    }

    return $movie;
  }

  private static function calculateMinutes($html)
  {
    $start = str_replace("Begin ", "", $html->find(".tooltip ul li:nth-child(2)")->first()->text());
    $end = str_replace("Afgelopen ", "", $html->find(".tooltip ul li:nth-child(3)")->first()->text());
    $start = new \DateTime("2015-11-28 " . $start);
    $end = ($end < $start) ? new \DateTime("2015-11-29 " . $end) : new \DateTime("2015-11-28 " . $end);

    $minutes = ($end->diff($start)->format("%h%") * 60) + $end->diff($start)->format("%i%");

    return $minutes;
  }

  private static function calculateEndtime($start, $minutes)
  {
    $start = new \DateTime("2015-11-28 " . $start);
    $start->add(new \DateInterval('PT' . $minutes . 'M'));

    return $start->format('H:i');
  }

}
