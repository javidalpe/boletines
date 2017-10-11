<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'user_id', 'alerts_limit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the alerts for the account.
     */
    public function alerts()
    {
        return $this->hasMany('App\Alert');
    }

    /**
     * Get the invites for the account.
     */
    public function invitees()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the user that invites the user.
     */
    public function inviter()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
