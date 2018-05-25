<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
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
        return view('backEnd/develop/juegos/crear', ["categorias" => $categorias, "plataformas" => $plataformas]);
    }

    protected function postCrear(Request $request){
        //validate
        $this->validate(request(), [
            'nombre' => 'required|max:30',
            'desc' => 'required|max:500',
            'tipo' => 'required',
            'img' => 'required|file|image',
            'urlExterna' => 'required_if:tipo,url',
            'categoria' => 'required',
            'plataforma' => 'required',
        ]);

        //get inputs
        $nombre = $request->input("nombre");
        $desc = $request->input("desc");
        $tipo = $request->input("tipo");
        $logo = request()->file("img");
        $urlExterna = $request->input("urlExterna") ?: "";
        $categorias = $request->input("categoria");
        $plataformas = $request->input("plataforma");
        if($this->existeYNoEstaVacio($request->input("compilar")) || 
            $this->existeYNoEstaVacio($request->input("guardar"))){
            $visible = ($request->input("visible") !== null) ? 1 : 0;
        }else{
            $visible = 0;
        }
        

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
        $juego->img = $logo->store("private/juegos/$juego->slug/img/portada");
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

        return redirect()->action('BackEnd\Desarrollador\JuegosController@getEditar', ["slug"=> $juego->slug]);
    }

    protected function getEditar(Request $request, $slug){
        $juego = Juego::where("slug", $slug)->firstOrFail();
        if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');
        //add categorias
        $misCategorias = Categoria::get();
        foreach ($misCategorias as $misCategoria) {
            $misCategoria->seleccionado = 0;
            foreach ($juego->categorias as $value) {
                if($value->slug == $misCategoria->slug){
                    $misCategoria->seleccionado = 1;
                    break;
                }
            }
        }
        unset($juego->categorias);
        
        //add plataformas
        $misPlataformas = Plataforma::get();
        foreach ($misPlataformas as $misPlataforma) {
            $misPlataforma->seleccionado = 0;
            foreach ($juego->plataformas as $value) {
                if($value->slug == $misPlataforma->slug){
                    $misPlataforma->seleccionado = 1;
                    break;
                }
            }
        }
        unset($juego->plataformas);

        $juego->files->each(function($model){
            $model->getPrivateContent();
        });
        $juego->setUrlImagePublic();

        return view('backEnd/develop/juegos/edicion', ["categorias" => $misCategorias, "plataformas" => $misPlataformas, "juego" => $juego]);

    }

    protected function putEditar(Request $request, $slug){
        $juego = Juego::where("slug", $slug)->firstOrFail();
        if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

        //validate
        $this->validate(request(), [
            'nombre' => 'required|max:30',
            'desc' => 'required|max:500',
            'tipo' => 'required',
            'img' => 'file|image',
            'urlExterna' => 'required_if:tipo,url',
            'categoria' => 'required',
            'plataforma' => 'required',
        ]);


        //get inputs
        $nombre = $request->input("nombre");
        $desc = $request->input("desc");
        $tipo = $request->input("tipo");
        $logo = request()->file("img");
        $urlExterna = $request->input("urlExterna") ?: "";
        $categorias = $request->input("categoria");
        $plataformas = $request->input("plataforma");
        if($this->existeYNoEstaVacio($request->input("compilar")) || 
            $this->existeYNoEstaVacio($request->input("guardar"))){
            $visible = ($request->input("visible") !== null) ? 1 : 0;
        }else{
            $visible = 0;
        }

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
            if(Storage::disk('local')->exists($juego->img))
                Storage::disk('local')->delete($juego->img);
            $juego->img = $logo->store("private/juegos/$juego->slug/img/portada");
        }

        $juego->save();


        JuegoCategoria::where("id_juego", $juego->id)->delete();
        $this->insertCategorias($juego, $categorias);

        JuegoPlataforma::where("id_juego", $juego->id)->delete();
        $this->insertPlataforma($juego, $plataformas);

        //Subir los archivos del juego e insertar datos basicos en la bbdd
        if($tipo == "creado"){
            $files = ["css"=>[], "js"=>[]];{}
            $compile = $this->existeYNoEstaVacio($request->input("compilar"));
            if($compile){
                $this->deleteAllFilesCode($juego);
                $files["css"] = $this->uploadCode($request, "css", $juego);
                $files["js"] = $this->uploadCode($request, "js", $juego);
                $this->uploadCodeHtml($request, $juego, $files);
            }else{
                //!!!No echo
            }
        }else{
            $this->deleteAllFilesCode($juego);
        }

        return redirect()->action('BackEnd\Desarrollador\JuegosController@getEditar', ["slug" => $juego->slug]);
    }

    protected function deleteJuego(Request $request, $slug){
        $juego = Juego::where("slug", $slug)->firstOrFail();
        if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

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
            Storage::disk('local')->delete([$value->ruta, $value->rutaMin]);
            $value->delete();
        }
    }

    //Guardar el codigo js y css
    private function uploadCode(Request $request, $tipo, Juego $juego){
        if($tipo != "css" && $tipo != "js") return null;

        $i = 0;
        $arr = [];
        $path = "private/juegos/$juego->slug/";
        
        while (($content = $request->input($tipo.$i)) !== null) {
            $name = uniqid().".".$tipo;
            $fullPath = $path."$tipo/".$name;
            $fullPathMin = $path."min/$tipo/".$name;
            if(Storage::disk('local')->put($fullPath, $content)){
                if(Storage::disk('local')->put($fullPathMin, $content)){
                    $fileSystem = new JuegoFileSystem();
                    $fileSystem->nombre = $request->input("name$tipo".$i);
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

    //Guardar el codigo html
    private function uploadCodeHtml(Request $request, Juego $juego, $arr){
        $path = "private/juegos/".$juego->slug."/";
        if (($content = $request->input("html")) === null)$content = "";

        $name = uniqid().".html";
        $fullPath = $path.$name;
        $fullPathMin = $path."min/".$name;

        if(Storage::disk('local')->put($fullPath, $content)){
            $content = $this->getHtmlFullCode($content, $arr);
            Storage::disk('local')->put($fullPathMin, $content);

            $fileSystem = new JuegoFileSystem();
            $fileSystem->nombre = $request->input("namehtml");
            $fileSystem->id_juego = $juego->id;
            $fileSystem->ruta = $fullPath;
            $fileSystem->rutaMin = $fullPathMin;
            $fileSystem->tipo = "html";
            $fileSystem->order = 0;
            $fileSystem->save();
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

    //Devuelve el html completo
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
