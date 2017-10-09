<?php

namespace App\Services\Search;

use App\Alert;
use App\Models\SearchConfig;
use Carbon\Carbon;

class SearchConfigService
{

    const MAIN_CHUNKS_INDEX = 'chunks_index';
    const DEMO_CHUNKS_INDEX = 'demo_index';

    public function createForSearch() : SearchConfig
    {
        $config =  new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), self::MAIN_CHUNKS_INDEX);
        return $config;
    }

    public function createForAlert(Alert $alert, Carbon $dayOfYear) : SearchConfig
    {
        $day = $dayOfYear->formatLocalized('%d %B %Y');
        $config =  new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), self::MAIN_CHUNKS_INDEX);
        $config->setDefaultRefinementSearch($alert->query);
        $config->setDefaultRefinementDay($day);
        return $config;
    }

    public function createForDemo() : SearchConfig
    {
        $config =  new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), self::DEMO_CHUNKS_INDEX);
        $config->setInitWithResults(false);
        return $config;
    }
}