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

//Get datos juego
Route::get('/uploads/juegos/portada/{slug}', 'StorageController@getPortadaJuego')->name("storage.portadaJuego");
Route::get('/uploads/juegos/logros/{slug}', 'StorageController@getLogroJuego')->name("storage.logroJuego");
Route::get('/uploads/juegos/producto/{slug}', 'StorageController@getProductoJuego')->name("storage.productoJuego");
Route::get('/uploads/juego/{slug}/{tipo}/{num?}', 'StorageController@getCodigoJuego')->name("storage.codigoJuego");
Route::get('/storage/js/getApiJuego', 'StorageController@getJsApiJuego')->name("storage.jsApiJuego");
Route::get('/storage/js/jquery', 'StorageController@getJsJQuery')->name("storage.jsJQuery");


///storage/js/getApiJuego
Route::name('perfil')->group(function () {
	Route::get('/perfil','FrontEnd\PerfilController@getPerfil');
	Route::post('/perfil','FrontEnd\PerfilController@postCorreo')->name('.datos');
});

Route::get('/juego/{slug}','FrontEnd\JuegoController@index')->name('juego');
Route::get('/misLogros','FrontEnd\LogrosController@index')->name('misLogros');

//BackEnd Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', "name" => "admin"], function () {
	Route::get('/', 'BackEnd\Admin\IndexController@index');
});

//BackEnd Delevep
Route::group(['prefix' => 'desarrollador', 'middleware' => 'desarrollador', "name" => "desarrollador"], function () {
	Route::get('/', 'BackEnd\Desarrollador\JuegosController@getList')->name('desarrollador');

	Route::get('/crear/juego','BackEnd\Desarrollador\JuegosController@getCrear')->name('desarrollador.crearJuego');
	Route::post('/crear/juego','BackEnd\Desarrollador\JuegosController@postCrear');

	Route::get('/editar/juego/{slug}','BackEnd\Desarrollador\JuegosController@getEditar')->name('desarrollador.editarJuego');
	Route::put('/editar/juego/{slug}','BackEnd\Desarrollador\JuegosController@putEditar');

	Route::get('/eliminar/juego/{slug}','BackEnd\Desarrollador\JuegosController@deleteJuego')->name('desarrollador.eliminarJuego');


	Route::get('/ver/logros/{slugJuego}', 'BackEnd\Desarrollador\LogrosController@getListLogros')->name('desarrollador.verLogros');
	Route::get('/ver/juegos/logros', 'BackEnd\Desarrollador\LogrosController@getListJuegos')->name('desarrollador.verJuegosLogros');

	Route::get('/crear/logro/{slugJuego}','BackEnd\Desarrollador\LogrosController@getCrear')->name('desarrollador.crearLogro');
	Route::post('/crear/logro/{slugJuego}','BackEnd\Desarrollador\LogrosController@postCrear');

	Route::get('/editar/logro/{slugLogro}','BackEnd\Desarrollador\LogrosController@getEditar')->name('desarrollador.editarLogro');
	Route::put('/editar/logro/{slugLogro}','BackEnd\Desarrollador\LogrosController@putEditar');

	Route::get('/eliminar/logro/{slugLogro}','BackEnd\Desarrollador\LogrosController@deletelogro')->name('desarrollador.eliminarLogro');


	Route::get('/ver/productos/{slug}', 'BackEnd\Desarrollador\ProductosController@getListProductos')->name('desarrollador.verProductos');
	Route::get('/ver/juegos/productos', 'BackEnd\Desarrollador\ProductosController@getListJuegos')->name('desarrollador.verJuegosProductos');

	Route::get('/crear/producto/{slugJuego}','BackEnd\Desarrollador\ProductosController@getCrear')->name('desarrollador.crearProducto');
	Route::post('/crear/producto/{slugJuego}','BackEnd\Desarrollador\ProductosController@postCrear');

	Route::get('/editar/producto/{slugProducto}','BackEnd\Desarrollador\ProductosController@getEditar')->name('desarrollador.editarProducto');
	Route::put('/editar/producto/{slugProducto}','BackEnd\Desarrollador\ProductosController@putEditar');

	Route::get('/eliminar/producto/{slugProducto}','BackEnd\Desarrollador\ProductosController@deleteProducto')->name('desarrollador.eliminarProducto');
});


