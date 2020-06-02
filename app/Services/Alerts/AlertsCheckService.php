<?php

namespace App\Services\Alerts;

use App\Alert;
use App\Chunk;
use App\Notifications\MultipleAlertNotification;
use App\Publication;
use App\Services\Time\TimeService;
use App\User;
use Carbon\Carbon;
use Log;
use Notification;


class AlertsCheckService
{

	public static function getPublicationsSearchOptions()
	{
		$publicationsArray = Publication::all();
		$hash[''] = 'Buscar en los 65 boletines';
		foreach ($publicationsArray as $publication) {
			$hash[$publication->id] = $publication->name;
		}
		return $hash;
	}

    public function checkAllAlerts()
    {
        /***
         * @var AlertResult[]
         */
        $newContentPerUser = [];

        $alerts = Alert::with('user')
	        ->get();

        foreach ($alerts as $alert) {

            if (!$this->isDayToCheck($alert)) {
                continue;
            }

            $alertSearchResult = $this->searchReturnsNewContent($alert);
            if ($alertSearchResult) {
                $newContentPerUser = $this->addAlertToUser($alertSearchResult, $newContentPerUser);
            }
        }

        foreach ($newContentPerUser as $userId => $alertsResults) {
            $this->notifyAlertsToUser($alertsResults, $userId);
        }
    }

    /**
     * @param Alert $alert
     * @return AlertResult|null
     */
    private function searchReturnsNewContent(Alert $alert)
    {
    	if ($alert->frequency === Alert::FREQUENCY_DAILY) {
		    $count = $this->getSearchChunksCountForToday($alert);
	    } else {
		    $count = $this->getSearchChunksCountForAWeek($alert);
	    }

    	if ($count === 0) {
    	    return null;
        }

    	return new AlertResult($count, $alert);
    }

    /**
     * @param AlertResult $alertSearchResult
     * @param $alertsPerUser
     * @return mixed
     */
    private function addAlertToUser(AlertResult $alertSearchResult, $alertsPerUser)
    {
        $userId = $alertSearchResult->getAlert()->user->id;
        if (isset($alertsPerUser[$userId])) {
            array_push($alertsPerUser[$userId], $alertSearchResult);
        } else {
            $alertsPerUser[$userId] = [$alertSearchResult];
        }
        return $alertsPerUser;
    }

    /**
     * @param AlertResult[] $alertsResults
     * @param $userId
     */
    private function notifyAlertsToUser($alertsResults, $userId)
    {
        $userToNotify = User::find($userId);

        $userToNotify->notify(new MultipleAlertNotification($alertsResults));
        foreach ($alertsResults as $alertResult) {
            $alert = $alertResult->getAlert();
            $this->markAlertAsNotified($alert);
        }
    }

    /**
     * @param Alert $alert
     * @return int
     */
    private function getSearchChunksCountForToday(Alert $alert): int
    {
        $now = Carbon::now();

        $alert->checked_at = $now;
        $alert->save();

        $daystamp = TimeService::dayStamp($now);

	    $query = $this->getSearchQueryForAlert($alert);
	    $chunks = $query->where('daystamp', $daystamp)
            ->get();

        return count($chunks);
    }

	/**
	 * @param Alert $alert
	 * @return int
	 */
	private function getSearchChunksCountForAWeek(Alert $alert): int
	{
		$now = Carbon::now();

		$alert->checked_at = $now;
		$alert->save();

		$pastWeek = $now->addDays(-2);
		$weekStamp = TimeService::weekStamp($pastWeek);

		$query = $this->getSearchQueryForAlert($alert);
		$chunks = $query->where('weekstamp', $weekStamp)
			->get();

		return count($chunks);
	}


    /**
     * @param Alert $alert
     */
    private function markAlertAsNotified(Alert $alert)
    {
        $alert->notified_at = Carbon::now();
        $alert->save();
    }

	/**
	 * @param Alert $alert
	 *
	 * @return bool
	 */
	private function isDayToCheck(Alert $alert)
	{
		if ($alert->frequency === Alert::FREQUENCY_DAILY) {
			return true;
		}

		$now = Carbon::now();
		return $now->dayOfWeek === Carbon::MONDAY;
	}

	/**
	 * @param Alert $alert
	 *
	 * @return \Laravel\Scout\Builder
	 */
	private function getSearchQueryForAlert(Alert $alert): \Laravel\Scout\Builder
	{
		$query = Chunk::search($alert->query);
		if ($alert->publication_id !== null) {
			$query = $query->where('publication_id', $alert->publication_id);
		}
		return $query;
	}

}

class AlertResult
{
    /***
     * @var int
     */
    public $fragments;
    /***
     * @var Alert
     */
    public $alert;

    /**
     * AlertResult constructor.
     * @param int $fragments
     * @param Alert $alert
     */
    public function __construct(int $fragments, Alert $alert)
    {
        $this->fragments = $fragments;
        $this->alert = $alert;
    }

    /**
     * @return int
     */
    public function getFragments(): int
    {
        return $this->fragments;
    }

    /**
     * @return Alert
     */
    public function getAlert(): Alert
    {
        return $this->alert;
    }

    /***
     * @return string
     */
    public function getFrequency()
    {
        return $this->alert->frequency;
    }

    /***
     * @return string
     */
    public function getQuery()
    {
        return $this->alert->query;
    }

}
