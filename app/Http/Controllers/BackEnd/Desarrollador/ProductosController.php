<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Tienda;
use App\Models\Juego;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    protected function getListJuegos(Request $request){
		$user = Auth::user();
		$juegos = Juego::where("id_creador", $user->id)->orderBy("created_at")->get();

		return view('backEnd/develop/productos/listaJuegos', ["juegos" => $juegos]);
	}

	protected function getListProductos(Request $request, $slugJuego){
		$juego = Juego::where("slug", $slugJuego)->firstOrFail();
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$productos = Tienda::where("id_juego", $juego->id)->orderBy("created_at")->get();

		return view('backEnd/develop/productos/listaProductos', ["productos" => $productos, "slugJuego" => $slugJuego]);
	}

	protected function getCrear(Request $request, $slugJuego){
		$juego = Juego::where("slug", $slugJuego)->firstOrFail();
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		return view('backEnd/develop/productos/crear');
	}

	protected function postCrear(Request $request, $slugJuego){
		$juego = Juego::where("slug", $slugJuego)->firstOrFail();
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$this->validate(request(), [
			'nombre' => 'required|max:30',
			'descripcion' => 'required|max:255',
			'coste' => 'required|integer',
			'imagen' => 'required|file|image',
		]);

		$producto = new Tienda();
		$producto->id_juego = $juego->id;
		$producto->nombre = $request->input("nombre");
		$producto->descripcion = $request->input("descripcion");
		$producto->coste = $request->input("coste");
		$producto->img = request()->file("imagen")->store("private/juegos/$juego->slug/img/productos");
		$producto->save();

		return redirect()->action('BackEnd\Desarrollador\ProductosController@putEditar', ["slugProducto" => $producto->slug]);
	}

	protected function getEditar(Request $request, $slugProducto){
		$producto = Tienda::where("slug", $slugProducto)->firstOrFail();
		$juego = $producto->juego;
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');
		$producto->setUrlImagePublic();

		return view('backEnd/develop/productos/edicion', ["producto" => $producto]);
	}

	protected function putEditar(Request $request, $slugProducto){
		$producto = Tienda::where("slug", $slugProducto)->firstOrFail();
		$juego = $producto->juego;
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$this->validate(request(), [
			'nombre' => 'required|max:30',
			'descripcion' => 'required|max:255',
			'coste' => 'required|integer',
			'imagen' => 'file|image',
		]);

		$producto->nombre = $request->input("nombre");
		$producto->descripcion = $request->input("descripcion");
		$producto->coste = $request->input("coste");
		if($this->existeYNoEstaVacio(request()->file("imagen"))){
			if(Storage::disk('local')->exists($producto->img)) Storage::delete($producto->img);
			
			$producto->img = request()->file("imagen")->store("private/juegos/$juego->slug/img/productos");
		}

		$producto->save();

		return redirect()->action('BackEnd\Desarrollador\ProductosController@putEditar', ["slugProducto" => $producto->slug]);
	}

	protected function deleteProducto(Request $request, $slugProducto){
		$producto = Tienda::where("slug", $slugProducto)->firstOrFail();
		$juego = $producto->juego;
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		if(Storage::disk('local')->exists($producto->img)) Storage::delete($producto->img);
		
		$producto->delete();

		return redirect()->action('BackEnd\Desarrollador\ProductosController@getListProductos', ["slugJuego" => $juego->slug]);
	}
}
