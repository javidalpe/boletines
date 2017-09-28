<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RegionDeMurciaBoletinScraperStrategy implements IBoletinScraperStrategy
{

    const BORM_BASE_URL = 'https://www.borm.es';
    const BORM_URL = self::BORM_BASE_URL. '/borm/vista/principal/inicio.jsf';

    const BORM_LINK_REGEX = "/\/borm\/documento\?obj=bol&amp;id=\d+/";

    const FILES_DIRECTORY = 'rmurcia';


    public function downloadFilesFromInternet()
    {
        $url = self::BORM_URL;
        $body = HttpService::get($url);

        preg_match(self::BORM_LINK_REGEX, $body, $matches, PREG_OFFSET_CAPTURE);
        $url  = $matches[0][0];
        $finalUrl = self::BORM_BASE_URL. html_entity_decode($url);

        $now = Carbon::now();
        $fileName = sprintf("%s/%s.pdf", self::FILES_DIRECTORY, $now->format("Y-m-d"));
        Storage::put($fileName, file_get_contents($finalUrl));
    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }
}