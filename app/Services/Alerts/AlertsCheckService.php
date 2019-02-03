<?php

namespace App\Services\Alerts;

use App\Alert;
use App\Chunk;
use App\Notifications\AlertNotification;
use App\Notifications\MultipleAlertNotification;
use App\Services\Time\TimeService;
use App\User;
use Carbon\Carbon;
use Log;
use Notification;

class AlertsCheckService
{

    public function checkAllAlerts()
    {
        $alertsPerUser = [];
        $alerts = Alert::with('user')
	        ->where('time', '=', Carbon::now()->format('H:i:s'))
	        ->get();

        foreach ($alerts as $alert) {
            if ($this->isDayToCheck($alert) && $this->searchReturnsNewContent($alert)) {
                $alertsPerUser = $this->addAlertToUser($alert, $alertsPerUser);
            }
        }

        foreach ($alertsPerUser as $userId => $alerts) {
            $this->notifyAlertsToUser($alerts, $userId);
        }
    }

    /**
     * @param Alert $alert
     * @return bool
     */
    private function searchReturnsNewContent(Alert $alert)
    {
    	if ($alert->frequency === Alert::FREQUENCY_DAILY) {
		    return $this->getSearchChunksCountForToday($alert) > 0;
	    } else {
		    return $this->getSearchChunksCountForAWeek($alert) > 0;
	    }

    }

    /**
     * @param $alert
     * @param $alertsPerUser
     * @return mixed
     */
    private function addAlertToUser($alert, $alertsPerUser)
    {
        $user = $alert->user;
        if (isset($alertsPerUser[$user->id])) {
            array_push($alertsPerUser[$user->id], $alert);
        } else {
            $alertsPerUser[$user->id] = array($alert);
        }
        return $alertsPerUser;
    }

    /**
     * @param $alerts
     * @param $userId
     */
    private function notifyAlertsToUser($alerts, $userId)
    {
        if (count($alerts) <= 1) {
            $alert = $alerts[0];
            $alert->user->notify(new AlertNotification($alert));
            $this->markAlertAsNotified($alert);
        } else {
            $userToNotify = User::find($userId);
            $userToNotify->notify(new MultipleAlertNotification($alerts));
            foreach ($alerts as $alert) {
                $this->markAlertAsNotified($alert);
            }
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

        $chunks = Chunk::search($alert->query)
            ->where('daystamp', $daystamp)
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

		$chunks = Chunk::search($alert->query)
			->where('weekstamp', $weekStamp)
			->get();

		return count($chunks);
	}


    /**
     * @param $alert
     */
    private function markAlertAsNotified($alert)
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

}
