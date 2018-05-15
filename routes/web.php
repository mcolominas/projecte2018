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
Route::get('/', 'FrontEnd\IndexController@getJuegos')->name('index');
Route::get('/p/{pag?}', 'FrontEnd\IndexController@getJuegos')->name('indexPag');
Route::get('/categoria/{slug}/{pag?}', 'FrontEnd\IndexController@getJuegosByCategorias')->name('juegosPorCategoria');


Route::name('perfil')->group(function () {
	Route::get('/perfil','FrontEnd\PerfilController@getPerfil');
	Route::post('/perfil','FrontEnd\PerfilController@postCorreo')->name('.datos');
});

Route::get('/juego/{slug}','FrontEnd\JuegoController@index')->name('juego');

//BackEnd Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', "name" => "admin"], function () {
	Route::get('/', 'BackEnd\Admin\IndexController@index');
});

//BackEnd Delevep
Route::group(['prefix' => 'desarrollador', 'middleware' => 'desarrollador', "name" => "desarrollador"], function () {
	Route::get('/', 'BackEnd\Desarrollador\indexController@index')->name('desarrollador');
	Route::get('/crearJuego','BackEnd\Desarrollador\indexController@crear')->name('desarrollador.crearJuego');
});


