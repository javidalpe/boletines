<?php
namespace App\Services\Scrapers;

use App\Services\Scrapers\Exceptions\BadRequestException;
use GuzzleHttp\Client;
use Log;
use Storage;

class HttpService
{
    /**
     * @param $url
     * @return string
     * @throws BadRequestException
     */
    public static function get($url)
    {
        $client = new Client();
        $res = $client->request('GET', $url);

        if ($res->getStatusCode() != 200) {
            throw new BadRequestException($url);
        }

        $body = $res->getBody();
        $stringBody = (string) $body;
        return $stringBody;
    }


    public static function download($url, $fileName)
    {
        if (Storage::exists($fileName)) {
            return;
        }

        Log::debug("Downloading {$url}");
        Storage::put($fileName, file_get_contents($url));
    }

    public static function match($body, $pattern)
    {
        preg_match_all($pattern, $body, $matches, PREG_OFFSET_CAPTURE);
        return array_column($matches[0], 0);
    }
}