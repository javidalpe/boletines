<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AragonScraperStrategy implements IBoletinScraperStrategy
{

    const FILES_DIRECTORY = "aragon";
    const INITIAL_PAGE = "http://www.boa.aragon.es/";
    const BOLETIN_LINK_REGEX = "/BRSCGI\?CMD=VEROBJ&MLKOB=\d+/";
    const BOLETIN_BASE_URL = self::INITIAL_PAGE . '/cgi-bin/EBOA/';

    public function downloadFilesFromInternet()
    {
        $url = self::INITIAL_PAGE;
        $body = HttpService::get($url);

        preg_match(self::BOLETIN_LINK_REGEX, $body, $matches, PREG_OFFSET_CAPTURE);
        $url  = $matches[0][0];
        $finalUrl = self::BOLETIN_BASE_URL. html_entity_decode($url);

        $now = Carbon::now();
        $fileName = sprintf("%s/%s.pdf", self::FILES_DIRECTORY, $now->format("Y-m-d"));
        Storage::put($fileName, file_get_contents($finalUrl));
    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }
}