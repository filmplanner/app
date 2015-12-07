<?php

namespace Pathe\Helpers;

use Pathe\Models\Theater;
use Pathe\Models\Distance;

class GoogleAPIHelper
{
  public static $key = "AIzaSyA1d-OG78XMJwl7qFuWibIzXiNxMd3E6QU";

  public static function getDistance($theaterFrom, $theaterTo)
  {
    // Formatting
    $formattedTheaterFrom = str_replace(' ','+', $theaterFrom->name . ", " . $theaterFrom->city);
    $formattedTheaterTo = str_replace(' ','+', $theaterTo->name . ", " . $theaterTo->city);

    // Get exact address
    $fromInfo = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/queryautocomplete/json?key='. self::$key .'&input='.$formattedTheaterFrom));
    $toInfo = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/queryautocomplete/json?key='. self::$key .'&input='.$formattedTheaterTo));

    // Formatted address
    $formattedTheaterFrom = str_replace(' ','+', $fromInfo->predictions[0]->description);
    $formattedTheaterTo = str_replace(' ','+', $toInfo->predictions[0]->description);

    //Send request and receive json data
    $outputFrom = json_decode(file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedTheaterFrom.'&sensor=false'));
    $outputTo = json_decode(file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedTheaterTo.'&sensor=false'));

    //Get latitude and longitude from geo data
    $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo = $outputTo->results[0]->geometry->location->lng;

    // Calculate distance from latitude and longitude
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;

    $distance = new Distance;
    $distance->from_id = $theaterFrom->id;
    $distance->to_id = $theaterTo->id;
    $distance->meters = round($miles * 1609.344);
    $distance->minutes = round($distance->meters * 0.010);

    return $distance;
  }
}
