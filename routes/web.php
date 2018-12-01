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

Route::get('/suggestions', 'SuggestionsController@index');
Route::get('/suggestions/{suggestion}', 'SuggestionsController@show');
Route::get('/suggestions/create', 'SuggestionsController@create');
Route::post('/suggestions/create', 'SuggestionsController@store');
Route::post('/suggestions/delete', 'SuggestionsController@destroy');

Route::get('/annoncements', 'AnnouncementsController@index');
Route::get('/annoncements/{suggestion}', 'AnnouncementsController@show');
Route::get('/annoncements/create', 'AnnouncementsController@create');
Route::post('/annoncements/create', 'AnnouncementsController@store');
Route::post('/annoncements/delete', 'AnnouncementsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
