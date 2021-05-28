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
Route::get('/buscar', 'LandingController@search')->name('search');
Route::get('/acerca-de', 'LandingController@how')->name('how');
Route::get('/sobre-nosotros', 'LandingController@about')->name('about');
Route::get('/contactanos', 'LandingController@contact')->name('contact');
Route::get('/estado', 'LandingController@status')->name('status');
Route::get('/desarrolladores', 'LandingController@developers')->name('developers');
Route::get('/alertas', 'LandingController@alerts')->name('alerts');
Route::get('/politica-de-privacidad', 'LandingController@privacy')->name('privacy');
Route::get('/politica-de-cookies', 'LandingController@cookies')->name('cookies');

Route::get('/nos-despedimos', 'LandingController@bye')->name('bye');


Auth::routes();

Route::middleware('guest')->group(function() {
	Route::get('login/google', 'Auth\GoogleLoginController@redirectToProvider')->name('google.login');
	Route::get('login/googlecallback', 'Auth\GoogleLoginController@handleProviderCallback')->name('google.logincallback');
});

Route::middleware('auth')->group(function () {

	Route::get('report/{id}/{timestamp}', 'HomeController@report')->name('report');

	Route::resource('alerts', 'AlertController');
    Route::get('alerta-creada', 'AlertController@index')->name('conversion');

    Route::resource('account', 'AccountController');
    Route::resource('invites', 'InviteController');
    Route::resource('webhooks', 'WebhooksController');
    Route::resource('invoices', 'InvoicesController');
    Route::resource('balance', 'BalanceController');

	Route::get('subscriptions', 'SubscriptionsController@index')->name('subscriptions');

    Route::get('webhooks/{webhook}/test', 'WebhooksController@test')->name('webhooks.test');

    Route::get('invita', 'MemberGetMemberController@index')->name('mgm');
});

//Stripe Webhooks
Route::post('stripe/webhook','\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');
