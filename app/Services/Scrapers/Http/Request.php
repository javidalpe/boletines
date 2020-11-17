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
    public function __construct(string $url, string $method = 'GET', array $options = [])
    {
        $this->url = $url;
        $this->method = $method;

        $options['connect_timeout'] = 10;
	    $options['timeout'] = 10;

        if (isset($options['headers'])) {
        	$options['headers'] = array_merge(HttpService::CHROME_HEADERS, $options['headers']);
        } else {
	        $options['headers'] = HttpService::CHROME_HEADERS;
        }

        $this->options = $options;
    }


}
