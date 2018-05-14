<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Paginado;
use App\Models\Juego;
use App\Models\Categoria;

class IndexController extends Controller
{
    protected function getJuegos(Request $request, $pag = 1){
        $juegos = Juego::select();

        return $this->getData($juegos, $pag);
    }

    protected function getJuegosByCategorias(Request $request, $slug = "", $pag = 1){
        $juegos = Juego::whereHas('categorias', function ($query) use ($slug) {
            $query->where('categorias.slug', '=', $slug);
        });

        return $this->getData($juegos, $pag);
    }

    private function getData($juegos, $pag){
        $juegos->select("nombre", "descripcion", "img", "slug")->orderBy('created_at', "desc");
        $paginado = Paginado::generar($juegos, "index", 1, $pag, 3);

        $juegos = $juegos->get()->each(function($juego){
            $juego->setUrl();
        });

        return view('frontEnd/index', ["juegos" => $juegos, "paginado" => $paginado]);
    }
}
