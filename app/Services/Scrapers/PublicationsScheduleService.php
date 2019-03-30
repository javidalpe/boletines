<?php


namespace App\Services;


use App\Publication;
use Carbon\Carbon;

class PublicationsScheduleService
{
	/**
	 * @param Publication $publication
	 *
	 * @return bool
	 */
	public function isTodayAPublicationDay(Publication $publication): bool {
		$now = Carbon::now();

		switch ($publication->id) {
			case ScrapingService::BOLETIN_CASTELLON:
			case ScrapingService::BOLETIN_OFICIAL_DE_LA_REGION_DE_MURCIA:
				return $this->isMondayToStaturday($now);
			default:
				$administrativeLevel = $publication->priority;
				if ($administrativeLevel == ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1
				|| $administrativeLevel == ScrapingService::PRIORITY_PROVINCE) {
					return $now->isWeekday();
				}

				if ($administrativeLevel == ScrapingService::PRIORITY_NATIONAL) {
					return $this->isMondayToStaturday($now);
				}
				return false;
		}
	}

	/**
	 * @param $now
	 *
	 * @return bool
	 */
	private function isMondayToStaturday(Carbon $now): bool
	{
		return $now->isWeekday() || $now->dayOfWeek == Carbon::SATURDAY;
}
}
