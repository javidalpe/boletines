<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Illuminate\Support\Facades\Storage;

class JuntaDeAndaluciaBoletinScraperStrategy implements IBoletinScraperStrategy
{


    const DIRECTORY_FILES = 'public/junta';

    public function downloadFilesFromInternet()
    {
        FileDownloaderScraper::create("http://www.juntadeandalucia.es/boja")
            ->forEachLink ("/http:\/\/www\.juntadeandalucia\.es\/boja\/\d+\/\d+\/index\.html/")
            ->navigate()
            ->forEachLink("/http:\/\/www\.juntadeandalucia\.es\/boja\/\d+\/\d+\/\w+-\w+-\w+.pdf/")
            ->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
    }

    public function getFiles()
    {
        return Storage::files(self::DIRECTORY_FILES);
    }
}