<?php

namespace App\Console\Commands;

use App\Services\ScrapingService;
use Illuminate\Console\Command;

class UpdateFromIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'indexes:from {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and parse PDF from given publication until last publication';

	private $service;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(ScrapingService $service)
	{
		parent::__construct();
		$this->service = $service;
	}


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $id = $this->argument('id');
	    $this->service->updateIndexesFrom($id);
    }
}
