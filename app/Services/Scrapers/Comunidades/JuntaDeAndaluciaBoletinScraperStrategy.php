<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Illuminate\Support\Facades\Storage;

class JuntaDeAndaluciaBoletinScraperStrategy implements IBoletinScraperStrategy
{


    const DIRECTORY_FILES = 'public/junta';
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

    public function downloadFilesFromInternet()
    {
        return FileDownloaderScraper::create("http://www.juntadeandalucia.es/boja")
            ->forEachLink ("/http:\/\/www\.juntadeandalucia\.es\/boja\/\d+\/\d+\/index\.html/", self::MAX_NUMBER_OF_PUBLICATIONS)
            ->navigate()
            ->getLinks("/http:\/\/www\.juntadeandalucia\.es\/boja\/\d+\/\d+\/\w+-\w+-\w+.pdf/");
    }

    public function hasEachDocumentUniqueUrl()
    {
        return true;
    }
}