<?php


namespace App\Services\Scrapers\ParseContentStrategy\Strategies;


use App\SearchablePage;
use App\Services\Scrapers\ParseContentStrategy\IParseContentStrategy;
use Log;
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
	 * @return SearchablePage[]
	 */
	public function parseBodyContent(string $content, string $originalUrl): array
	{
		$filename = $this->hashUrl($originalUrl);

		Storage::put($filename, $content);
		$pages = $this->getPagesFromPDF($filename, $originalUrl);
		Storage::delete($filename);

		return $pages;
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

    /**
     * @param string $filename
     *
     * @param string $originalUrl
     * @return SearchablePage[]
     */
	private function getPagesFromPDF($filename, $originalUrl)
	{
		Log::debug("Parsing pdf: " . $originalUrl);

		$fullFilePath = $this->getFullPath($filename);

		$fullPathWithText = storage_path('app/' . $filename . '.txt');

		$pages = [];
		$return_var = 0;
		$pageCounter = 1;
		while($return_var === 0) {
            $pdfToTextCommand = "pdftotext -f $pageCounter -l $pageCounter -enc ASCII7 $fullFilePath $fullPathWithText";
            exec($pdfToTextCommand,$output,$return_var);

            if ($return_var !== 0 || !file_exists($fullPathWithText)) {
                break;
            }

            $content = file_get_contents($fullPathWithText);
            unlink($fullPathWithText);

            if (!$content || strlen($content) < 10) {
                break;
            }

            $pageUrl = $originalUrl . "#page=" . $pageCounter;
            Log::debug("Store page $pageCounter url $pageUrl");
            $pages[] = new SearchablePage($pageUrl, $content);

            $pageCounter++;
        }

		return $pages;
	}

	/**
	 * @param $filename
	 *
	 * @return string
	 */
	private function getFullPath($filename)
	{
		$fullFilePath = storage_path('app/' . $filename);

		return $fullFilePath;
	}

}
