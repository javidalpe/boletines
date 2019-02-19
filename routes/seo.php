<?php

$termQueries = App\Services\Seo\SeoService::getSeoPagesForTermsWithoutPublication();

foreach ($termQueries as $countryQuery) {
	Route::get($countryQuery->url, 'SeoController@globalQueryTerm');
}

$publications = App\Services\Seo\SeoService::getPagesConfigForPublicationsSeo();

foreach ($publications as $publication) {
	Route::get($publication->url, 'SeoController@publication');
}



