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
Route::get('/', 'frontEnd\IndexController@getJuegos')->name('index');
Route::get('/pag/{pag}', 'frontEnd\IndexController@getJuegos')->name('indexPag');
Route::get('/categoria/{slug}', 'frontEnd\IndexController@getJuegos')->name('indexCategoria');
Route::get('/categoria/{slug}/pag/{pag}', 'frontEnd\IndexController@getJuegos')->name('indexCategoriaPag');

Route::get('/perfil','frontEnd\PerfilController@getPerfil')->name('perfil');
Route::post('/perfil','frontEnd\PerfilController@postCorreo')->name('perfil.correo');

Route::get('/juego/{slug}','frontEnd\IndexController@perfil')->name('juego');

//BackEnd Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', "name" => "admin"], function () {
 	Route::get('/', 'MainController@index')->name('mainAdmin');
 });

//BackEnd Delevep
Route::group(['prefix' => 'desarrollador', 'middleware' => 'desarrollador', "name" => "desarrollador"], function () {
 	Route::get('/', 'MainController@index')->name('mainDesarrollador');
 });