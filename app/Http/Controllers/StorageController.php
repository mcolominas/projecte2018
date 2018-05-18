<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Juego;

class StorageController extends Controller
{
	protected function getPortadaJuego($slug) {
		if($juego = $this->getJuegoPorSlug($slug))
			return Storage::response($juego->img);
	}

	protected function getCodigoJuego($slug, $tipo, $num = 0){
		if(!$this->validateFiles($tipo, $num)) return null;

		if($juego = $this->getJuegoPorSlug($slug)){
			$juego = $juego->files->where("tipo", $tipo)->where("order", $num)->first();
			
			if(count($juego) != 1)
				return null;

			if(Storage::disk('local')->exists($juego->rutaMin))
				return Storage::response($juego->rutaMin);
		}
	}

	private function validateFiles($tipo, $num){
		return ($tipo == "html" && $num == 0) || (($tipo == "css" || $tipo == "js") && is_numeric($num));
	}

	private function getJuegoPorSlug($slug){
		if($this->existeYNoEstaVacio($slug)){
			$j = Juego::where("slug", $slug)->firstOrFail();
			return $j;
		}

		return false;
	}
}
