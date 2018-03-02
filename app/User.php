<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $alerts_limit
 * @property string $token
 * @property int|null $user_id
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Alert[] $alerts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $invitees
 * @property-read \App\User|null $inviter
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAlertsLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $improvement
 * @property string|null $feature
 * @property string|null $util
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImprovement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUtil($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invite[] $invites
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'user_id', 'alerts_limit', 'feature', 'useful', 'improvement'
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
     * Get the alerts for the account.
     */
    public function invites()
    {
        return $this->hasMany('App\Invite');
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
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
