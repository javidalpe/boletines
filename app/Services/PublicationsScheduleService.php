<?php


namespace App\Services;


use Carbon\Carbon;

class PublicationsScheduleService
{
	public function isTodayAPublicationDay($administrativeLevel) {
		$now = Carbon::now();

		if ($administrativeLevel == ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1) {
			return $now->isWeekday();
		}

		if ($administrativeLevel == ScrapingService::PRIORITY_NATIONAL) {
			return $now->isWeekday() || $now->dayOfWeek == Carbon::SATURDAY;
		}

		return false;
	}
}