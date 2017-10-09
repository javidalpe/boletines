<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Chunk extends Model
{
	const SECONDS_IN_A_DAY = 86400;
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
		$array['daystamp'] = floor($this->published_at->timestamp / self::SECONDS_IN_A_DAY);
		Carbon::setLocale('es');
		$array['day'] = $this->published_at->formatLocalized('%d %B %Y');
		return $array;
	}
}
