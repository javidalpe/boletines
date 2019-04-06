<?php

use App\Publication;
use App\Services\ScrapingService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBorneToPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $publications = Publication::where('priority', '>', 0)
            ->orderBy('id', 'desc')->get();
        foreach ($publications as $publication) {
            $publication->id = $publication->id + 1;
            $publication->save();
        }

	    $seeder = new BormeSeeder();
	    $seeder->run();
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function down()
    {
		Publication::find(ScrapingService::BOLETIN_OFICIAL_DEL_REGISTRO_MERCANTIL)
			->delete();

        $publications = Publication::where('priority', '>', 0)
	        ->orderBy('id', 'asc')->get();
        foreach ($publications as $publication) {
	        $publication->id = $publication->id - 1;
	        $publication->save();
        }
    }
}
