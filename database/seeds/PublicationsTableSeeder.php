<?php

use App\Publication;
use App\Services\ScrapingService;
use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publication::insert([
            ["id" => ScrapingService::BOLETIN_OFICIAL_DEL_ESTADO, "name" => "Boletín Oficial del Estado", "priority" => ScrapingService::PRIORITY_NATIONAL],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_LA_JUNTA_DE_ANDALUCIA, "name" => "Boletín Oficial de la Junta de Andalucía", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_ARAGON, "name" => "Boletín Oficial de Aragón", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DEL_PRINCIPADO_DE_ASTURIAS, "name" => "Boletín Oficial del Principado de Asturias", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_ISLAS_BALEARES, "name" => "Boletín Oficial de Islas Baleares", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_CANARIAS, "name" => "Boletín Oficial de Canarias", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_CANTABRIA, "name" => "Boletín Oficial de Cantabria", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::DIARIO_OFICIAL_DE_CASTILLA_LA_MANCHA, "name" => "Diario Oficial de Castilla-La Mancha", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_CASTILLA_Y_LEON, "name" => "Boletín Oficial de Castilla y León", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::DIARI_OFICIAL_DE_LA_GENERALITAT_DE_CATALUNYA, "name" => "Diari Oficial de la Generalitat de Catalunya", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::DIARIO_OFICIAL_DE_EXTREMADURA, "name" => "Diario Oficial de Extremadura", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::DIARIO_OFICIAL_DE_GALICIA, "name" => "Diario Oficial de Galicia", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_LA_RIOJA, "name" => "Boletín Oficial de La Rioja", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_LA_COMUNIDAD_DE_MADRID, "name" => "Boletín Oficial de la Comunidad de Madrid", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_LA_REGION_DE_MURCIA, "name" => "Boletín Oficial de la Región de Murcia", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_NAVARRA, "name" => "Boletín Oficial de Navarra", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DEL_PAIS_VASCO, "name" => "Boletín Oficial del País Vasco", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::DIARI_OFICIAL_DE_LA_COMUNITAT_VALENCIANA, "name" => "Diari Oficial de la Comunitat Valenciana", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_CEUTA, "name" => "Boletín Oficial de la Ciudad Autónoma de Ceuta", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1],
            ["id" => ScrapingService::BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_MELILLA, "name" => "Boletín Oficial de la Ciudad Autónoma de Melilla", "priority" => ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1]
        ]);
    }
}
