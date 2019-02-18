<?php


use App\Publication;
use App\Services\ScrapingService as SS;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publication::insert([
            ['id' => SS::BOLETIN_A_CORUNA, "name" => "Boletín Oficial de A Coruña", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_TERRITORIO_HISTORICO_DE_ALAVA, "name" => "Boletín Oificial del Territorio Histórico de Álava", "priority" =>
	            SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_ALBACETE, "name" => "Boletín Oficial de Albacete", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_ALICANTE, "name" => "Boletín Oficial de Alicante", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_ALMERIA, "name" => "Boletín Oficial de Almería", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_AVILA, "name" => "Boletín Oficial de Ávila", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_BADAJOZ, "name" => "Boletín Oficial de Badajoz", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_BARCELONA, "name" => "Boletín Oficial de Barcelona", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_BURGOS, "name" => "Boletín Oficial de Burgos", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_CACERES, "name" => "Boletín Oficial de Cáceres", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_CADIZ, "name" => "Boletín Oficial de Cádiz", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_CASTELLON, "name" => "Boletín Oficial de Castellón", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_CIUDAD_REAL, "name" => "Boletín Oficial de Ciudad Real", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_CORDOBA, "name" => "Boletín Oficial de Córdoba", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_CUENCA, "name" => "Boletín Oficial de Cuenca", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_GIRONA, "name" => "Boletín Oficial de Girona", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_GRANADA, "name" => "Boletín Oficial de Granada", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_GUADALAJARA, "name" => "Boletín Oficial de Guadalajara", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_GUIPUZKOA, "name" => "Boletín Oficial de Guipuzkoa", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_HUELVA, "name" => "Boletín Oficial de Huelva", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_HUESCA, "name" => "Boletín Oficial de Huesca", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_JAEN, "name" => "Boletín Oficial de Jaén", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_LAS_PALMAS, "name" => "Boletín Oficial de Las Palmas", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_LEON, "name" => "Boletín Oficial de León", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_LLEIDA, "name" => "Boletín Oficial de Lleida", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_LUGO, "name" => "Boletín Oficial de Lugo", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_MALAGA, "name" => "Boletín Oficial de Málaga", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_OURENSE, "name" => "Boletín Oficial de Ourense", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_PALENCIA, "name" => "Boletín Oficial de Palencia", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_PONTEVEDRA, "name" => "Boletín Oficial de Pontevedra", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_SALAMANCA, "name" => "Boletín Oficial de Salamanca", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_SANTA_CRUZ_DE_TENERIFE, "name" => "Boletín Oficial de Santa Cruz de Tenerife", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_SEGOVIA, "name" => "Boletín Oficial de Segovia", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_SEVILLA, "name" => "Boletín Oficial de Sevilla", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_SORIA, "name" => "Boletín Oficial de Soria", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_TARRAGONA, "name" => "Boletín Oficial de Tarragona", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_TERUEL, "name" => "Boletín Oficial de Teruel", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_TOLEDO, "name" => "Boletín Oficial de Toledo", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_VALENCIA, "name" => "Boletín Oficial de Valencia", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_VALLADOLID, "name" => "Boletín Oficial de Valladolid", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_VIZCAYA, "name" => "Boletín Oficial de Vizcaya", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_ZAMORA, "name" => "Boletín Oficial de Zamora", "priority" =>
                SS::PRIORITY_PROVINCE],
            ['id' => SS::BOLETIN_ZARAGOZA, "name" => "Boletín Oficial de Zaragoza", "priority" =>
                SS::PRIORITY_PROVINCE],
        ]);
    }
}
