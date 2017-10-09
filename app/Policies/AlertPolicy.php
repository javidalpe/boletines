<?php

namespace App\Policies;

use App\User;
use App\Alert;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlertPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the alert.
     *
     * @param  \App\User  $user
     * @param  \App\Alert  $alert
     * @return mixed
     */
    public function view(User $user, Alert $alert)
    {
        //
    }

    /**
     * Determine whether the user can create alerts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->alerts()->count() < $user->alerts_limit;
    }

    /**
     * Determine whether the user can update the alert.
     *
     * @param  \App\User  $user
     * @param  \App\Alert  $alert
     * @return mixed
     */
    public function update(User $user, Alert $alert)
    {
        //
    }

    /**
     * Determine whether the user can delete the alert.
     *
     * @param  \App\User  $user
     * @param  \App\Alert  $alert
     * @return mixed
     */
    public function delete(User $user, Alert $alert)
    {
        //
    }
}
