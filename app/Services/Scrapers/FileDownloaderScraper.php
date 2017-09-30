<?php


namespace App\Services\Scrapers;


use App\Services\Scrapers\Http\EffectiveUrlMiddleware;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Log;

class FileDownloaderScraper
{
	private $links;
	private $contents;
	private $lastDomain;
	private $lastUrl;

	public static function create(string $initialUrl)
	{
		return new FileDownloaderScraper($initialUrl);
	}

	/**
	 * FileDownloaderScraper constructor.
	 *
	 * @param string $initialUrl
	 */
	private function __construct(string $initialUrl)
	{
		$this->links = [$initialUrl];
		$this->contents = [];


		$this->navigate();
	}

	/**
	 * Save all found links for further operations
	 *
	 * @param string $regex
	 *
	 * @return $this
	 */
	public function forEachLink(string $regex)
	{
		Log::debug($regex);
		$this->links = [];
		foreach ($this->contents as $content) {
			$rawHtmlLinks = $this->match($content, $regex);
			$this->links  = array_merge($this->links, $this->fixLinks($rawHtmlLinks));
		}
		return $this;
	}

	/**
	 * Get all the page content from saved links
	 *
	 * @return $this
	 */
	public function navigate()
	{
		$this->contents = [];

		foreach ($this->links as $link) {
			Log::debug("Obteniendo {$link}");
			$content = $this->httpGet($link);
			$this->contents[] = html_entity_decode($content);
		}
		$this->links = [];
		return $this;
	}

	/**
	 * Download all saved links
	 *
	 * @param      $directoryName
	 * @param null $fileName
	 *
	 * @return $this
	 */
	public function download($directoryName, $fileName = null)
	{
		$fileNumber = 1;
		foreach ($this->links as $link) {
			$this->downloadLink($directoryName, $fileName, $link, $fileNumber);
			$fileNumber++;
		}

		return $this;
	}


	/**
	 * @param $body
	 * @param $pattern
	 *
	 * @return array
	 */
	private function match($body, $pattern)
	{
		preg_match_all($pattern, $body, $matches, PREG_PATTERN_ORDER);
		return $matches[0];
	}

	/**
	 * @param $rawHtmlLinks
	 *
	 * @return array
	 */
	private function fixLinks($rawHtmlLinks)
	{
		$fixedLinks = [];
		foreach ($rawHtmlLinks as $link) {
			$fixed = $this->fixLink($link);
			Log::debug("Found {$link} transform to {$fixed}");
			$fixedLinks[] = $fixed;
		}

		return $fixedLinks;
	}

	/**
	 * @param string $link
	 *
	 * @return string
	 */
	private function fixLink(string $link)
	{
		if (substr($link, 0, 4) == 'http') {
			return $link;
		}
		
		if (substr($link, 0, 1) == '/') {
			return $this->lastDomain . $link;
		}

		return $this->lastUrl . $link;
	}

	/**
	 * @param string $link
	 */
	private function updateBaseUrl(string $link)
	{
		$parse = parse_url($link);

		$protocol = (isset($parse["scheme"]) ? ($parse["scheme"].":") : '') . '//';
		$this->lastDomain = $protocol . $parse["host"];

		$path = $parse["path"];
		if (strlen($path) > 0 && substr($path, -1, 1) != '/') {
			$index = strrpos($path, '/');
			$path = substr($path, 0, $index+1);
		}

		$this->lastUrl = $protocol . $parse["host"] . $path;
	}

	/**
	 * @param $link
	 *
	 * @return bool|string
	 */
	private function getFileNameFromLink($link)
	{
		$pos = strrpos($link, '/');
		$fileName = substr($link, $pos);
		return $fileName;
	}

	/**
	 * @param $filename
	 * @param $index
	 *
	 * @return string
	 */
	private function getFileNameWithNumber($filename, $index)
	{
		$pos = strrpos($filename, ".");
		if ($pos) {
			return substr($filename, 0, $pos) . '.' . $index . substr($filename, $pos);
		} else {
			return $filename . $index;
		}
	}

	/**
	 * @param $fileName
	 * @param $link
	 * @param $fileNumber
	 *
	 * @return bool|string
	 */
	private function getDownloadFileName($fileName, $link, $fileNumber)
	{
		if ($fileName == null) {
			$downloadFileName = $this->getFileNameFromLink($link);
		} else {
			$downloadFileName = $fileName;
			if (count($this->links) > 1) {
				$downloadFileName = $this->getFileNameWithNumber($downloadFileName, $fileNumber);
			}
		}
		return $downloadFileName;
	}

	/**
	 * @param $directoryName
	 * @param $filePath
	 * @param $content
	 */
	private function saveFile($directoryName, $filePath, $content)
	{
		Log::debug("Saving to " . $filePath);
		if (!is_dir($directoryName)) {
			mkdir($directoryName, null, true);
		}
		file_put_contents($filePath, $content);
	}

	/**
	 * @param $link
	 *
	 * @return bool|string
	 */
	private function downloadFile($link)
	{
		Log::debug("Downloading {$link}");
		$count = 3;
		do {
			try {
				$content = file_get_contents($link);
				return $content;
			} catch (Exception $e) {
				$count--;
			}
		} while($count);

		return false;
	}

	/**
	 * @param $directoryName
	 * @param $fileName
	 * @param $link
	 * @param $fileNumber
	 */
	private function downloadLink($directoryName, $fileName, $link, $fileNumber)
	{
		Log::debug("Handling {$link}");

		$downloadFileName = $this->getDownloadFileName($fileName, $link, $fileNumber);
		$filePath = $directoryName . $downloadFileName;

		if (file_exists($filePath)) return;

		$content = $this->downloadFile($link);
		$this->saveFile($directoryName, $filePath, $content);
	}

	/**
	 * @param $url
	 *
	 * @return bool|string
	 */
	private function httpGet($url)
	{
		// Add the middleware to stack and create guzzle client
		$stack = HandlerStack::create();
		$stack->push(EffectiveUrlMiddleware::middleware());
		$client = new Client(['handler' => $stack]);

		$response = $client->request('GET', $url);
		$body = $response->getBody();

		$effectiveUrl = $response->getHeaderLine('X-GUZZLE-EFFECTIVE-URL');
		$this->updateBaseUrl($effectiveUrl);

		$stringBody = (string) $body;
		return $stringBody;
	}


}