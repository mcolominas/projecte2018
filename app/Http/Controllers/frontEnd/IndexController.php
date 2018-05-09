<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Paginado;
use App\Juego;
class IndexController extends Controller
{
    protected function getJuegos(Request $request, $pag = 1){
    	$juegos = Juego::select("nombre", "descripcion", "img", "slug")->orderBy('created_at', "desc");

    	$paginado = Paginado::generar($juegos, "indexPag", 1, $pag, 5);

		$juegos->get()->each(
    		function($juego){
    		$juego->setUrl();
    	});

    	return view('paginas/index', ["juegos" => $juegos, "paginado" => $paginado]);
    }
}
