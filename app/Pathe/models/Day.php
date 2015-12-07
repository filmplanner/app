<?php

namespace Pathe\Models;
use Pathe\Helpers\DayHelper;

class Day
{
  public static $amountOfDays = 7;

  public static function all()
  {
    for($i = 0; $i < self::$amountOfDays; $i ++) {
			$object = new Day();
			$object->date = date("d-m-Y", strtotime("+".$i." day"));
			$dateTranslate = DayHelper::translate($i);
      $object->translation =  $dateTranslate->translation;
      $object->short = $dateTranslate->short;
			$days[] = $object;
		}
		return json_encode($days);
  }
}
