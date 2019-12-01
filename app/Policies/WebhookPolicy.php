<?php

namespace App\Policies;

use App\User;
use App\Webhook;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebhookPolicy
{
    use HandlesAuthorization;

	public function viewAny()
	{
		return true;
	}

    /**
     * Determine whether the user can view the webhook.
     *
     * @param  \App\User  $user
     * @param  \App\Webhook  $webhook
     * @return mixed
     */
    public function view(User $user, Webhook $webhook)
    {
        return $webhook->user_id === $user->id;
    }

    /**
     * Determine whether the user can create webhooks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the webhook.
     *
     * @param  \App\User  $user
     * @param  \App\Webhook  $webhook
     * @return mixed
     */
    public function update(User $user, Webhook $webhook)
    {
        return $webhook->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the webhook.
     *
     * @param  \App\User  $user
     * @param  \App\Webhook  $webhook
     * @return mixed
     */
    public function delete(User $user, Webhook $webhook)
    {
        return $webhook->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the webhook.
     *
     * @param  \App\User  $user
     * @param  \App\Webhook  $webhook
     * @return mixed
     */
    public function restore(User $user, Webhook $webhook)
    {
        return $webhook->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the webhook.
     *
     * @param  \App\User  $user
     * @param  \App\Webhook  $webhook
     * @return mixed
     */
    public function forceDelete(User $user, Webhook $webhook)
    {
        return $webhook->user_id === $user->id;
    }
}
