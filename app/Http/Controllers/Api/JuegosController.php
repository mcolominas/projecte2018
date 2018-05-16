<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;
use App\Models\Juego;

class JuegosController extends Controller
{
	protected function addComentario(Request $request){
		$mensaje = $request->input('mensaje');
		$slug = $request->input('slug');

		$juego = $this->getJuegoPorSlug($slug);
		$user = $this->getUser();

		if(isset($juego) && isset($user)){
			$comentario = new Comentario();
			$comentario->comentario = $mensaje;
			$comentario->id_juego = $juego->id;
			$comentario->id_usuario = $user->id;

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
		$user = $this->getUser();
		
		if(isset($comentarioPadre) && isset($juego) && isset($user)){
			$comentario = new Comentario();
			$comentario->comentario = $mensaje;
			$comentario->id_comentario = $comentarioPadre->id;
			$comentario->id_usuario = $user->id;

			if($comentario->save())
				return response(json_encode(["status" => "1", "id" => $comentario->hash]), 200)->header('Content-Type', 'application/json');
		}
		return $this->returnError();
	}

	protected function addReporte(){
		return $this->returnError();
	}

	private function getJuegoPorSlug($slug){
		if(isset($slug) && !empty($slug)){
			$j = Juego::where("slug", $slug)->get();
			if($j->count() == 1)
				return $j->first();
		}
		return null;
	}

	private function getComentarioPorHash($hash){
		if(isset($hash) && !empty($hash)){
			$c = Comentario::where("hash", $hash)->get();
			if($c->count() == 1)
				return $c->first();
		}
		return null;
	}

	private function getUser(){
		$user = Auth::user();
		if(isset($user) && $user->isConectado()) return $user;
		return null;
	}

	private function returnError(){
		return response(json_encode(["status" => "0"]), 200)->header('Content-Type', 'application/json');
	}
}
