<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Services\Invitations\InvitationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $service = new InvitationService();
        $service->computeInvite($event->user);
    }
}
