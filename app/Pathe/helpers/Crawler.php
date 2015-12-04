<?php
namespace Pathe\Helpers;

use Pathe\Models\Theater;
use Pathe\Models\Movie;
use Pathe\Models\Show;
use Pathe\Models\Log;

class Crawler {

  public static $BASE_URL = "http://www.pathe.nl";

  public static function getTheaters()
  {
    $html = htmlqp(self::$BASE_URL . "/bioscoopagenda");

    // rows to get data from each theater
    $cities = $html->find(".module-filter dt");
    $theaterContainer = $html->find(".module-filter dd");

    foreach($cities as $key => $city)
    {
      $city = str_replace("')", "", str_replace("Linkable('/bioscoopagenda/", "", $city->attr("onclick")));
      $rows = $theaterContainer->eq($key)->find("ul li a");

      foreach($rows as $row)
      {
        $name = $row->text();
        $alias = str_replace("/bioscoopagenda?cinema=", "", $row->attr("href"));
        $city = $city;

        // store object of theater
      	$theater = new Theater;
      	$theater->name = $name;
      	$theater->alias = $alias;
        $theater->city = $city;
      	$theater->save();
      }
    }
  }

  public static function getShows($theater, $date)
  {
    $html = htmlqp(self::$BASE_URL . "/bioscoop/". $theater->alias ."/". $date);
    $rows = $html->find(".overview-movies .schedule-movie");

    $date = date("Y-m-d", strtotime($date));

    foreach($rows as $row)
    {
        $movie = self::getMovie($row);
        $duration = self::calculateMinutes($row);

        $times = $row->find(".table-schedule .table-btn");

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

    // store log of succesful Crawl
    $log = new Log;
    $log->theater_id = $theater->id;
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
