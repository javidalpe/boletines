<?php

namespace App\Models;

class SearchConfig
{

    public $appId;
    public $apiKey;
    public $indexId;
    public $defaultRefinementSearch;
    public $defaultRefinementDay;

    /**
     * SearchConfig constructor.
     * @param string $appId Algolia Application Id
     * @param string $browserKey Algolia Search-Only API Key
     * @param string $indexId Algolia Index
     * @param string|null $defaultRefinementSearch Default search value
     * @param string|null $defaultRefinementDay Default day filter
     */
    public function __construct($appId, $browserKey, $indexId, $defaultRefinementSearch = null, $defaultRefinementDay = null)
    {
        $this->appId = $appId;
        $this->apiKey = $browserKey;
        $this->indexId = $indexId;
        $this->defaultRefinementSearch = $defaultRefinementSearch;
        $this->defaultRefinementDay = $defaultRefinementDay;
    }

}