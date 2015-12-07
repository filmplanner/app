<?php

  use Pathe\Models\Day;
  use Pathe\Models\Theater;
  use Pathe\Models\Movie;
  use Pathe\Models\Planning;
  use Pathe\Models\Result;
  use Pathe\Helpers\Crawler;
  use Pathe\Helpers\GoogleAPIHelper;

  $app->get("/getDays", function() {
    echo Day::all();
  });

  $app->get("/getTheaters", function() {
    echo Theater::all()->groupBy("city")->toJson();
  });

  $app->post("/getMovies", function() use ($app) {
    $data = json_decode($app->request->getBody());
    echo Movie::getByTheaterAndDate($data, $app);
  });

  $app->post("/makePlanning", function() use ($app) {
    $data = json_decode($app->request->getBody());
    echo Planning::get($data->theaters, $data->date, $data->movies);
  });

  $app->get("/getResult/:id", function($id) {
    echo Result::find($id)->toJson();
  });

  $app->get("/test", function() {
    echo Crawler::getTheaters();
  });
