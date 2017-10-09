<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
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
    ];

    /**
     * Get the user that owns the alert.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
