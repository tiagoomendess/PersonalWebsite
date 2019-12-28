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
Route::get('/cv/{token?}', 'CVDownloadController@downloadPage')->name('cv')->where('token', '^[A-Za-z0-9\-\_]{1,50}$');
Route::get('/cv/{token}/download/{random_string}', 'CVDownloadController@downloadFile')->name('cv_download')->where([
    'token' => '^[A-Za-z0-9\-\_]{1,50}$',
    'random_string' => '^[A-Za-z0-9\-\_]{12}$'
]);

Route::get('/pin', 'SecurityPINController@show')->name('show_pin');
Route::post('/pin', 'SecurityPINController@setPIN')->name('set_pin');

Route::resource('tokens', 'TokenAdminController');