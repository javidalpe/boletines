<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CastillaLaManchaScraperStrategy implements IBoletinScraperStrategy
{



	public function downloadFilesFromInternet()
	{
        return HTMLScraper::create("http://docm.jccm.es/portaldocm/")
			->getLinks ("/descargarArchivo\.do\?ruta=\d+\/\d+\/\d+\/pdf\/docm_\d+\.pdf&tipo=rutaDocm/");
	}


}