<?php

namespace App\Console\Commands;

use App\Chunk;
use Illuminate\Console\Command;
use Log;

class DeleteOldChunks extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'indexes:free';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete old chunks';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$client = \Algolia\AlgoliaSearch\SearchClient::create(config('scout.algolia.id'), config('scout.algolia.secret'));
		$index = $client->initIndex(config('scout.index'));
		$searchResult = $index->search('', ['hitsPerPage' => 1]);
		$indexCount = $searchResult['nbHits'];
		$limit = config('scout.index_limit');
		$toErase = $indexCount - $limit;
        Log::debug("To erase $toErase.");
		if ($toErase > 0) {
			$lastId = Chunk::orderBy('id', 'desc')->first();
			$fromIdToErase = $lastId->id - $indexCount;
			$toIdToErase = $lastId->id - $limit;
            Log::info("Deleting $toErase records to reach $limit. From id $fromIdToErase to $toIdToErase.");
			Chunk::where('id', '>', $fromIdToErase)
				->where('id', '<=', $toIdToErase)
				->unsearchable();


		}
		return 0;
	}
}
