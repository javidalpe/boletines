<?php

namespace App\Services\Invitations;

use App\Services\Rewards\RewardsService;
use App\User;
use Log;

class InvitationService
{
    public function computeInvite(User $user)
    {
        $email = $user->email;
        Log::debug(sprintf("Compute invite on %s", $email));
        $inviter = $user->inviter;

        if ($inviter) {
            $service = new RewardsService;
            $service->rewardUser($inviter, RewardsService::INVITER_REWARD);
            $service->rewardUser($user, RewardsService::INVITEE_REWARD);

            $inviter->invites()->where('email', $email)->update(['used' => true]);
        }
    }

    public function getInvitationUrl(User $user)
    {
        return route('welcome', ['token' => $user->token]);
    }
}