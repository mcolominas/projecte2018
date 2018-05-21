<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Juego;
use App\Models\Logro;
use App\Models\Tienda;

class StorageController extends Controller
{
	protected function getPortadaJuego($slug) {
		if($juego = $this->getJuegoPorSlug($slug))
			if(Storage::disk('local')->exists($juego->img))
				return Storage::response($juego->img);
	}

	protected function getLogroJuego($slug) {
		if($logro = $this->getLogroPorSlug($slug))
			if(Storage::disk('local')->exists($logro->img))
				return Storage::response($logro->img);
	}

	protected function getProductoJuego($slug) {
		if($producto = $this->getProductoPorSlug($slug))
			if(Storage::disk('local')->exists($producto->img))
				return Storage::response($producto->img);
	}

	protected function getCodigoJuego($slug, $tipo, $num = 0){
		if(!$this->validateFiles($tipo, $num)) return null;

		if($juego = $this->getJuegoPorSlug($slug)){
			$juego = $juego->files->where("tipo", $tipo)->where("order", $num)->first();
			
			if(count($juego) != 1)
				return null;

			if(Storage::disk('local')->exists($juego->rutaMin)){
				//add header
				switch ($tipo) {
					case 'html':
					$header = ['Content-Type' => "text/html"];
					break;
					case 'js':
					$header = ['Content-Type' => "application/javascript"];
					break;
					case 'css':
					$header = ['Content-Type' => "text/css"];
					break;
				}

				return Storage::response($juego->rutaMin, null, $header);
			}
		}
	}

	private function validateFiles($tipo, $num){
		return ($tipo == "html" && $num === 0) || (($tipo == "css" || $tipo == "js") && is_numeric($num));
	}

	private function getJuegoPorSlug($slug){
		if($this->existeYNoEstaVacio($slug)){
			$j = Juego::where("slug", $slug)->firstOrFail();
			return $j;
		}

		return false;
	}

	private function getLogroPorSlug($slug){
		if($this->existeYNoEstaVacio($slug)){
			$j = Logro::where("slug", $slug)->firstOrFail();
			return $j;
		}

		return false;
	}

	private function getProductoPorSlug($slug){
		if($this->existeYNoEstaVacio($slug)){
			$j = Tienda::where("slug", $slug)->firstOrFail();
			return $j;
		}

		return false;
	}
}
