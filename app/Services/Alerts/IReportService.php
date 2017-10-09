<?php

namespace App\Services\Alerts;

use App\Alert;
use Carbon\Carbon;

interface IReportService
{
    public function getReportUrlForAlertAtDate(Alert $alert, Carbon $date);

    public function getReportUrlForTodayAlert(Alert $alert);
}