<?php


namespace App\Services\Scrapers\ParseContentStrategy\Strategies;


use App\Services\Scrapers\ParseContentStrategy\IParseContentStrategy;
use Storage;

class ParsePdfContentStrategy implements IParseContentStrategy
{

	const URL_HASH_FUNCTION = 'md5';

	/**
	 * Parse de page content to plain text.
	 *
	 * @param string $content     The requested page body
	 * @param string $originalUrl The parsed page url
	 *
	 * @return string
	 */
	public function parseBodyContent(string $content, string $originalUrl): string
	{
		$filename = $this->hashUrl($originalUrl);

		Storage::put($filename, $content);
		$content = $this->getContentFromPDF($filename);
		Storage::delete($filename);

		return $content;
	}

	/**
	 * @param $url
	 *
	 * @return string
	 */
	private function hashUrl($url): string
	{
		return hash(self::URL_HASH_FUNCTION, $url);
	}
}
