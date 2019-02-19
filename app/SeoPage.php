<?php


namespace App;


class SeoPage
{
	/**
	 * @var string
	 */
	public $url;
	/**
	 * @var string
	 */
	public $query;

	/**
	 * @var string
	 */
	public $termName;

    /**
     * @var string
     */
	public $publicationName;

    /**
     * SeoPage constructor.
     * @param string $url
     * @param string $query
     * @param string $termName
     * @param string $publicationName
     */
    public function __construct(string $url, string $query = null, string $termName = null, string
    $publicationName = null)
    {
        $this->url = $url;
        $this->query = $query;
        $this->termName = $termName;
        $this->publicationName = $publicationName;
    }


}
