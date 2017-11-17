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
        $actualCount = Chunk::count();
        $limit = config('scout.index_limit');
        $toErase = $actualCount - $limit;
        if ($toErase > 0) {
        	$idToRemove = Chunk::orderBy('id', 'asc')->skip($toErase)->first()->id;
        	Chunk::orderBy('id', 'asc')->where('id', '<', $idToRemove)->unsearchable();
        }
    }
}
