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

//Auth routes
Auth::routes();

//FrontEnd
Route::get('/', 'frontEnd\indexController@getJuegos')->name('index');
Route::get('/perfil','frontEnd\PerfilController@perfil')->name('perfil');

//BackEnd Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', "name" => "admin"], function () {
 	Route::get('/', 'MainController@index')->name('mainAdmin');
 });

//BackEnd Delevep
Route::group(['prefix' => 'desarrollador', 'middleware' => 'desarrollador', "name" => "desarrollador"], function () {
 	Route::get('/', 'MainController@index')->name('mainDesarrollador');
 });