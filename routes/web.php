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
Route::get('/p/{pag?}', 'frontEnd\IndexController@getJuegos')->name('indexPag');
Route::get('/categoria/{slug}/{pag?}', 'frontEnd\IndexController@getJuegosByCategorias')->name('juegosPorCategoria');


Route::name('perfil')->group(function () {
	Route::get('/perfil','frontEnd\PerfilController@getPerfil');
	Route::post('/perfil','frontEnd\PerfilController@postCorreo')->name('.datos');
});

Route::get('/juego/{slug}','frontEnd\IndexController@perfil')->name('juego');

//BackEnd Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', "name" => "admin"], function () {
	Route::get('/', 'MainController@index')->name('mainAdmin');
});

//BackEnd Delevep
Route::group(['prefix' => 'desarrollador', 'middleware' => 'desarrollador', "name" => "desarrollador"], function () {
	Route::get('/', 'MainController@index')->name('mainDesarrollador');
});