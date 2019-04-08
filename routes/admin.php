<?php

Route::get('/scrapers', 'AdminController@scrapers')->name('scrapers');
Route::get('/regex', 'AdminController@regex')->name('regex');
Route::post('/regex', 'AdminController@regexStore')->name('regex.store');
Route::get('/impersonate/{id}', 'AdminController@impersonate')->name('impersonate');
