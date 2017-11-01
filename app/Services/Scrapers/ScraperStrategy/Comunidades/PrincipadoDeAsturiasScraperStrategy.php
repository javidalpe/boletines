<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class PrincipadoDeAsturiasScraperStrategy implements IBoletinScraperStrategy
{


    const MAX_NUMBER_OF_PUBLICATIONS = 5;

    public function downloadFilesFromInternet()
    {
        return FileDownloaderScraper::create("http://www.asturias.es/bopa")
            ->forEachLink ("/\/portal\/site\/Asturias\/menuitem\.\w+\/\?vgnextoid=\w+&i18n\.http\.lang=es&fecha=\d+\/\d+\/\d+&FechaHidden1=FECHA&FechaCompHidden1=1&origen=calendario/", self::MAX_NUMBER_OF_PUBLICATIONS)
            ->navigate()
            ->getLinks("/https:\/\/sede\.asturias\.es\/bopa\/\d+\/\d+\/\d+\/\w+\.pdf/");
    }


}