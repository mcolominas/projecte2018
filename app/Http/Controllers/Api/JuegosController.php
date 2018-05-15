<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\Juego;

class JuegosController extends Controller
{
	protected function addComentario(Request $request){
		$mensaje = $request->input('mensaje');
		$slug = $request->input('slug');

		$juego = $this->getJuegoPorSlug($slug);
		if($juego->count() == 1){
			$comentario = new Comentario();
			$comentario->comentario = $mensaje;
			$comentario->id_juego = $juego->id;

			if($comentario->save())
				return response(json_encode(["status" => "1", "id" => $comentario->hash]), 200)->header('Content-Type', 'application/json');
		}
		return $this->returnError();
	}

	protected function addSubComentario(Request $request){
		$mensaje = $request->input('mensaje');
		$hash = $request->input('id');
		$slug = $request->input('slug');

		$juego = $this->getJuegoPorSlug($slug);
		$comentarioPadre = $this->getComentarioPorHash($hash);

		if($comentarioPadre->count() == 1 && $juego->count() == 1){
			$comentario = new Comentario();
			$comentario->comentario = $mensaje;
			$comentario->id_comentario = $comentarioPadre->id;
			if($comentario->save())
				return response(json_encode(["status" => "1", "id" => $comentario->hash]), 200)->header('Content-Type', 'application/json');
		}
		return $this->returnError();
	}

	protected function addReporte(){
		return $this->returnError();
	}

	private function getJuegoPorSlug($slug){
		return Juego::where("slug", $slug)->first();
	}

	private function getComentarioPorHash($hash){
		return Comentario::where("hash", $hash)->first();
	}

	private function returnError(){
		return response(json_encode(["status" => "0"]), 200)->header('Content-Type', 'application/json');
	}
}
