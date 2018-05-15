<?php 
namespace App\Helpers;

use App\Models\Categoria;

class Menu{
	
	public static function menuCategorias(){
		$categorias = Categoria::select("nombre", "slug", "img")->orderby("nombre")->get()->each(function($model){
			$model->setUrl("juegosPorCategoria");
		})->toArray();

		array_unshift($categorias, ["nombre" => "Todos los juegos", "img" => "#", "url" => route("index")]);

		return($categorias);
	}

	public static function menuDesarollador(){

		return [["nombre" => "Juegos", "img" => "#", "url" => route("desarrollador")]];
	}
	public static function menuAdministrador(){

		return [["nombre" => "Juegos", "img" => "#", "url" => route("admin")]];
	}
}