<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
