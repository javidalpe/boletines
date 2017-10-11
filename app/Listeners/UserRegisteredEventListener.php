<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\WelcomeNotification;
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
        $user = $event->user;

        $this->welcomeUser($user);
        $this->computeInvite($user);
    }

    /**
     * @param $user
     */
    private function welcomeUser($user)
    {
        $user->notify(new WelcomeNotification());
    }

    /**
     * @param $user
     */
    private function computeInvite($user)
    {
        $service = new InvitationService();
        $service->computeInvite($user);
    }
}
