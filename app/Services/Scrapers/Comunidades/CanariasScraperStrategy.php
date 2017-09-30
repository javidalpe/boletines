<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Storage;

class CanariasScraperStrategy implements IBoletinScraperStrategy
{

    const FILES_DIRECTORY = "canarias";


    public function downloadFilesFromInternet()
    {
        exec("wget --no-directories --recursive -H -A pdf --accept-regex \"boc/*\" --timeout=4 -N --tries=2 -l 2 -e robots=off -P storage/app/public/canarias --domains sede.gobcan.es,www.gobiernodecanarias.org http://www.gobiernodecanarias.org/boc/");
    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }
}