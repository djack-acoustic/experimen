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

Route::view('/', 'welcome');
Route::get('/coba', 'HomeController@coba')->name('coba');
Route::get('/acak-no-undian', 'HomeController@acakNomorUndian');
Route::get('/acak', 'HomeController@acak');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
