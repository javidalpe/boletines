<?php

namespace App\Services\Scrapers\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;

class HttpService
{
	public static $cache = [];

	public const CHROME_HEADERS = [
		"Connection" => "keep-alive",
		"Pragma" => "no-cache",
		"Cache-Control" => "no-cache",
		"Upgrade-Insecure-Requests" => "1",
		"User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36",
		"Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
		"Accept-Encoding" => "gzip, deflate, br",
		"Accept-Language" => "es-ES,es;q=0.9,en;q=0.8,ca;q=0.7",
	];

	/**
	 * Returns a Http response from request
	 *
	 * @param Request $request
	 *
	 * @param bool    $cache
	 *
	 * @return Response|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public static function get(Request $request, $cache = true)
	{
		$cacheKey = $request->url;
		if ($cache && isset(self::$cache[$cacheKey])) {
			return self::$cache[$cacheKey];
		}

        $try = 3;

        while($try) {
            try {
                // Add the middleware to stack and create guzzle client
                $stack = HandlerStack::create();
                $stack->push(EffectiveUrlMiddleware::middleware());
                $client = new Client(['handler' => $stack, 'verify' => false]);

                $response = $client->request($request->method, $request->url, $request->options);

                $effectiveUrl = $response->getHeaderLine('X-GUZZLE-EFFECTIVE-URL');
	            $httpResponse = new Response($response, $effectiveUrl);
	            if ($cache) {
		            self::$cache[$cacheKey] = $httpResponse;
	            }
	            return $httpResponse;
            } catch (ServerException $e) {
                sleep(1);
                $try--;
            }
        }

        return null;
	}

    /**
     * @param Request $request
     * @return mixed
     */
	public static function json(Request $request)
	{
        $response = self::get($request);

        if (!$response) {
            return null;
        }

        return $response->json();
	}
}
