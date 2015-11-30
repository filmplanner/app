<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require '../vendor/autoload.php';
require 'database.php';

$app = new \Slim\Slim();

$app->db = function() {
  return new Capsule;
};

require 'routes.php';

$app->run();
