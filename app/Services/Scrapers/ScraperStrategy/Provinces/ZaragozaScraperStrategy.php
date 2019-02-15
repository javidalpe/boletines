<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class ZaragozaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://bop.dpz.es/BOPZ/")
            ->forEachLink("/abreVentanaDetalleEdicto\('\d+'\)/", PHP_INT_MAX, true, function($link) {
	            preg_match('/\d+/', $link, $match);
	            return "obtenerContenidoEdicto.do?idEdicto=" . $match[0];
            })
	        ->navigate()
	        ->getLinks('/\.\/UploadServlet\?ruta\=Boletines\\\\\d+\\\\\d+\\\\Edictos\\\\bop_\d+_\d+\.pdf/');
    }
}
