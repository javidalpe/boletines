<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;

class ExtremaduraScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        $landing = HttpService::get("http://doe.gobex.es/busquedas/bus_calendario.php");
        foreach (HttpService::match($landing, "/\.\.\/ultimosdoe\/mostrardoe\.php\?fecha=\d+/") as $match) {
            $day = HttpService::get("http://doe.gobex.es" . substr($match, 2));
            foreach (HttpService::match($day, "/doe\/\d+o\/\d+o\.pdf/") as $boe) {
                dd($boe);
            }
        }
    }

    public function getFiles()
    {
        // TODO: Implement getFiles() method.
    }
}