<?php

use App\Publication;
use App\Services\ScrapingService;
use Illuminate\Database\Seeder;

class BormeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Publication::insert([
		    "id" => ScrapingService::BOLETIN_OFICIAL_DEL_REGISTRO_MERCANTIL,
		    "name" => "Boletín Oficial del Registro Mercantil",
		    "priority" => ScrapingService::PRIORITY_NATIONAL
	    ]);
    }
}
