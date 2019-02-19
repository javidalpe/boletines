<?php

use App\Services\Seo\SeoService;

$termQueries = SeoService::getSeoPagesForAllTerms();

foreach ($termQueries as $countryQuery) {
	Route::get($countryQuery->url, 'SeoController@globalQueryTerm');
	$publicationsPages = SeoService::getPublicationsPagesForTerm($countryQuery->url);
	foreach ($publicationsPages as $pub) {
		Route::get($pub->url, 'SeoController@publicationTerm');
	}
}

$publications = SeoService::getSeoPagesForAllPublications();

foreach ($publications as $publication) {
	Route::get($publication->url, 'SeoController@publication');
}



