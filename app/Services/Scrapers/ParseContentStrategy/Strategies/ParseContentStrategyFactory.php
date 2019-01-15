<?php


namespace App\Services\Scrapers\ParseContentStrategy\Strategies;


use App\Publication;
use App\Services\ScrapingService;

class ParseContentStrategyFactory
{

	public function getParseContentStrategy(Publication $publication)
	{
		switch ($publication->id)
		{
			case ScrapingService::BOLETIN_BADAJOZ:
				return new ParseHTMLContentStrategy();
			default:
				return new ParsePdfContentStrategy();
		}
	}
}
