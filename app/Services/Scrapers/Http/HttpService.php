<?php

namespace App\Services\Scrapers\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HttpService
{

	/**
	 * Returns a http response from a http request
	 *
	 * @param string $url
	 * @param string $method
	 *
	 * @return mixed|null|\Psr\Http\Message\ResponseInterface
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public static function get(string $url, string $method = 'GET')
	{
		$try = 3;
		while ($try) {
			try {
				$client = new Client(['verify' => false]);

				return $client->request($method, $url);
			} catch (RequestException $e) {
				$try--;
			}
		}

		return null;
	}

	/**
	 * Returns a body content from a http request
	 *
	 * @param string $url
	 * @param string $method
	 *
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public static function getBody(string $url, string $method = 'GET') : string
	{
		$response = self::get($url, $method);
		return (string)$response->getBody();
	}

	/**
	 * @param string $url
	 * @param string $method
	 *
	 * @return mixed
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public static function json(string $url, string $method = 'GET')
	{
		$body = self::getBody($url, $method);
		return json_decode($body, true);
	}
}
