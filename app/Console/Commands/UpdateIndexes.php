<?php

namespace App\Console\Commands;

use App\Services\ScrapingService;
use Illuminate\Console\Command;

class UpdateIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indexes:update {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and parse pdfs';

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
        $service = new ScrapingService();
        $id = $this->argument('id');

        if (!$id) {
            $service->updateIndexes();
        } else {
            $service->updateIndex($id);
        }

    }
}
