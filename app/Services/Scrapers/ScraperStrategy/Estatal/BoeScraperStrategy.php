<?php


namespace App\Services\Scrapers\Estatal;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class BoeScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		$firstLinks =  HTMLScraper::create("https://www.boe.es/diario_boe/ultimo.php")
			->getLinks ("/\/boe\/dias\/\d+\/\d+\/\d+\/pdfs\/[^\.]+\.pdf/");

		$secondLinks = HTMLScraper::create("https://www.boe.es/diario_boe/ultimo.php")
			->forEachLink ("/\/boe\/dias\/\d+\/\d+\/\d+\/index.php\?d=\d+&s=\d+/")
			->navigate()
            ->getLinks("/\/boe\/dias\/\d+\/\d+\/\d+\/pdfs\/[^\.]+\.pdf/");

		return array_merge($firstLinks, $secondLinks);
	}


}