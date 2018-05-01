<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    protected $table = 'plataformas';

    //Relaciones
    protected function juegos()
    {
        return $this->belongsToMany('App\Juego', 'juegos_plataformas', 'id_plataforma', 'id_juego');
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
		}while(Plataforma::where("slug", $slug)->count() > 0);
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
    
}
