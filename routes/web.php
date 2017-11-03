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
Route::get('/como-funciona', 'LandingController@how')->name('how');
Route::get('/sobre-nosotros', 'LandingController@about')->name('about');
Route::get('/contactanos', 'LandingController@contact')->name('contact');
Route::get('/estado', 'LandingController@status')->name('status');
Route::get('/politica-de-privacidad', 'LandingController@privacy')->name('privacy');
Route::get('/politica-de-cookies', 'LandingController@cookies')->name('cookies');


Auth::routes();

Route::middleware('auth')->group(function () {

	Route::get('/report/{id}/{timestamp}', 'HomeController@report')->name('report');
	Route::resource('alerts', 'AlertController');
    Route::resource('account', 'AccountController');
    Route::resource('invites', 'InviteController');

    Route::get('/rewards', 'RewardController@index')->name('rewards');
});

Route::prefix('admin')->group(function () {
    Route::get('/scrapers', 'AdminController@scrapers')->name('scrapers');
});
