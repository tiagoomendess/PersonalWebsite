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

Route::get('/', 'HomeLandingPageController@index')->name('home');
Route::get('/locale/set/{locale}', 'LocaleController@update')->name('set_locale')->where('locale', implode("|", config('custom.available_locales')));
Route::get('/cv/{token?}', 'CVDownloadController@download')->name('cv')->where('token', '^[A-Za-z0-9\-\_]{1,50}$');
