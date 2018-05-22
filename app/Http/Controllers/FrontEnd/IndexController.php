<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Paginado;
use App\Models\Juego;
use App\Models\Categoria;

class IndexController extends Controller
{
    const MAXBUTTONS = 3;
    const MAXITEMS = 16;

    protected function getJuegos(Request $request, $pag = 1){
        $juegos = Juego::select("nombre", "descripcion", "img", "slug")->where("visible", 1)->orderBy("created_at", "desc");

        $paginado = Paginado::generar($juegos, IndexController::MAXITEMS, $pag, IndexController::MAXBUTTONS, [$this, "getRouteIndex"]);

        $juegos = $juegos->get()->each(function($juego){
            $juego->setUrl();
            $juego->setUrlImagePublic();
        });

        return view('frontEnd/index', ["juegos" => $juegos, "paginado" => $paginado]);
    }

    protected function getJuegosByCategorias(Request $request, $slug, $pag = 1){
        $this->slug = $slug;

        $juegos = Juego::select("nombre", "descripcion", "img", "slug")
        ->whereHas('categorias', function ($query) use ($slug) {
            $query->where('categorias.slug', '=', $slug);
        })->where("visible", 1)->orderBy("created_at", "desc");

        $paginado = Paginado::generar($juegos, IndexController::MAXITEMS, $pag, IndexController::MAXBUTTONS, [$this, "getRouteCategoria"]);

        $juegos = $juegos->get()->each(function($juego){
            $juego->setUrl();
            $juego->setUrlImagePublic();
        });

        return view('frontEnd/index', ["juegos" => $juegos, "paginado" => $paginado]);
    }

    public function getRouteCategoria($pag){
        return route("juegosPorCategoria", ['pag' => $pag, 'slug' => $this->slug]);
    }
    
    public function getRouteIndex($pag){
        return route("indexPag", ['pag' => $pag]);
    }
}
