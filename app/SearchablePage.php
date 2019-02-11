<?php


namespace App;


class SearchablePage
{
    /**
     * @var string
     */
    public $pageUrl;
    /**
     * @var string
     */
    public $plainText;

    /**
     * SearchablePage constructor.
     * @param string $pageUrl
     * @param string $plainText
     */
    public function __construct(string $pageUrl, string $plainText)
    {
        $this->pageUrl = $pageUrl;
        $this->plainText = $plainText;
    }

}