<?php

namespace App\Listeners;

use App\Alert;
use App\Events\AlertCreated;
use App\Notifications\AlertCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertCreatedEventListener
{
    /**
     * AlertCreatedEventListener constructor.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  AlertCreated  $event
     * @return void
     */
    public function handle(AlertCreated $event)
    {
        $event->alert->user->notify(new AlertCreatedNotification($event->alert));
    }
}
