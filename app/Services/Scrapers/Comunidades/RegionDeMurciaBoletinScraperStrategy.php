<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Illuminate\Support\Facades\Storage;

class RegionDeMurciaBoletinScraperStrategy implements IBoletinScraperStrategy
{
    const FILES_DIRECTORY = 'public/rmurcia';

    public function downloadFilesFromInternet()
    {
        FileDownloaderScraper::create("https://www.borm.es/borm/vista/principal/inicio.jsf")
            ->forEachLink("/\/borm\/vista\/busqueda\/ver_sumario\.jsf\?fecha=\d+&origen=calendario/")
            ->navigate()
            ->forEachLink("/\/borm\/documento\?obj=bol&id=\d+/")
            ->download(storage_path('app/' . self::FILES_DIRECTORY . '/'));
    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }
}