<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JuegoFileSystem extends Model
{
    protected $table = 'juegos_file_system';

    //Relaciones
    protected function juego(){
        return $this->belongsTo('App\Models\Juego', 'id_juego', 'id');
    }

    //Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::deleting(function($model){
            if($model->rutaMin != null)
                if(Storage::disk('local')->exists($model->rutaMin))
                    Storage::delete($model->rutaMin);
            if(Storage::disk('local')->exists($model->ruta))
                Storage::delete($model->ruta);
        });
    }

    //Otros
    public function getPrivateContent(){
    	$this->content = Storage::get($this->ruta);
    }

    public function getPublicContent(){
    	$this->content = Storage::get($this->rutaMin);
    }
}
