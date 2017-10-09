<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
