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
     * @var string
     */
	public $searchDescription;

    /**
     * SeoPage constructor.
     * @param string $url
     * @param string $query
     * @param string $termName
     * @param string $publicationName
     * @param string $searchDescription
     */
    public function __construct(string $url, string $query = null, string $termName = null, string
    $publicationName = null, $searchDescription = null)
    {
        $this->url = $url;
        $this->query = $query;
        $this->termName = $termName;
        $this->publicationName = $publicationName;
        $this->searchDescription = $searchDescription;
    }


}
