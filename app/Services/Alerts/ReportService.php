<?php


namespace App\Services\Alerts;


use App\Alert;
use Carbon\Carbon;

class ReportService implements IReportService
{
    public function getReportUrlForAlertAtDate(Alert $alert, Carbon $date)
    {
        return route('report', ['id' => $alert, 'timestamp' => $date->timestamp]);
    }

    public function getReportUrlForTodayAlert(Alert $alert)
    {
        return $this->getReportUrlForAlertAtDate($alert, Carbon::now());
    }
}