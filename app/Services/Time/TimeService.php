<?php


namespace App\Services\Time;


use Carbon\Carbon;

class TimeService
{

	public static function dayStamp(Carbon $when)
	{
		return $when->year*1000 + $when->dayOfYear;
	}

	public static function weekStamp(Carbon $when)
	{
		return $when->year*100 + $when->weekOfYear;
	}
}
