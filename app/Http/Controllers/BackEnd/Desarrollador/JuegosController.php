<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Juego;
use App\Models\Categoria;
use App\Models\Plataforma;
use App\Models\JuegoCategoria;
use App\Models\JuegoPlataforma;
use Illuminate\Support\Facades\Storage;


//Storage::disk('local')->put('file.txt', 'Contents');
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
        $tipo = $request->input("tipo");
        $logo = request()->file("img");
        $categorias = $request->input("categoria");
        $plataformas = $request->input("plataforma");


        //validate
        Validate::validate($nombre, "nombre", "required,maxLength:30", $errors);
        Validate::validate($desc, "desc", "required,maxLength:500", $errors);
        //Validate::validate($url, "required", $errors);
        request()->validate(['img' => 'image']); //logo
        Validate::validate($tipo, "tipo", "required", $errors);
        Validate::validate($categorias, "categoria", "required", $errors);
        Validate::validate($plataformas, "plataforma", "required", $errors);

        //if exist error return the error
        if(!empty($errors)) return response(json_encode(["status" => "0", "errors" => $errors]), 200)->header('Content-Type', 'application/json');
        

        $files = ["css"=>[], "js"=>[]];
        $i = 0;
        while (($css = $request->input("css".$i)) !== null) {
            //Storage::disk('local')->put(uniqid(), 'Contents');
            echo $css;
            $i++;
        }
        die();

        //insert data
        $juego = new Juego();
        $juego->id_creador = Auth::user()->id;
        $juego->nombre = $nombre;
        $juego->descripcion = $desc;
        $juego->img = $logo->store('uploads\juegos\portada');
        $juego->visible = $visible;
        $juego->save();

        foreach ($categorias as $value) {
            $categoria = $this->getCategoriaPorSlug($value);
            if(isset($categoria)){
                $juegoCategoria = new JuegoCategoria();
                $juegoCategoria->id_juego = $juego->id;
                $juegoCategoria->id_categoria = $categoria->id;
                $juegoCategoria->save();
            }
        }

        foreach ($plataformas as $value) {
            $plataforma = $this->getPlataformaPorSlug($value);
            if(isset($plataforma)){
                $juegoPlataforma = new JuegoPlataforma();
                $juegoPlataforma->id_juego = $juego->id;
                $juegoPlataforma->id_plataforma = $plataforma->id;
                $juegoPlataforma->save();
            }
        }

        return redirect()->action('BackEnd\Desarrollador\JuegosController@getList');
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

    private function getHtmlFullCode($html, $cssArray, $jsArray){
        $style = "";
        foreach ($cssArray as $url) {
            $style .= '<link href="'.$url.'" rel="stylesheet">';
        }

        $js = "";
        foreach ($jsArray as $url) {
            $js .= '<script src="'.$url.'"></script>';
        }

        return "<!DOCTYPE html><head>$style</head><body>$html $min</body></html>";
    }
}
