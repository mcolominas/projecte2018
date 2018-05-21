<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JuegoFileSystem extends Model
{
    protected $table = 'juegos_file_system';

    protected function Juego(){
        return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
    }

    public function getPrivateContent(){
    	$this->content = Storage::get($this->ruta);
    }

    public function getPublicContent(){
    	$this->content = Storage::get($this->rutaMin);
    }
}
