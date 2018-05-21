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
use App\Models\JuegoFileSystem;
use Illuminate\Support\Facades\Storage;

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
        $urlExterna = $request->input("urlExterna"); //!!!mirar si el nombre es correcto
        $categorias = $request->input("categoria");
        $plataformas = $request->input("plataforma");

        //validate
        Validate::validate($nombre, "nombre", "required,maxLength:30", $errors);
        Validate::validate($desc, "descripcion", "required,maxLength:500", $errors);
        Validate::validate($logo, "logo", "required,imgValidFormat", $errors);
        Validate::validate($tipo, "tipo", "required", $errors);
        if(empty($errors) && $tipo == "url")
            Validate::validate($urlExterna, "link", "required", $errors);
        Validate::validate($categorias, "categoria", "required", $errors);
        Validate::validate($plataformas, "plataforma", "required", $errors);

        //if exist error return the error
        if(!empty($errors)) return response(json_encode(["status" => "0", "errors" => $errors]), 200)->header('Content-Type', 'application/json');

        //insert data
        $juego = new Juego();
        $juego->id_creador = Auth::user()->id;
        $juego->nombre = $nombre;
        $juego->descripcion = $desc;
        $juego->visible = $visible;
        $juego->save();
        if($tipo == "url")
            $juego->url = $urlExterna;
        else if($tipo == "creado")
            $juego->url = route("storage.codigoJuego",["slug" => $juego->slug, "tipo" => "html"]);
        $juego->img = $logo->store("public/juegos/$juego->slug/img/portada");
        $juego->save();

        $this->insertCategorias($juego, $categorias);
        $this->insertPlataforma($juego, $plataformas);

        //Subir los archivos del juego e insertar datos basicos en la bbdd
        if($tipo == "creado"){
            $files = ["css"=>[], "js"=>[]];
            $files["css"] = $this->uploadCode($request, "css", $juego);
            $files["js"] = $this->uploadCode($request, "js", $juego);
            $this->uploadCodeHtml($request, $juego, $files);
        }

        return redirect()->action('BackEnd\Desarrollador\JuegosController@getList');
    }

    protected function getEditar(Request $request, $slug){
        $juego = Juego::where("slug", $slug)->firstOrFail();
        if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');
        //add categorias
        $misCategorias = Categoria::get();
        foreach ($misCategorias as $misCategoria) {
            foreach ($juego->categorias as $value) {
                if($value->slug == $misCategoria->slug)
                    $misCategoria->seleccionado = 1;
                else
                    $misCategoria->seleccionado = 0;
            }
        }
        unset($juego->categorias);
        $juego->categorias = $misCategorias;

        //add plataformas
        $misPlataformas = Plataforma::get();
        foreach ($misPlataformas as $misPlataforma) {
            foreach ($juego->plataformas as $value) {
                if($value->slug == $misPlataforma->slug)
                    $misPlataforma->seleccionado = 1;
                else
                    $misPlataforma->seleccionado = 0;
            }
        }
        unset($juego->plataformas);
        $juego->plataformas = $misPlataformas;


        $juego->files->each(function($model){
            $model->getPrivateContent();
        });
        $juego->setUrlImagePublic();
        die(json_encode($juego));
        return view('backEnd/develop/juegos/edicion');
    }

    //AJAX CALL
    protected function putEditar(Request $request, $slug){
        $juego = Juego::where("slug", $slug)->firstOrFail();
        if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

        $errors = [];
        
        //get inputs
        $nombre = $request->input("nombre");
        $desc = $request->input("desc");
        $visible = ($request->input("visible") !== null) ? 1 : 0;
        $icono = $request->input("icono");
        $tipo = $request->input("tipo");
        $logo = request()->file("img");
        $urlExterna = $request->input("urlExterna"); //!!!mirar si el nombre es correcto
        $categorias = $request->input("categoria");
        $plataformas = $request->input("plataforma");

        //validate
        Validate::validate($nombre, "nombre", "maxLength:30", $errors);
        Validate::validate($desc, "descripcion", "maxLength:500", $errors);
        Validate::validate($logo, "logo", "imgValidFormat", $errors);
        Validate::validate($tipo, "tipo", "required", $errors);
        Validate::validate($categorias, "categoria", "required", $errors);
        Validate::validate($plataformas, "plataforma", "required", $errors);

        //if exist error return the error
        if(!empty($errors)) return response(json_encode(["status" => "0", "errors" => $errors]), 200)->header('Content-Type', 'application/json');

        //update data
        if($this->existeYNoEstaVacio($nombre))
            $juego->nombre = $nombre;

        if($this->existeYNoEstaVacio($desc))
            $juego->descripcion = $desc;

        if($this->existeYNoEstaVacio($visible))
            $juego->visible = $visible;

        if($tipo == "url")
            $juego->url = $urlExterna;

        if($this->existeYNoEstaVacio($logo)){
            if(Storage::delete($juego->img))
                $juego->img = $logo->store("public/juegos/$juego->slug/img/portada");
        }

        JuegoCategoria::where("id_juego", $juego->id)->delete();
        $this->insertCategorias($juego, $categorias);

        JuegoPlataforma::where("id_juego", $juego->id)->delete();
        $this->insertPlataforma($juego, $plataformas);

        //Subir los archivos del juego e insertar datos basicos en la bbdd
        if($tipo == "creado"){
            $this->deleteAllFilesCode();
            $files = ["css"=>[], "js"=>[]];
            $files["css"] = $this->uploadCode($request, "css", $juego);
            $files["js"] = $this->uploadCode($request, "js", $juego);
            $this->uploadCodeHtml($request, $juego, $files);
        }

        return view('backEnd/develop/juegos/edicion');
    }

    protected function deleteJuego(Request $request, $slug){
        $juego = Juego::where("slug", $slug)->firstOrFail();
        if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');
        //!!!Delete all files

        $juego->delete();
        return redirect()->action('BackEnd\Desarrollador\JuegosController@getList');
    }

    private function insertCategorias(Juego $juego, $categorias){
        foreach ($categorias as $value) {
            $categoria = $this->getCategoriaPorSlug($value);
            if(isset($categoria)){
                $juegoCategoria = new JuegoCategoria();
                $juegoCategoria->id_juego = $juego->id;
                $juegoCategoria->id_categoria = $categoria->id;
                $juegoCategoria->save();
            }
        }
    }

    private function insertPlataforma(Juego $juego, $plataformas){
        foreach ($plataformas as $value) {
            $plataforma = $this->getPlataformaPorSlug($value);
            if(isset($plataforma)){
                $juegoPlataforma = new JuegoPlataforma();
                $juegoPlataforma->id_juego = $juego->id;
                $juegoPlataforma->id_plataforma = $plataforma->id;
                $juegoPlataforma->save();
            }
        }
    }

    private function deleteAllFilesCode(Juego $juego){
        $fileSystem = JuegoFileSystem::where("id_juego", $juego->id)->get();
        foreach ($fileSystem as $value) {
            Storage::delete([$value->ruta, $value->rutaMin]);
        }
        $fileSystem->delete();
    }

    private function uploadCode(Request $request, $tipo, Juego $juego){
        if($tipo != "css" && $tipo != "js") return null;

        $i = 0;
        $arr = [];
        $path = "public/juegos/$juego->slug/";

        while (($content = $request->input($tipo.$i)) !== null) {
            $name = uniqid().".".$tipo;
            $fullPath = $path."$tipo/".$name;
            $fullPathMin = $path."min/$tipo/".$name;
            if(Storage::disk('local')->put($fullPath, $content)){
                if(Storage::disk('local')->put($fullPathMin, $content)){
                    $fileSystem = new JuegoFileSystem();
                    $fileSystem->nombre = "temp";//$request->input("name$tipo".$i);
                    $fileSystem->id_juego = $juego->id;
                    $fileSystem->ruta = $fullPath;
                    $fileSystem->rutaMin = $fullPathMin;
                    $fileSystem->tipo = $tipo;
                    $fileSystem->order = $i;
                    $fileSystem->save();
                    $arr[] = ["slug" => $juego->slug, "order" => $i];
                }
            }
            $i++;
        }
        return $arr;
    }

    private function uploadCodeHtml(Request $request, Juego $juego, $arr){
        $path = "public/juegos/".$juego->slug."/";
        if (($content = $request->input("html")) === null)$content = "";

        $name = uniqid().".html";
        $fullPath = $path.$name;
        $fullPathMin = $path."min/".$name;

        if(Storage::disk('local')->put($fullPath, $content)){
            $content = $this->getHtmlFullCode($content, $arr);
            if(Storage::disk('local')->put($fullPathMin, $content)){
                $fileSystem = new JuegoFileSystem();
                $fileSystem->nombre = "temp";//$request->input("namehtml");
                $fileSystem->id_juego = $juego->id;
                $fileSystem->ruta = $fullPath;
                $fileSystem->rutaMin = $fullPathMin;
                $fileSystem->tipo = "html";
                $fileSystem->order = 0;
                $fileSystem->save();
            }
        }
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

    private function getHtmlFullCode($html, $arr){
        $style = "";
        foreach ($arr["css"] as $url) {
            $style .= "<link href='".route("storage.codigoJuego",["slug" => $url["slug"], "tipo" => "css", "num" => $url["order"]])."' rel='stylesheet'>";
        }

        $js = "";
        foreach ($arr["js"] as $url) {
            $js .= "<script src='".route("storage.codigoJuego",["slug" => $url["slug"], "tipo" => "js", "num" => $url["order"]])."'></script>";
        }

        return "<!DOCTYPE html><head>$style</head><body>$html$js</body></html>";
    }
}
