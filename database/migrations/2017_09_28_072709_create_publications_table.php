<?php

use App\Publication;
use App\Services\ScrapingService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->integer('id')->primary('id');
            $table->string('name');
            $table->integer('priority');
            $table->string('last_run_result')->nullable();
            $table->datetime('last_run_at')->nullable();
            $table->datetime('last_success_run_at')->nullable();
            $table->timestamps();
        });

        $seeder = new PublicationsTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}
