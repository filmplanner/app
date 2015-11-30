<?php

namespace Pathe\Models;
use Pathe\Helpers\DayHelper;

class Day {

  public static $amountOfDays = 7;

  public static function all()
  {
    for($i = 0; $i < self::$amountOfDays; $i ++) {
			$object = new Day();
			$object->date = date("d-m-Y", strtotime("+".$i." day"));
			$object->translation = DayHelper::translate($i);
			$days[] = $object;
		}
		return json_encode($days);
  }
}
