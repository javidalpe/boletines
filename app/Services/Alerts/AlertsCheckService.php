<?php

namespace App\Services\Alerts;

use App\Alert;
use App\Chunk;
use App\Notifications\AlertNotification;
use App\Notifications\MultipleAlertNotification;
use App\User;
use Carbon\Carbon;
use Log;
use Notification;

class AlertsCheckService
{

    public function checkAllAlerts()
    {
        $alertsPerUser = [];
        $alerts = Alert::with('user')->get();
        foreach ($alerts as $alert) {
            if (!$this->searchReturnsNewContent($alert)) {
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
        return $this->getSearchChunksCountForToday($alert) > 0;
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

        $daystamp = (int)floor($now->timestamp / Chunk::SECONDS_IN_A_DAY);

        $chunks = Chunk::search($alert->query)
            ->where('daystamp', $daystamp)
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
}