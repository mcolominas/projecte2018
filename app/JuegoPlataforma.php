<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JuegoPlataforma extends Model
{
    protected $table = 'juegos_plataformas';

    protected $hidden = [
        'id','id_juego','id_plataforma','created_at', 'updated_at',
    ];
}
