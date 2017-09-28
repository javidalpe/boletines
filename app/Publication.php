<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
