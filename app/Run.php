<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class Run extends Model
{
    /**
     * Get the user that owns the phone.
     */
    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }
}
