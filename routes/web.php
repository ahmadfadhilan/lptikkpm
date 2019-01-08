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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('ftii','MhsController');
Route::post('tahunjur', 'MhsController@tahunjur');
Route::post('jalurukt', 'MhsController@jalurukt');
Route::get('excel','MhsController@tjexport')->name('tahunjur.excel');
Route::get('excel1','MhsController@juexport')->name('jalurukt.excel');

Route::resource('fti','FTIController');
Route::post('tahunjurfti', 'FTIController@tahunjur');
Route::post('jaluruktfti', 'FTIController@jalurukt');
Route::get('excelfti','FTIController@tjexport')->name('tahunjurfti.excel');
Route::get('excel1fti','FTIController@juexport')->name('jaluruktfti.excel');

Route::resource('ft','FTController');
Route::post('tahunjurft', 'FTController@tahunjur');
Route::post('jaluruktft', 'FTController@jalurukt');
Route::get('excelft','FTController@tjexport')->name('tahunjurft.excel');
Route::get('excel1ft','FTController@juexport')->name('jaluruktft.excel');

Route::get('api/coba','MhsController@api')->name('api.coba');
