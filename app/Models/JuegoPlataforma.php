<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JuegoPlataforma extends Model
{
    protected $table = 'juegos_plataformas';

    protected $hidden = [
        'id','id_juego','id_plataforma',
    ];
}
