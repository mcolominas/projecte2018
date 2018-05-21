<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tienda;

class TiendaUser extends Model
{
    protected $table = 'tienda_user';

    protected $hidden = [
        'id','id_tienda','id_user',
    ];

    //Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
        	$user = User::where("id", $model->id_user)->first();
        	$producto = Tienda::where("id", $model->id_tienda)->first();
        	$user->coins = $user->coins - $producto->coste;
            $user->save();
        });

        self::deleting(function($model){
            $user = User::where("id", $model->id_user)->first();
            $producto = Tienda::where("id", $model->id_tienda)->first();
            $user->coins = $user->coins + $producto->coste;
            $user->save();
        });
    }
}
