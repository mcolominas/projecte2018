<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Paginado;
use App\Models\Juego;
class IndexController extends Controller
{
    protected function getJuegos(Request $request, $pag = 1){
    	$juegos = Juego::select("nombre", "descripcion", "img", "slug")->orderBy('created_at', "desc");

    	$paginado = Paginado::generar($juegos, "indexPag", 16, $pag, 3);

		$juegos = $juegos->get()->each(function($juego){
    		$juego->setUrl();
    	});

    	return view('paginas/index', ["juegos" => $juegos, "paginado" => $paginado]);
    }
}
