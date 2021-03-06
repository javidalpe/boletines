<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class MelillaScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;


    public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("http://www.melilla.es/melillaportal/contenedor.jsp?seccion=bome.jsp&language=es&codResi=1&layout=contenedor.jsp&codAdirecto=15")
			->forEachLink ("/contenedor\.jsp\?seccion=ficha_bome\.jsp&dboidboletin=\d+/", self::MAX_NUMBER_OF_PUBLICATIONS, false)
			->navigate()
			->getLinks("/http:\/\/www\.melilla\.es\/mandar\.php\/\w+\/\d+\/\d+\/[a-zA-Z0-9]+\.pdf/");
	}


}