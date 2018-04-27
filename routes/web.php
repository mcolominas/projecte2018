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

Route::get('/', 'MainController@index')->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'admin', "name" => "admin"], function () {
 	Route::get('/', 'MainController@index')->name('mainAdmin');
 });

Route::group(['prefix' => 'desarrollador', 'middleware' => 'desarrollador', "name" => "desarrollador"], function () {
 	Route::get('/', 'MainController@index')->name('mainDesarrollador');
 });