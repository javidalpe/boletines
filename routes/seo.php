<?php

$countryQueries = App\Services\Seo\SeoService::getPagesConfigForSeo();

//Route::get('{id}', 'LandingController@page')->name('page');;

foreach ($countryQueries as $countryQuery) {
	Route::get($countryQuery->slug, 'SeoController@globalQueryTerm');
}



