<?php


namespace App\Services\Scrapers\ParseContentStrategy;


use App\Publication;
use App\Services\Scrapers\ParseContentStrategy\Strategies\ParseHTMLContentStrategy;
use App\Services\Scrapers\ParseContentStrategy\Strategies\ParsePdfContentStrategy;
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
