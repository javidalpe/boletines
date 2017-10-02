<?php

namespace App\Services\Alerts;

use App\Alert;
use App\Chunk;
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
        $chuncks = Chunk::search($alert->query)
            ->get();

        if (!$chuncks) return;

        $emails = json_decode($alert->emails);

        if (!$emails || count($emails) <= 0) return;

        foreach ($emails as $email) {
            Log::debug("Email to {$email}");
        }
    }

}