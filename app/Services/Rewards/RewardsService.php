<?php

namespace App\Services\Rewards;

use App\Notifications\InvitationRewardNotification;
use App\User;
use Log;

class RewardsService
{

    const INVITER_REWARD = 0;
    const INVITEE_REWARD = 1;
    const FEEDBACK_REWARD = 2;

    public function rewardUser(User $user, $type)
    {
        Log::debug(sprintf("Added alert to %s due to reward type %s", $user->email, $type));
        $user->alerts_limit = $user->alerts_limit + 1;
        $user->save();

        switch ($type)
        {
            case self::INVITER_REWARD:
                $user->notify(new InvitationRewardNotification());
                break;
            default:
                break;
        }
    }
}