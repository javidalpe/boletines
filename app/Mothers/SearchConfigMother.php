<?php

namespace App\Mothers;

use App\Alert;
use App\Models\SearchConfig;
use App\Publication;
use Carbon\Carbon;

class SearchConfigMother
{
    const DEMO_CHUNKS_INDEX = 'demo_index';

    public function createForSearch() : SearchConfig
    {
        $config = new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
        $config->setInitWithResults(false);
        return $config;
    }

    public function createForPredefinedSearch($term) : SearchConfig
    {
    	$config = new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
    	$config->setDefaultRefinementSearch($term);
    	return $config;
    }

	public function createForPredefinedPublication($publicationName) : SearchConfig
	{
		$config = new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
		$config->setDefaultRefinementPublications([$publicationName]);
		return $config;
	}

	public function createForPredefinedPublicationAndTerm($publicationName, $term) : SearchConfig
	{
		$config = new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
		$config->setDefaultRefinementPublications([$publicationName]);
		$config->setDefaultRefinementSearch($term);
		return $config;
	}


    public function createForAlert(Alert $alert, Carbon $dayOfYear) : SearchConfig
    {

        $config =  new SearchConfig(config('scout.algolia.id'), config('scout.algolia.api-key'), config('scout.index'));
        $config->setDefaultRefinementSearch($alert->query);
        if ($alert->publication_id !== null) {
        	$config->setDefaultRefinementPublications([$alert->publication->name]);
        }
        $config->setExistingAlerts([$alert->query]);

        if ($alert->frequency === Alert::FREQUENCY_DAILY) {
	        $day = $dayOfYear->format('Y-m-d');
	        $config->setDefaultRefinementDays([$day]);
        } else {
        	$days = [];
        	$iterator = 7;
        	while($iterator--){
        		$days[] = $dayOfYear->format('Y-m-d');
        	    $dayOfYear->addDays(-1);
	        }
	        $config->setDefaultRefinementDays($days);
        }

        return $config;
    }
}
