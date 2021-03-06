<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CastillaYLeonScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("http://bocyl.jcyl.es/")
			->forEachLink("/boletin\.do\?fechaBoletin=\d+\/\d+\/\d+/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->getLinks("/http:\/\/bocyl\.jcyl\.es\/boletines\/\d+\/\d+\/\d+\/pdf\/BOCYL\-D\-\d+-\d+\.pdf/");
	}


}