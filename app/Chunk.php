<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Chunk extends Model
{
	//use Searchable;

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

	/**
	 * Get the index name for the model.
	 *
	 * @return string
	 */
	public function searchableAs()
	{
		return 'chunks_index';
	}
}
