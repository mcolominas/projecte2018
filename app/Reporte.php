<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $hidden = [
        'id_juego',
    ];
    

    //Relaciones
    protected function juego()
    {
        return $this->belongsTo('App\Juego', 'id_juego', 'id');
    }
}
