<?php

namespace App;

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
        return $this->belongsTo('App\Juego', 'id_juego', 'id');
    }


    protected function users()
    {
        return $this->belongsToMany('App\User', 'logros_obtenidos', 'id_logro', 'id_usuario');
    }

}
