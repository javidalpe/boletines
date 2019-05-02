<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invite
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite pending()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property int $used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereUserId($value)
 */
class Invite extends Model
{
    protected $fillable =[
        'email',
        'used'
    ];

    /**
     * Get the user that owns the alert.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopePending($query)
    {
        return $query->where('used', 0);
    }

}
