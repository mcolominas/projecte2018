<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JuegoCategoria extends Model
{
    protected $table = 'juegos_categorias';

    protected $hidden = [
        'id','id_juego','id_categoria',
    ];
}
