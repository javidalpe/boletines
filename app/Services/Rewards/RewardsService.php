<?php

namespace App\Services\Rewards;

use App\Notifications\InvitationRewardNotification;
use App\User;
use Log;

class RewardsService
{

    const REWARD_INVITATION = 0;

    public function rewardUser(User $user, $type)
    {
        Log::debug(sprintf("Added alert to %s due to reward type %s", $user->email, $type));
        $user->alerts_limit = $user->alerts_limit + 1;
        $user->save();

        switch ($type)
        {
            case self::REWARD_INVITATION:
                $user->notify(new InvitationRewardNotification());
                break;
            default:
                break;
        }
    }
}