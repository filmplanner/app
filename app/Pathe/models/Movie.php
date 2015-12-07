<?php

namespace Pathe\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Pathe\Helpers\Crawler;

class Movie extends Eloquent
{
  public $timestamps = false;
  public static $db;

  public static function getByTheaterAndDate($data, $app)
  {
    // Check if data is already available in database
    $isCrawled = Log::where("city_alias", $data->theaters[0]->city_alias)
                      ->where("date", date("Y-m-d", strtotime($data->date)))
                      ->where("created_at", 'LIKE', date('Y-m-d') . '%')->first();

    if(!$isCrawled) {
        Crawler::getShows($data->theaters, $data->date);
    }

    // Set IN array for query
    foreach($data->theaters as $theater) $theaterIds[] = $theater->id;

    // Get data from Database
    $movies = $app->db->table('shows')
                      ->select("movies.*")
                      ->join('movies', 'movies.id', '=', 'shows.movie_id')
                      ->whereIn("shows.theater_id", $theaterIds)
                      ->where("shows.date", date("Y-m-d", strtotime($data->date)))
                      ->whereRaw('CONCAT(date, " ", start) > NOW()')
                      ->groupBy('shows.movie_id')
                      ->orderByRaw('COUNT(shows.movie_id) desc')
                      ->get();

    return json_encode($movies);
  }

}
