<?php


namespace App\Services\Billing;


use App\User;

class BillingService
{
	/**
	 * Returns true if the user must pay for the next alert
	 * @param User $user
	 *
	 * @return bool
	 */
	public static function shouldUserPayForNewAlert(User $user)
	{
		return $alertCount = $user->alerts()->count() >= $user->free_alerts;
	}

	/**
	 * Returns the number of billable alerts
	 *
	 * @param User $user
	 *
	 * @return int
	 */
	public static function billableAlertsCount(User $user)
	{
		return $alertCount = $user->alerts()->count() - $user->free_alerts;
	}
}
