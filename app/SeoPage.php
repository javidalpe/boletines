<?php


namespace App;


class SeoPage
{
	/**
	 * @var string
	 */
	public $slug;
	/**
	 * @var string
	 */
	public $query;
	/**
	 * @var string
	 */
	public $term;

	/**
	 * SeoPage constructor.
	 *
	 * @param string $slug
	 * @param string $query
	 * @param string $term
	 */
	public function __construct(string $slug, string $query, string $term)
	{
		$this->slug = $slug;
		$this->query = $query;
		$this->term = $term;
	}


}
