<?php


namespace App\Services\Scrapers\ParseContentStrategy;


use App\SearchablePage;

interface IParseContentStrategy
{

	/**
	 * Parse de page content to plain text.
	 *
	 * @param string $content The requested page body
	 * @param string $originalUrl The parsed page url
	 *
	 * @return SearchablePage[]
	 */
	public function parseBodyContent(string $content, string $originalUrl): array ;
}
