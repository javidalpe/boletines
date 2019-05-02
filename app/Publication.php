<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class Publication extends Model
{
    public $incrementing = false;

    protected $dates = [
        'last_run_at',
        'last_success_run_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
