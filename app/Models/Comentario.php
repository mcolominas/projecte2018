<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    protected $hidden = [
        'id_usuario', 'id_juego', 'id_comentario',
    ];
    
    //Relaciones
    protected function juego()
    {
        return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
    }

    protected function user()
    {
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }

    protected function subComentarios(){
    	return $this->hasMany('App\Models\Comentario', 'id_comentario', 'id');
    }

    protected function comentario(){
    	return $this->belongsTo('App\Models\Comentario', 'id_comentario', 'id');
    }

    //Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->hash = $model->generateHash();
        });
    }

    private function generateHash(){
        do{
            $hash = md5(uniqid());
        }while(Comentario::where("hash", $hash)->count() > 0);
        return $hash;
    }

}
