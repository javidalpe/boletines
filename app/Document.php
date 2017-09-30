<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	use Searchable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
