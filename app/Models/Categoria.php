<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table = 'categorias';

    //Relaciones
	protected function juegos()
	{
		return $this->belongsToMany('App\Models\Juego', 'juegos_categorias', 'id_categoria', 'id_juego');
	}

	//Eventos de modelo
	protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
        	$model->slug = $model->generateSlug();
        });
    }

    //Otros
	private function generateSlug(){
		$num = 0;
		do{
			$slug = $this->slugify($this->nombre.(++$num == 1 ? '' : $num));
		}while(Categoria::where("slug", $slug)->count() > 0);
		return $slug;
	}

	private function slugify($text){
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);

		if (empty($text)) 
			return 'n-a';
		return $text;
	}

	//Añade la url al juego
    public function setUrl($route){
        $this->url = route($route, ['slug' => $this->slug]);
        unset($this->slug);
        return $this;
    }
}
