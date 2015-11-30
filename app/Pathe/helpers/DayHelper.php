<?php

namespace Pathe\Helpers;

class DayHelper {

	public static function translate($dayIndex)
	{
		$day = date("l", strtotime("+".$dayIndex." day"));

		// today & tomorrow
		if($dayIndex == 0) {
			return $translation = "Vandaag";
		} elseif($dayIndex == 1) {
			return $translation = "Morgen";
		}

		// translation day names
		switch($day) {
			case "Monday":
				$translation = "Maandag";
				break;
			case "Tuesday":
				$translation = "Dinsdag";
				break;
			case "Wednesday":
				$translation = "Woensdag";
				break;
			case "Thursday":
				$translation = "Donderdag";
				break;
			case "Friday":
				$translation = "Vrijdag";
				break;
			case "Saturday":
				$translation = "Zaterdag";
				break;
			case "Sunday":
				$translation = "Zondag";
				break;
		}

		return $translation;
	}
}
