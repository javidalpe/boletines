<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class ComunidadDeMadridScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		return FileDownloaderScraper::create("http://www.bocm.es/bocm/Satellite?language=es&pagename=Boletin/Page/BOCM_home")
			->getLinks ("/\/boletin\/CM_Boletin_BOCM\/\d+\/\d+\/\d+\/\d+.PDF/");
	}

	public function hasEachDocumentUniqueUrl()
	{
		return true;
	}
}