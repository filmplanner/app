<?php

namespace Pathe\Helpers;

class DayHelper
{
	public static function translate($dayIndex)
	{
		$day = date("l", strtotime("+".$dayIndex." day"));

		$obj = new \stdClass();
		// translation day names
		switch($day) {
			case "Monday":
				$obj->translation = "Maandag";
				$obj->short = "Ma";
				break;
			case "Tuesday":
				$obj->translation = "Dinsdag";
				$obj->short = "Di";
				break;
			case "Wednesday":
				$obj->translation = "Woensdag";
				$obj->short = "Wo";
				break;
			case "Thursday":
				$obj->translation = "Donderdag";
				$obj->short = "Do";
				break;
			case "Friday":
				$obj->translation = "Vrijdag";
				$obj->short = "Vr";
				break;
			case "Saturday":
				$obj->translation = "Zaterdag";
				$obj->short = "Za";
				break;
			case "Sunday":
				$obj->translation = "Zondag";
				$obj->short = "Zo";
				break;
		}

		// today & tomorrow
		if($dayIndex == 0) {
			$obj->translation = "Vandaag";
		} elseif($dayIndex == 1) {
			$obj->translation = "Morgen";
		}

		return $obj;
	}
}
