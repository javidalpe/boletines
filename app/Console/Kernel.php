<?php

namespace App\Console;

use App\Console\Commands\CheckAlerts;
use App\Console\Commands\DeleteOldChunks;
use App\Console\Commands\UpdateIndexes;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	const ALERTS_DAILY_TIME = '11:00';
	const SCRAP_DAILY_TIME = '09:30';
	const FREE_DAILY_TIME = '07:00';

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdateIndexes::class,
        CheckAlerts::class,
	    DeleteOldChunks::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	    $schedule->command('indexes:free')->dailyAt(self::FREE_DAILY_TIME);
	    $schedule->command('indexes:update')->dailyAt(self::SCRAP_DAILY_TIME);
	    $schedule->command('alerts:check')->dailyAt(self::ALERTS_DAILY_TIME);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
