<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Log;
use Storage;

class MelillaScraperStrategy implements IBoletinScraperStrategy
{

    const BASE_PAGE = "http://www.melilla.es/";

    const SCRAPING_BASE = self::BASE_PAGE . 'melillaportal/';

    const BOLETIN_LINK_REGEX = "/contenedor.jsp\?seccion=ficha_bome.jsp&amp;dboidboletin=\d+/";
    const BOLETIN_PDF_LINK_REGEX = "/http:\/\/www\.melilla\.es\/mandar\.php\/n\/(\d+)\/(\d+)\/(\w+)\.pdf/";

    const LANDING_PAGE = self::SCRAPING_BASE . 'contenedor.jsp?seccion=bome.jsp';

    const FILES_DIRECTORY = "melilla";

    public function downloadFilesFromInternet()
    {
        $url = self::LANDING_PAGE;
        $body = HttpService::get($url);
        preg_match_all(self::BOLETIN_LINK_REGEX, $body, $matches);

        foreach ($matches[0] as $match) {
            Log::debug('Scraping ' . $match);
            $finalUrl = self::SCRAPING_BASE. html_entity_decode($match);
            $body = HttpService::get($finalUrl);


            preg_match(self::BOLETIN_PDF_LINK_REGEX, $body, $matchesPdf, PREG_OFFSET_CAPTURE);

            $fileName = $this->getFileName($matchesPdf);
            $url  = $matchesPdf[0][0];
            $pdfUrl = html_entity_decode($url);
            HttpService::download($pdfUrl, $fileName);
        }

    }

    public function getFiles()
    {
        return Storage::files(self::FILES_DIRECTORY);
    }

    /**
     * @param $matchesPdf
     * @return string
     */
    private function getFileName($matchesPdf)
    {
        $fileName = sprintf("%s/%s-%s-%s.pdf", self::FILES_DIRECTORY, $matchesPdf[1][0], $matchesPdf[2][0], $matchesPdf[3][0]);
        return $fileName;
    }
}