<?php

  use Pathe\Models\Day;
  use Pathe\Models\Theater;
  use Pathe\Models\Movie;
  use Pathe\Models\Planning;
  use Pathe\Models\Result;
  use Pathe\Helpers\Crawler;

  $app->get("/getDays", function() {
    echo Day::all();
  });

  $app->get("/getTheaters", function() {
    echo Theater::all()->toJson();
  });

  $app->get("/getMovies/:theater/:date", function($theater, $date) use ($app) {
    echo Movie::getByTheaterAndDate($theater, $date, $app);
  });

  $app->post("/makePlanning", function() use ($app) {
    $data = json_decode($app->request->getBody());
    echo Planning::get($data->theaterId, $data->date, $data->movies);
  });

  $app->get("/getResult/:id", function($id) {
    echo Result::find($id)->toJson();
  });

  $app->get("/crawlTheaters", function() {
    echo Crawler::getTheaters();
  });
