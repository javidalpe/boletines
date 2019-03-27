<?php

namespace App\Services\Rewards;

use App\Notifications\AlertRewardNotification;
use App\Notifications\InvitationRewardNotification;
use App\User;
use Log;
use Stripe\Customer;

class RewardsService
{

    const INVITER_REWARD = 0;
    const INVITEE_REWARD = 1;
    const FEEDBACK_REWARD = 2;

    public function rewardUser(User $user, $type)
    {
        Log::debug(sprintf("Rewarding %s due to type %s", $user->email, $type));

        switch ($type)
        {
            case self::INVITER_REWARD:
                $user->notify(new AlertRewardNotification());
                $this->incrementBalance($user, config('mgm.rewards.inviter'));
                break;
            case self::INVITEE_REWARD:
                $user->notify(new InvitationRewardNotification());
                $this->incrementBalance($user, config('mgm.rewards.invitee'));
                break;
            default:
                break;
        }
    }

    private function incrementBalance(User $user, $value)
    {
        if (!$user->stripe_id) {
            return;
        }

        $customer = Customer::retrieve($user->stripe_id);
        $actualBalance = $customer->account_balance;
        Customer::update($user->stripe_id, [
            'account_balance' => $actualBalance - ($value * 100)
        ]);
    }
}
