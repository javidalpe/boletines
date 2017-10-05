<?php

namespace App\Services\Invitations;

use App\Services\Rewards\RewardsService;
use App\User;
use Log;

class InvitationService
{
    public function computeInvite(User $user)
    {
        Log::debug(sprintf("Compute invite on %s", $user->email));
        if ($user->inviter) {
            $service = new RewardsService;
            $service->rewardUser($user->inviter, RewardsService::REWARD_INVITATION);
        }
    }
}