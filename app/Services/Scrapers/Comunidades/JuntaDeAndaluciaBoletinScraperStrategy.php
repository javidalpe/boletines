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
        FileDownloaderScraper::create("http://www.juntadeandalucia.es/boja")
            ->forEachLink ("/http:\/\/www\.juntadeandalucia\.es\/boja\/\d+\/\d+\/index\.html/", self::MAX_NUMBER_OF_PUBLICATIONS)
            ->navigate()
            ->forEachLink("/http:\/\/www\.juntadeandalucia\.es\/boja\/\d+\/\d+\/\w+-\w+-\w+.pdf/")
            ->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
    }

    public function getFiles()
    {
        return Storage::files(self::DIRECTORY_FILES);
    }
}