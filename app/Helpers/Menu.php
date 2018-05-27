<?php 
namespace App\Helpers;

use App\Models\Categoria;

class Menu{
	
	public static function menuCategorias(){
		$categorias = Categoria::select("nombre", "slug", "img")->orderby("nombre")->get()->each(function($model){
			$model->setUrl("juegosPorCategoria");
		})->toArray();

		array_unshift($categorias, ["nombre" => "Todos los juegos", "img" => asset("img/iconos/game.png"), "url" => route("index")]);

		return($categorias);
	}

	public static function menuDesarollador(){
		return [["nombre" => "Juegos", "img" => asset("img/iconos/game.png"), "url" => route("desarrollador")],
				["nombre" => "Logros", "img" => asset("img/iconos/logro.png"), "url" => route("desarrollador.verJuegosLogros")],
				["nombre" => "Productos", "img" => asset("img/iconos/producto.png"), "url" => route("desarrollador.verJuegosProductos")]];
	}
	
	public static function menuAdministrador(){
		return [["nombre" => "Juegos", "img" => asset("img/iconos/game.png"), "url" => route("admin")]];
	}
}