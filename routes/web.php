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

Route::get('/', 'ContactController@index');
Route::get('/birthdays', 'ContactController@birthdays')->name('birthdays');
Route::get('/contacts/search', 'ContactController@search');
Route::resource('contacts', 'ContactController');