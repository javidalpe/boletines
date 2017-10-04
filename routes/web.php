<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@welcome')->name('welcome');
Route::get('/demo', 'LandingController@demo')->name('demo');
Route::get('/precios', 'LandingController@pricing')->name('pricing');


Auth::routes();

Route::middleware('auth')->group(function () {
	Route::get('/search', 'HomeController@search')->name('search');
	Route::get('/report/{id}/{timestamp}', 'HomeController@report')->name('report');
	Route::resource('alerts', 'AlertController');

    Route::get('/account', 'AccountController@show')->name('account.show');
    Route::put('/account', 'AccountController@update')->name('account.update');
});

Route::prefix('admin')->group(function () {
    Route::get('/scrapers', 'AdminController@scrapers')->name('scrapers');
});
