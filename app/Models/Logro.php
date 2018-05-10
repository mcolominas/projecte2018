<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    protected $table = 'logros';

    protected $hidden = [
        'id_juego',
    ];
    

    //Relaciones
    protected function juego()
    {
        return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
    }


    protected function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_logros', 'id_logro', 'id_usuario');
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
        }while(Logro::where("hash", $hash)->count() > 0);
        return $hash;
    }

}
