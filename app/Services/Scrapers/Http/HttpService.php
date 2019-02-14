<?php

namespace App\Services\Scrapers\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;

class HttpService
{

    /**
     * Returns a Http response from request
     *
     * @param Request $request
     * @return Response|null
     */
	public static function get(Request $request)
	{
        $try = 3;

        while($try) {
            try {
                // Add the middleware to stack and create guzzle client
                $stack = HandlerStack::create();
                $stack->push(EffectiveUrlMiddleware::middleware());
                $client = new Client(['handler' => $stack, 'verify' => false]);

                $response = $client->request($request->method, $request->url, $request->options);

                $effectiveUrl = $response->getHeaderLine('X-GUZZLE-EFFECTIVE-URL');
                return new Response($response, $effectiveUrl);
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
