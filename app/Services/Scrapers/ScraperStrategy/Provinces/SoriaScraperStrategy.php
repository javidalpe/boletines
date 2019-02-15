<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class SoriaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://bop.dipsoria.es/")
            ->forEachLink("/\/index\.php\/mod\.boloficial\/mem\.listadodia\/fecha\.\d+\-\d+\-\d+/")
	        ->navigate()
	        ->forEachLink('/\/index\.php\/mod\.boloficial\/mem\.detalle\/id\.\d+\/relcategoria\.\d+/')
	        ->navigate()
	        ->getLinks('/http\:\/\/bop\.dipsoria\.es\/index\.php\/mod\.documentos\/mem\.descargar\/fichero\.documentos[a-zA-Z0-9_%]+pdf/');
    }
}
