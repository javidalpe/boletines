<?php

namespace App\Services\Scrapers\Exceptions;

class BadRequestException extends \Exception
{

    public $url;

    /**
     * BadRequestException constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }


}