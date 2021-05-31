<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Alert
 *
 * @property int $id
 * @property int $user_id
 * @property string $query
 * @property \Illuminate\Support\Carbon|null $notified_at
 * @property \Illuminate\Support\Carbon|null $checked_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $frequency
 * @property string|null $email
 * @property string $time
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereNotifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $publication_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Alert wherePublicationId($value)
 * @property-read \App\Publication|null $publication
 */
class Alert extends Model
{
	use Notifiable;

    const FREQUENCY_DAILY = "daily";
    const FREQUENCY_WEEKLY = "weekly";
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'notified_at',
        'checked_at',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'query',
        'frequency',
	    'email',
	    'time',
	    'publication_id',
    ];

    /**
     * Get the user that owns the alert.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function publication()
	{
		return $this->belongsTo('App\Publication');
	}
}
