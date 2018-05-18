<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JuegoFileSystem extends Model
{
    protected $table = 'juegos_file_system';

    protected function Juego(){
        return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
    }
}
