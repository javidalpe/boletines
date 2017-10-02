<?php

namespace App\Services\Alerts;

use App\Alert;
use App\Chunk;
use Carbon\Carbon;
use Log;

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
        $alert->checked_at = Carbon::now();
        $alert->save();

        $chuncks = Chunk::search($alert->query)
            ->get();

        if (!$chuncks) return;

        $emails = json_decode($alert->emails);

        if (!$emails || count($emails) <= 0) return;

        $alert->notified_at = Carbon::now();
        $alert->save();

        foreach ($emails as $email) {
            Log::debug("Email to {$email}");
        }
    }

}