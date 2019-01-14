<?php

namespace App\Services\Scrapers\Http;

class Request
{
    /**
     * @var string
     */
    public $url;
    /**
     * @var string
     */
    public $method;
    /**
     * @var array
     */
    public $options;

    /**
     * Request constructor.
     * @param string $url
     * @param string $method
     * @param array $options
     */
    public function __construct(string $url, string $method = 'GET', array $options = null)
    {
        $this->url = $url;
        $this->method = $method;
        $this->options = $options;
    }


}