<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Storage;

class PrincipadoDeAsturiasScraperStrategy implements IBoletinScraperStrategy
{

    const FILES_DIRECTORY = "asturias";

    public function downloadFilesFromInternet()
    {
        exec("wget --no-directories --recursive -H -A pdf  --timeout=4 -N --tries=2 -l 2 -e robots=off -P storage/app/public/asturias --domains sede.asturias.es https://www.asturias.es/bopa");
    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }
}