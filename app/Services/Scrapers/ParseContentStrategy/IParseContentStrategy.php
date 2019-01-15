<?php


namespace App\Services\Scrapers\ParseContentStrategy;


interface IParseContentStrategy
{

	/**
	 * Parse de page content to plain text.
	 *
	 * @param string $content The requested page body
	 * @param string $originalUrl The parsed page url
	 *
	 * @return string
	 */
	public function parseBodyContent(string $content, string $originalUrl): string;
}
