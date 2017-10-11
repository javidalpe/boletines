<?php

namespace App\Listeners;

use App\Alert;
use App\Events\AlertDeleted;
use App\Notifications\AlertCreatedNotification;
use App\Notifications\AlertDeletedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertDeletedEventListener
{
    /**
     * AlertDeletedEventListener constructor.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  AlertDeleted  $event
     * @return void
     */
    public function handle(AlertDeleted $event)
    {
        $event->alert->user->notify(new AlertDeletedNotification($event->alert));
    }
}
