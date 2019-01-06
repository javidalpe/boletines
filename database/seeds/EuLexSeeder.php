<?php

use App\Publication;
use App\Services\ScrapingService;
use Illuminate\Database\Seeder;

class EuLexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publication::insert([
            "id" => ScrapingService::DIARIO_OFICIAL_DE_LA_UNION_EUROPEA,
            "name" => "Diario Oficial de la Unión Europea",
            "priority" => ScrapingService::PRIORITY_NATIONAL
        ]);
    }
}
