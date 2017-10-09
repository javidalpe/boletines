<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Illuminate\Support\Facades\Storage;

class RegionDeMurciaBoletinScraperStrategy implements IBoletinScraperStrategy
{
    const FILES_DIRECTORY = 'public/rmurcia';
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

    public function downloadFilesFromInternet()
    {
        return FileDownloaderScraper::create("https://www.borm.es/borm/vista/principal/inicio.jsf")
            ->forEachLink("/\/borm\/vista\/busqueda\/ver_sumario\.jsf\?fecha=\d+&origen=calendario/", self::MAX_NUMBER_OF_PUBLICATIONS)
            ->navigate()
            ->getLinks("/\/borm\/documento\?obj=bol&id=\d+/");
    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }
}