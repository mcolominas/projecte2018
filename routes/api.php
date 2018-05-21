<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/buscar','Api\buscadorController@index')->name('buscar');


Route::post('/addComentario','Api\JuegosController@addComentario');
Route::post('/addSubComentario','Api\JuegosController@addSubComentario');
Route::post('/addReporte','Api\JuegosController@addReporte');


Route::get('/juego/getInfoUser','Api\SystemJuegoController@getDatosUser');
Route::get('/juego/getLogros','Api\SystemJuegoController@getLogros');
Route::get('/juego/getProductos','Api\SystemJuegoController@getProductos');
Route::get('/juego/comprar','Api\SystemJuegoController@comprar');
Route::get('/juego/addLogro','Api\SystemJuegoController@addLogro');
Route::get('/juego/iniciarPartida','Api\SystemJuegoController@iniciarPartida');
Route::get('/juego/finalizarPartida','Api\SystemJuegoController@finalizarPartida');


