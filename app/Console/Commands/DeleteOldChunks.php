<?php

namespace App\Console\Commands;

use App\Chunk;
use Illuminate\Console\Command;

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
		$client = new \AlgoliaSearch\Client(config('scout.algolia.id'), config('scout.algolia.secret'));
		$index = $client->initIndex(config('scout.index'));
		$searchResult = $index->search('', ['hitsPerPage' => 1]);
		$indexCount = $searchResult['nbHits'];
		$limit = config('scout.index_limit');
		$toErase = $indexCount - $limit;
		$lastId = Chunk::orderBy('id', 'desc')->first();
		$fromIdToErase = $lastId->id - $indexCount;
		$toIdToErase = $lastId->id - $toErase;


		/*$actualCount = Chunk::count();
		$limit = config('scout.index_limit');
		$toErase = $actualCount - $limit;
		if ($toErase > 0) {
			$idToRemove = Chunk::orderBy('id', 'asc')->skip($toErase)->first()->id;
			Chunk::orderBy('id', 'asc')->where('id', '<', $idToRemove)->unsearchable();
		}*/
	}
}
