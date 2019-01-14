<?php


namespace App\Services\Scrapers;


use App\Services\Scrapers\Http\EffectiveUrlMiddleware;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use Log;

class FileDownloaderScraper
{
    private $links;
    private $contents;
    private $lastDomain;
    private $lastUrl;

    const MAX_LINKS_PER_PAGE = 10;

    const URL_HASH_FUNCTION = 'md5';

    const PDF_FILE_EXTENSION = '.pdf';

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
     * @param int $maxNumberOfLinks
     * @param bool $inverseSort
     * @param $modifier
     *
     * @return $this
     */
    public function forEachLink(string $regex, int $maxNumberOfLinks = 0, $inverseSort = true,
                                $modifier = null)
    {
        $this->updateLinks($regex, $maxNumberOfLinks, $inverseSort, $modifier);
        return $this;
    }

    /**
     * @param string $regex
     * @param $modifier
     * @return array
     */
    public function getLinks(string $regex, $modifier = null)
    {
        $this->updateLinks($regex, $maxNumberOfLinks = 0, $inverseSort = true, $modifier);
        return $this->links;
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
     *
     * @return $this
     */
    public function download($directoryName)
    {
        foreach ($this->links as $link) {
            $this->downloadLink($directoryName, $link);
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

        $protocol = (isset($parse["scheme"]) ? ($parse["scheme"] . ":") : '') . '//';
        $this->lastDomain = $protocol . $parse["host"];

        if (isset($parse["path"])) {
            $path = $parse["path"];
        } else {
            $path = '/';
        }

        if (strlen($path) > 0 && substr($path, -1, 1) != '/') {
            $index = strrpos($path, '/');
            $path = substr($path, 0, $index + 1);
        }

        $this->lastUrl = $protocol . $parse["host"] . $path;
    }

    /**
     * @param $link
     * @return string
     */
    private function getDownloadFileName($link)
    {
        return hash(self::URL_HASH_FUNCTION, $link) . self::PDF_FILE_EXTENSION;
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
        } while ($count);

        return false;
    }

    /**
     * @param $directoryName
     * @param $link
     */
    private function downloadLink($directoryName, $link)
    {
        Log::debug("Handling {$link}");

        $downloadFileName = $this->getDownloadFileName($link);
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
        $try = 3;

        while($try) {
            try {
                // Add the middleware to stack and create guzzle client
                $stack = HandlerStack::create();
                $stack->push(EffectiveUrlMiddleware::middleware());
                $client = new Client(['handler' => $stack]);

                $response = $client->request('GET', $url);
                $body = $response->getBody();

                $effectiveUrl = $response->getHeaderLine('X-GUZZLE-EFFECTIVE-URL');
                $this->updateBaseUrl($effectiveUrl);

                $stringBody = (string)$body;
                return $stringBody;
            } catch (ServerException $e) {
                $try--;
            }
        }
        throw new ServerException();
    }

    /**
     * @param string $regex
     * @param string $content
     * @param int $maxNumberOfLinks
     * @param bool $inverseSort
     * @param $modifier
     * @return array
     */
    private function getLinksFromPageContent(string $regex, string $content, int
    $maxNumberOfLinks,
                                             bool $inverseSort, $modifier): array
    {
        $rawHtmlLinks = $this->match($content, $regex);
        $uniqueRawHtmlLinks = array_unique($rawHtmlLinks);
        if ($modifier) {
            $modifiedLinks = $this->modify($uniqueRawHtmlLinks, $modifier);
            $fixedLinks = $this->fixLinks($modifiedLinks);
        } else {
            $fixedLinks = $this->fixLinks($uniqueRawHtmlLinks);
        }

        if ($inverseSort) {
	        rsort($fixedLinks, SORT_STRING);
        }

        if ($maxNumberOfLinks) {
            return array_slice($fixedLinks, 0, $maxNumberOfLinks);
        } else {
            return $fixedLinks;
        }
    }

    /**
     * @param string $regex
     * @param int $maxNumberOfLinks
     * @param bool $inverseSort
     * @param $modifier
     */
    protected function updateLinks(string $regex, int $maxNumberOfLinks, bool $inverseSort,
                                   $modifier)
    {
        Log::debug($regex);
        $this->links = [];
        foreach ($this->contents as $content) {
            $sliceArray = $this->getLinksFromPageContent($regex, $content, $maxNumberOfLinks,
                $inverseSort, $modifier);
            $this->links = array_merge($this->links, $sliceArray);
        }
    }

    /**
     * @param array $uniqueRawHtmlLinks
     * @param $modifier
     * @return array
     */
    private function modify(array $uniqueRawHtmlLinks, $modifier)
    {
        $newLinks = [];
        foreach ($uniqueRawHtmlLinks as $link) {
            $modified = $modifier($link);
            Log::debug("Modified {$link} to {$modified}");
            $newLinks[] = $modified;
        }

        return $newLinks;
    }


}