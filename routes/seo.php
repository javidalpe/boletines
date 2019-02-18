<?php

$termQueries = App\Services\Seo\SeoService::getPagesConfigForSeo();

foreach ($termQueries as $countryQuery) {
	Route::get($countryQuery->slug, 'SeoController@globalQueryTerm');
}

$publication = App\Services\Seo\SeoService::getPagesConfigForPublicationsSeo();

foreach ($publication as $publication) {
	Route::get($publication->slug, 'SeoController@publication');
}



