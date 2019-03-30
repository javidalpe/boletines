<?php


namespace App\Services\Scrapers;


use App\Services\Scrapers\Http\EffectiveUrlMiddleware;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\Http\Request;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use Log;

class HTMLScraper
{
    /**
     * @var Request[]
     */
    private $requests;
    private $contents;
    private $lastDomain;
    private $lastUrl;

    const MAX_LINKS_PER_PAGE = 10;

    const URL_HASH_FUNCTION = 'md5';

    const PDF_FILE_EXTENSION = '.pdf';

    /**
     * @param string $initialUrl
     * @param string $method
     * @param array $options
     * @return HTMLScraper
     */
    public static function create(string $initialUrl, string $method = "GET", $options = [])
    {
        return new HTMLScraper(new Request($initialUrl, $method, $options));
    }

    /**
     * FileDownloaderScraper constructor.
     * @param Request $request
     */
    private function __construct(Request $request)
    {
        $this->requests = [$request];
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
     * @param array $options
     * @return $this
     */
    public function forEachLink(string $regex, int $maxNumberOfLinks = 0, $inverseSort = true,
                                $modifier = null, $options = [])
    {
        $this->updateLinks($regex, $maxNumberOfLinks, $inverseSort, $modifier, $options);
        return $this;
    }

    /**
     * @param string $regex
     * @param $modifier
     * @param int $maxNumberOfLinks
     * @param array $options
     * @return array
     */
    public function getLinks(string $regex, $modifier = null, $maxNumberOfLinks = 50, $options = [])
    {
        $this->updateLinks($regex, $maxNumberOfLinks, $inverseSort = true, $modifier, $options);
        return $this->requests;
    }

    /**
     * Get all the page content from saved links
     *
     * @return $this
     */
    public function navigate()
    {
        $this->contents = [];
        foreach ($this->requests as $request) {
            Log::debug("Obteniendo {$request->url}");

            $response = HttpService::get($request);
            if (!$response) {
                Log::debug("Nada retornado");
                continue;
            }
            $this->updateBaseUrl($response->finalUrl);
            $this->contents[] = html_entity_decode($response->body());
            usleep((1000 * 1000)*rand(1, 3));
        }
        $this->requests = [];
        return $this;
    }


    /**
     * @param string $link
     */
    private function updateBaseUrl(string $link)
    {
        $parse = parse_url($link);

        $protocol = (isset($parse["scheme"]) ? ($parse["scheme"] . ":") : '') . '//';
        $this->lastDomain = $protocol . $parse["host"];

        if (isset($parse['port'])) {
	        $this->lastDomain = $this->lastDomain . ':' . $parse['port'];
        }

        if (isset($parse["path"])) {
            $path = $parse["path"];
        } else {
            $path = '/';
        }

        if (strlen($path) > 0 && substr($path, -1, 1) != '/') {
            $index = strrpos($path, '/');
            $path = substr($path, 0, $index + 1);
        }

        $this->lastUrl = $this->lastDomain . $path;
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
     * @param string $regex
     * @param string $content
     * @param int $maxNumberOfLinks
     * @param bool $inverseSort
     * @param $modifier
     * @param $options
     * @return array
     */
    private function getLinksFromPageContent(string $regex, string $content, int
    $maxNumberOfLinks,
                                             bool $inverseSort, $modifier, $options): array
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
            $links = array_slice($fixedLinks, 0, $maxNumberOfLinks);
        } else {
            $links = $fixedLinks;
        }

        return array_map(function ($link) use ($options) {
            //dd($options);
            return new Request($link, 'GET', $options);
        }, $links);
    }

    /**
     * @param string $regex
     * @param int $maxNumberOfLinks
     * @param bool $inverseSort
     * @param $modifier
     * @param $options
     */
    protected function updateLinks(string $regex, int $maxNumberOfLinks, bool $inverseSort,
                                   $modifier, $options)
    {
        Log::debug($regex);
        $this->requests = [];
        foreach ($this->contents as $content) {
            $sliceArray = $this->getLinksFromPageContent($regex, $content, $maxNumberOfLinks,
                $inverseSort, $modifier, $options);
            $this->requests = array_merge($this->requests, $sliceArray);
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

    /**
     * @param \Closure $func
     * @return array
     */
    public function getLinksFromJson(\Closure $func)
    {
        $newLinks = [];
        foreach ($this->contents as $content) {
            $json = json_decode($content, true);
            $urls = $func($json);
            $requests = array_map(function ($url) {
                return new Request($url, 'GET', []);
            }, $urls);
            $newLinks = array_merge($newLinks, $requests);
        }

        return $newLinks;
    }

}
