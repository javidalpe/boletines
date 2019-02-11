<?php


namespace App\Services\Scrapers\ParseContentStrategy\Strategies;


use App\SearchablePage;
use App\Services\Scrapers\ParseContentStrategy\IParseContentStrategy;

class ParseHTMLContentStrategy implements IParseContentStrategy
{

	/**
	 * Parse de page content to plain text.
	 *
	 * @param string $content     The requested page body
	 * @param string $originalUrl The parsed page url
	 *
	 * @return SearchablePage[]
	 */
	public function parseBodyContent(string $content, string $originalUrl): array
	{
		$html = new \Html2Text\Html2Text($content);

		return [
		    new SearchablePage($originalUrl, $html->getText())
        ];
	}
}
