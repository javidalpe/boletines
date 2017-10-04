<?php

namespace App\Services\Alerts;

use App\Alert;
use App\Chunk;
use App\Notifications\AlertNotification;
use Carbon\Carbon;
use Log;
use Notification;

class AlertsCheckService
{

    public function checkAllAlerts()
    {
        $alerts = Alert::all();
        foreach ($alerts as $alert) {
            $this->checkAlert($alert);
        }
    }

    /**
     * @param Alert $alert
     */
    private function checkAlert(Alert $alert)
    {
        $now = Carbon::now();

        $alert->checked_at = $now;
        $alert->save();

        $daystamp = floor($now->timestamp / Chunk::SECONDS_IN_A_DAY);

        $chuncks = Chunk::search($alert->query)
            ->where('daystamp', $daystamp)
            ->get();

        if (count($chuncks) <= 0) return;

        $emails = json_decode($alert->emails);

        if (!$emails || count($emails) <= 0) return;

        $alert->notified_at = Carbon::now();
        $alert->save();

        foreach ($emails as $email) {
            Notification::route('mail', $email)
                ->notify(new AlertNotification($alert));
        }
    }
}