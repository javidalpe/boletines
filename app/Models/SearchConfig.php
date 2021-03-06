<?php

namespace App\Models;

class SearchConfig
{

    public $appId;
    public $apiKey;
    public $indexId;
    public $defaultRefinementSearch;
	/***
	 * @var string[]
	 */
    public $defaultRefinementDays;
	/***
	 * @var string[]
	 */
	public $defaultRefinementPublications;


    public $initWithResults;
	/**
	 * @var string[]
	 */
    public $existingAlerts;

    /**
     * SearchConfig constructor.
     * @param string $appId Algolia Application Id
     * @param string $browserKey Algolia Search-Only API Key
     * @param string $indexId Algolia Index
     */
    public function __construct($appId, $browserKey, $indexId)
    {
        $this->appId = $appId;
        $this->apiKey = $browserKey;
        $this->indexId = $indexId;
        $this->initWithResults = true;
        $this->existingAlerts = [];
    }

    /**
     * @param null|string $defaultRefinementSearch
     */
    public function setDefaultRefinementSearch($defaultRefinementSearch)
    {
        $this->defaultRefinementSearch = $defaultRefinementSearch;
    }

	/**
	 * @param string[] $defaultRefinementDays
	 */
    public function setDefaultRefinementDays($defaultRefinementDays)
    {
        $this->defaultRefinementDays = $defaultRefinementDays;
    }

    /**
     * @param bool|null $initWithResults
     */
    public function setInitWithResults($initWithResults)
    {
        $this->initWithResults = $initWithResults;
    }

	/**
	 * @param string[] $existingAlerts
	 */
	public function setExistingAlerts(array $existingAlerts)
	{
		$this->existingAlerts = $existingAlerts;
	}

	/**
	 * @param string[] $defaultRefinementPublications
	 */
	public function setDefaultRefinementPublications(array $defaultRefinementPublications): void
	{
		$this->defaultRefinementPublications = $defaultRefinementPublications;
	}

}
