<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

// Route group for API versioning
// 'before' => 'auth.basic'
Route::group(array('prefix' => 'v1.0'), function()
{
	Route::resource('page', 'PageController');
	Route::resource('gallery', 'GalleryController');
	Route::resource('i18n', 'I18nController');
	Route::resource('navigation', 'NavigationController');
	Route::resource('settings', 'SettingController');
});
