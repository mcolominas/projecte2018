<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
    }
}
