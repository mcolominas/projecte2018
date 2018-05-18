<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Juego;
use App\Models\Categoria;
use App\Models\Plataforma;
use App\Models\JuegoCategoria;
use App\Models\JuegoPlataforma;

class JuegosController extends Controller
{
    protected function getList(Request $request){
    	$user = Auth::user();
    	$juegos = Juego::where("id_creador", $user->id)->orderBy("created_at")->get();
    	return view('backEnd/develop/juegos/lista', ["juegos" => $juegos]);
    }

    protected function getCrear(Request $request){
        $categorias = Categoria::select("nombre", "slug")->orderBy("nombre")->get();
        $plataformas = Plataforma::select("nombre", "slug")->orderBy("nombre")->get();
        return view('backEnd/develop/juegos/edicion', ["categorias" => $categorias, "plataformas" => $plataformas]);
    }

    //AJAX CALL
    protected function postCrear(Request $request){
        $errors = [];
        
        //get inputs
        $nombre = $request->input("nombre");
        $desc = $request->input("desc");
        $visible = ($request->input("visible") !== null) ? 1 : 0;
        $icono = $request->input("icono");
        //$url = $request->input("url");
        $tipo = $request->input("tipo");
        $categorias = $request->input("categoria");
        $plataformas = $request->input("plataforma");

        //validate
        Validate::validate($nombre, "nombre", "required,maxLength:30", $errors);
        Validate::validate($desc, "desc", "required,maxLength:500", $errors);
        //Validate::validate($url, "required", $errors);
        Validate::validate($tipo, "tipo", "required", $errors);
        Validate::validate($categorias, "categoria", "required", $errors);
        Validate::validate($plataformas, "plataforma", "required", $errors);

        //if exist error return error
        if(!empty($errors)) return response(json_encode(["status" => "0", "errors" => $errors]), 200)->header('Content-Type', 'application/json');
        
        //insert data
        $juego = new Juego();
        $juego->id_creador = Auth::user()->id;
        $juego->nombre = $nombre;
        $juego->descripcion = $desc;
        $juego->img = "img";
        $juego->url = "asas";
        $juego->visible = $visible;
        $juego->save();

        $juegoCategoria = new JuegoCategoria();
        foreach ($categorias as $value) {
            $categoria = $this->getCategoriaPorSlug($value);
            if(isset($categoria)){
                $juegoCategoria->id_juego = $juego->id;
                $juegoCategoria->id_categoria = $categoria->id;
                $juegoCategoria->save();
            }
        }

        $juegoPlataforma = new JuegoCategoria();
        foreach ($plataformas as $value) {
            $plataforma = $this->getPlataformaPorSlug($value);
            if(isset($plataforma)){
                $juegoPlataforma->id_juego = $juego->id;
                $juegoPlataforma->id_plataforma = $plataforma->id;
                $juegoPlataforma->save();
            }
        }

        die("a");


        return view('backEnd/develop/juegos/edicion');
    }

    protected function getEditar(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    protected function putEditar(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    protected function deleteJuego(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    private function getPlataformaPorSlug($slug){
        if($this->existeYNoEstaVacio($slug)){
            $j = Plataforma::where("slug", $slug)->get();
            if($j->count() == 1)
                return $j->first();
        }
        return null;
    }

    private function getCategoriaPorSlug($slug){
        if($this->existeYNoEstaVacio($slug)){
            $j = Categoria::where("slug", $slug)->get();
            if($j->count() == 1)
                return $j->first();
        }
        return null;
    }
}
