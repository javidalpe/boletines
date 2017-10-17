<?php

namespace App\Mothers;

use App\Alert;
use App\Models\SearchConfig;
use Carbon\Carbon;

class SearchConfigMother
{
    const DEMO_CHUNKS_INDEX = 'demo_index';

    public function createForSearch() : SearchConfig
    {
        $config =  new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
        $config->setInitWithResults(false);
        return $config;
    }

    public function createForAlert(Alert $alert, Carbon $dayOfYear) : SearchConfig
    {
        $day = $dayOfYear->format('Y-m-d');
        $config =  new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
        $config->setDefaultRefinementSearch($alert->query);
        $config->setDefaultRefinementDay($day);
        return $config;
    }
}