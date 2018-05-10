<?php 
namespace App\Helpers;

use App\Models\Categoria;

class Menu{
	
	public static function getMenuIndex(){
		$categorias = Categoria::select("nombre", "slug", "img")->orderby("nombre")->get();
		
		$categorias->each(function($model){
			$model->setUrl("indexCategoria");
		});
		$categorias = $categorias->toArray();

		array_unshift($categorias, ["nombre" => "Todos los juegos", "img" => "", "url" => route("index")]);

		return(json_encode($categorias));
	}
}