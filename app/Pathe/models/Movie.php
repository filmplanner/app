<?php

namespace Pathe\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Pathe\Helpers\Crawler;

class Movie extends Eloquent {

  public $timestamps = false;
  public static $db;

  public static function getByTheaterAndDate($theater, $date, $app)
  {
    $theater = Theater::where("alias", $theater)->first();

    // Check if data is already available in database
    $isCrawled = Log::where("theater_id", $theater->id)
                      ->where("date", date("Y-m-d", strtotime($date)))
                      ->where("created_at", 'LIKE', date('Y-m-d') . '%')->first();

    if(!$isCrawled) {
        Crawler::getShows($theater, $date);
    }

    // Get data from Database
    $movies = $app->db->table('shows')
                      ->select("movies.*")
                      ->join('movies', 'movies.id', '=', 'shows.movie_id')
                      ->where("shows.theater_id", $theater->id)
                      ->where("shows.date", date("Y-m-d", strtotime($date)))
                      ->whereRaw('CONCAT(date, " ", start) > NOW()')
                      ->groupBy('shows.movie_id')
                      ->orderByRaw('COUNT(shows.movie_id) desc')
                      ->get();

    return json_encode($movies);
  }

}
