<?php

namespace App\Services\Invitations;

use App\Services\Rewards\RewardsService;
use App\User;
use Log;

class InvitationService
{
    public function computeNewUserInvite(User $user)
    {
        $email = $user->email;
        Log::debug(sprintf("Compute invite on %s", $email));
        $inviter = $user->inviter;

        if ($inviter) {
            $service = new RewardsService;
            $service->rewardUser($user, RewardsService::INVITEE_REWARD);
            $inviter->invites()->where('email', $email)->update(['used' => true]);
        }
    }

    public function computeNewAlert(User $user)
    {
        $email = $user->email;
        Log::debug(sprintf("Compute new alert on %s", $email));
        $inviter = $user->inviter;

        if ($inviter) {
            $service = new RewardsService;
            $service->rewardUser($inviter, RewardsService::INVITER_REWARD);
        }
    }

    public function getInvitationUrl(User $user)
    {
        return route('register', ['token' => $user->token]);
    }


}
