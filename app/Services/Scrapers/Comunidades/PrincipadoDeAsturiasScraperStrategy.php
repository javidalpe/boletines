<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class PrincipadoDeAsturiasScraperStrategy implements IBoletinScraperStrategy
{

    const DIRECTORY_FILES = "public/asturias";

    public function downloadFilesFromInternet()
    {
        FileDownloaderScraper::create("http://www.asturias.es/bopa")
            ->forEachLink ("/\/portal\/site\/Asturias\/menuitem\.\w+\/\?vgnextoid=\w+&i18n\.http\.lang=es&fecha=\d+\/\d+\/\d+&FechaHidden1=FECHA&FechaCompHidden1=1&origen=calendario/")
            ->navigate()
            ->forEachLink("/https:\/\/sede\.asturias\.es\/bopa\/\d+\/\d+\/\d+\/\w+\.pdf/")
            ->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
    }

    public function getFiles()
    {
        return Storage::files(self::DIRECTORY_FILES);
    }
}