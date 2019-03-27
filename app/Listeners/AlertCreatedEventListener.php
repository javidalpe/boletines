<?php

namespace App\Listeners;

use App\Alert;
use App\Events\AlertCreated;
use App\Notifications\AlertCreatedNotification;
use App\Services\Invitations\InvitationService;
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
        $this->computeMemberGetMember($event->alert);
    }

    private function computeMemberGetMember(Alert $alert)
    {
        $service = new InvitationService();
        $user = $alert->user;
        $service->computeNewAlert($user);
    }
}
