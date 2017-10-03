<?php

namespace App\Services\Search;

use App\Alert;
use App\Models\SearchConfig;
use Carbon\Carbon;

class SearchConfigService
{

    const MAIN_CHUNKS_INDEX = 'chunks_index';
    const DEMO_CHUNKS_INDEX = 'chunks_index';

    public function createForSearch() : SearchConfig
    {
        return new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), self::MAIN_CHUNKS_INDEX);
    }

    public function createForAlert(Alert $alert, Carbon $dayOfYear) : SearchConfig
    {
        $day = $dayOfYear->formatLocalized('%d %B %Y');
        return new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), self::MAIN_CHUNKS_INDEX, $alert->query, $day);
    }

    public function createForDemo() : SearchConfig
    {
        return new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), self::DEMO_CHUNKS_INDEX);
    }
}