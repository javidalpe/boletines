<?php

namespace App\Console;

use App\Console\Commands\CheckAlerts;
use App\Console\Commands\DeleteOldChunks;
use App\Console\Commands\UpdateFromIndex;
use App\Console\Commands\UpdateIndexes;
use Artisan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	const SCRAP_DAILY_TIME = '11:30';
    const SITEMAP_GENERATION_TIME = '05:00';

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
	    UpdateIndexes::class,
	    UpdateFromIndex::class,
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
	    $schedule->command('indexes:update')
		    ->dailyAt(self::SCRAP_DAILY_TIME)
		    ->after(function () {
		        Artisan::call('indexes:free');
			    Artisan::call('alerts:checks');
		    });

        $schedule->command('sitemap:generate')
            ->dailyAt(self::SITEMAP_GENERATION_TIME);
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
