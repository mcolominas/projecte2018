<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
	protected $table = 'tienda';

	protected $hidden = [
		'id_juego',
	];

	//Relaciones
	protected function users()
	{
		return $this->belongsToMany('App\User', 'tienda_user', 'id_tienda', 'id_user');
	}

	protected function juego()
	{
		return $this->belongsTo('App\Juego', 'id_juego', 'id');
	}

	//Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->hash = $model->generateHash();
        });
    }

    //Otros
    private function generateHash(){
        do{
            $hash = md5(uniqid());
        }while(Tienda::where("hash", $hash)->count() > 0);
        return $hash;
    }

}
