<?php

namespace App\Models;

class SearchConfig
{

    public $appId;
    public $apiKey;
    public $indexId;
    public $defaultRefinementSearch;
    public $defaultRefinementDay;
    public $initWithResults;

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
    }

    /**
     * @param null|string $defaultRefinementSearch
     */
    public function setDefaultRefinementSearch($defaultRefinementSearch)
    {
        $this->defaultRefinementSearch = $defaultRefinementSearch;
    }

    /**
     * @param null|string $defaultRefinementDay
     */
    public function setDefaultRefinementDay($defaultRefinementDay)
    {
        $this->defaultRefinementDay = $defaultRefinementDay;
    }

    /**
     * @param bool|null $initWithResults
     */
    public function setInitWithResults($initWithResults)
    {
        $this->initWithResults = $initWithResults;
    }

}