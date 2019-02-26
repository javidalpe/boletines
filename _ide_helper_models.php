<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
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
 */
	class Alert extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $free_alerts
 * @property string $token
 * @property int|null $user_id
 * @property string|null $remember_token
 * @property string|null $improvement
 * @property string|null $feature
 * @property string|null $useful
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Alert[] $alerts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $invitees
 * @property-read \App\User|null $inviter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invite[] $invites
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFreeAlerts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImprovement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUseful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserId($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Publication
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property string|null $last_run_result
 * @property \Carbon\Carbon|null $last_run_at
 * @property \Carbon\Carbon|null $last_success_run_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereLastRunAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereLastRunResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereLastSuccessRunAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication query()
 */
	class Publication extends \Eloquent {}
}

namespace App{
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
	class Invite extends \Eloquent {}
}

namespace App{
/**
 * App\Run
 *
 * @property int $id
 * @property int $publication_id
 * @property int $new_files
 * @property float $duration
 * @property string $result
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Publication $publication
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run whereNewFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Run query()
 */
	class Run extends \Eloquent {}
}

namespace App{
/**
 * App\Chunk
 *
 * @property int $id
 * @property string $url
 * @property string $content
 * @property string $publication_name
 * @property int $publication_priority
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk wherePublicationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk wherePublicationPriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereUrl($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk query()
 */
	class Chunk extends \Eloquent {}
}

