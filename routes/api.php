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

Route::post('/addComentario','Api\Juegosontroller@addComentario')->name('buscar');
Route::post('/addSubComentario','Api\JuegosController@addSubComentario')->name('buscar');