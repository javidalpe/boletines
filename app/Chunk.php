<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Chunk extends Model
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

	/**
	 * Get the index name for the model.
	 *
	 * @return string
	 */
	public function searchableAs()
	{
		return 'chunks_index';
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		$array = $this->toArray();
		unset($array['updated_at']);
		$array['timestamp'] = $this->published_at->timestamp;
		return $array;
	}
}
