<?php

namespace App\Models;

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
