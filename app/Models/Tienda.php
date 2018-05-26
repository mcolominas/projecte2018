<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\TiendaUser;

class Tienda extends Model
{
	protected $table = 'tienda';

	protected $hidden = [
		'id_juego', 'id',
	];

	//Relaciones
	protected function users()
	{
		return $this->belongsToMany('App\Models\User', 'tienda_user', 'id_tienda', 'id_user');
	}

	protected function juego()
	{
		return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
	}

	//Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->hash = $model->generateHash();
            $model->slug = $model->generateSlug();
        });

        self::deleting(function($model){
            TiendaUser::where("id_tienda", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });

            if(Storage::disk('local')->exists($model->img)) Storage::delete($model->img);
        });
    }

    //Otros
    public function setUrlImagePublic(){
        $this->img = route("storage.productoJuego", ["slug" => $this->slug]);
    }

    private function generateHash(){
        do{
            $hash = md5(uniqid());
        }while(Tienda::where("hash", $hash)->count() > 0);
        return $hash;
    }

    private function generateSlug(){
        $num = 0;
        do{
            $slug = $this->slugify($this->nombre.(++$num == 1 ? '' : $num));
        }while(Tienda::where("slug", $slug)->count() > 0);
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
