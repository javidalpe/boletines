<?php

namespace App\Console\Commands;

use App\Services\Alerts\AlertsCheckService;
use Illuminate\Console\Command;

class CheckAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerts:checks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks all alerts and send emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $service = new AlertsCheckService();
        $service->checkAllAlerts();
    }
}
