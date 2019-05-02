<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Webhook
 *
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property string $status
 * @property string|null $last_notification_at
 * @property int|null $last_notification_response_code
 * @property string|null $last_notification_response_body
 * @property string|null $last_notification_request_body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereLastNotificationAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereLastNotificationRequestBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereLastNotificationResponseBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereLastNotificationResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Webhook whereUserId($value)
 * @mixin \Eloquent
 */
class Webhook extends Model
{
    const STATUS_OK = 'ok';
    const STATUS_WARNING = 'warning';
    const STATUS_ERROR = 'error';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    protected $dates = [
        'last_notification_at',
        'checked_at',
        'created_at',
        'updated_at'
    ];
}
