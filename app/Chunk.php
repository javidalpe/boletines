<?php

namespace App;

use App\Services\Time\TimeService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Chunk
 *
 * @property int $id
 * @property string $url
 * @property string $content
 * @property string $publication_name
 * @property int $publication_priority
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk wherePublicationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk wherePublicationPriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk whereUrl($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chunk query()
 */
class Chunk extends Model
{
	const SECONDS_IN_A_DAY = 86400;
	const SECONDS_IN_A_WEEK = self::SECONDS_IN_A_DAY * 7;

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
		return config('scout.index');
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		$array = $this->toArray();

        unset($array['published_at']);
		unset($array['updated_at']);
        unset($array['created_at']);

		Carbon::setLocale('es');
		$now = Carbon::now();

		$array['day'] = $this->published_at->formatLocalized('%d %B %Y');
        $array['date'] = $this->published_at->format('Y-m-d');
        $array['daystamp'] = TimeService::dayStamp($now);
        $array['weekstamp'] = TimeService::weekStamp($now);

		return $array;
	}
}
