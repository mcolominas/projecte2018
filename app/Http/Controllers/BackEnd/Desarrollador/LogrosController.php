<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Logro;
use App\Models\Juego;
use Illuminate\Support\Facades\Storage;

class LogrosController extends Controller
{

	protected function getListJuegos(Request $request){
		$user = Auth::user();
		$juegos = Juego::where("id_creador", $user->id)->orderBy("created_at")->get();

		return view('backEnd/develop/logros/listaJuegos', ["juegos" => $juegos]);
	}

	protected function getListLogros(Request $request, $slugJuego){
		$juego = Juego::where("slug", $slugJuego)->firstOrFail();
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$logros = Logro::where("id_juego", $juego->id)->orderBy("created_at")->get();

		return view('backEnd/develop/logros/listaLogros', ["logros" => $logros, "slugJuego" => $slugJuego]);
	}

	protected function getCrear(Request $request, $slugJuego){
		$juego = Juego::where("slug", $slugJuego)->firstOrFail();
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');


		return view('backEnd/develop/logros/crear');
	}

	protected function postCrear(Request $request, $slugJuego){
		$juego = Juego::where("slug", $slugJuego)->firstOrFail();
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$this->validate(request(), [
			'nombre' => 'required|max:30',
			'descripcion' => 'required|max:255',
			'coins' => 'required|integer|between:0,50',
			'tiempoMinimo' => 'required|integer',
			'tiempoMaximo' => 'required|integer',
			'imagen' => 'required|file|image',
		]);

		$logro = new Logro();
		$logro->id_juego = $juego->id;
		$logro->nombre = $request->input("nombre");
		$logro->descripcion = $request->input("descripcion");
		$logro->coins = $request->input("coins");
		$logro->estado = "aceptado";
		$logro->tiempo_minimo = $request->input("tiempoMinimo");
		$logro->tiempo_maximo = $request->input("tiempoMaximo");
		$logro->img = request()->file("imagen")->store("private/juegos/$juego->slug/img/logros");
		$logro->save();

		return redirect()->action('BackEnd\Desarrollador\LogrosController@putEditar', ["slugLogro" => $logro->slug]);
	}

	protected function getEditar(Request $request, $slugLogro){
		$logro = Logro::where("slug", $slugLogro)->firstOrFail();
		$juego = $logro->juego;
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$logro->setUrlImagePublic();

		return view('backEnd/develop/logros/edicion', ["logro" => $logro]);
	}

	protected function putEditar(Request $request, $slugLogro){
		$logro = Logro::where("slug", $slugLogro)->firstOrFail();
		$juego = $logro->juego;
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		$this->validate(request(), [
			'nombre' => 'required|max:30',
			'descripcion' => 'required|max:255',
			'coins' => 'required|integer|between:0,50',
			'tiempoMinimo' => 'required|integer',
			'tiempoMaximo' => 'required|integer',
			'imagen' => 'file|image',
		]);

		$logro->nombre = $request->input("nombre");
		$logro->descripcion = $request->input("descripcion");
		$logro->coins = $request->input("coins");
		$logro->tiempo_minimo = $request->input("tiempoMinimo");
		$logro->tiempo_maximo = $request->input("tiempoMaximo");
		if($this->existeYNoEstaVacio(request()->file("imagen"))){
			if(Storage::disk('local')->exists($logro->img)) Storage::delete($logro->img);

			$logro->img = request()->file("imagen")->store("private/juegos/$juego->slug/img/logros");
		}

		$logro->save();

		return redirect()->action('BackEnd\Desarrollador\LogrosController@getEditar', ["slugLogro" => $logro->slug]);
	}

	protected function deleteLogro(Request $request, $slugLogro){
		$logro = Logro::where("slug", $slugLogro)->firstOrFail();
		$juego = $logro->juego;
		if(Auth::user()->id != $juego->id_creador) abort(404, 'Unauthorized action.');

		if(Storage::disk('local')->exists($logro->img)) Storage::delete($logro->img);
		
		$logro->delete();

		return redirect()->action('BackEnd\Desarrollador\LogrosController@getListLogros', ["slugJuego" => $juego->slug]);
	}
}
