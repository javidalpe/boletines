<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\IBoletinScraperStrategy;

class LaRiojaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        echo("wget --no-directories --recursive -H -A \"/*-X\" --timeout=4 -N --tries=2 -l 1 -e robots=off -P storage/app/larioja http://www.larioja.org/bor/es");
    }

    public function getFiles()
    {
        // TODO: Implement getFiles() method.
    }
}