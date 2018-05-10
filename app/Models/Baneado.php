<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baneado extends Model
{
	protected $table = 'baneados';

	protected $hidden = [
        'id_usuario',
    ];

    //Relaciones
    protected function usuario(){
        return $this->belongsTo('App\Models\User', 'id_usaurio', 'id');
    }
}
