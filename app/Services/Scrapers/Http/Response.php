<?php


namespace App\Services\Scrapers\Http;


class Response
{

    /**
     * @var
     */
    public $response;
    /**
     * @var string
     */
    public $finalUrl;

    /**
     * Response constructor.
     * @param $response
     * @param string $finalUrl
     */
    public function __construct($response, string $finalUrl)
    {
        $this->response = $response;
        $this->finalUrl = $finalUrl;
    }


    /**
     * @return string
     */
    public function body()
    {
        return (string) $this->response->getBody();
    }

    /**
     * @return mixed
     */
    public function json()
    {
        $body = $this->body();
        return json_decode($body, true);
    }

}