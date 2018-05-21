<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Logro;

class UserLogro extends Model
{
    protected $table = 'users_logros';

    protected $hidden = [
        'id','id_usuario','id_logro',
    ];

    //Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
        	$user = User::where("id", $model->id_usuario)->first();
        	$logro = Logro::where("id", $model->id_logro)->first();

        	$user->coins = $user->coins + $logro->coins;
            $user->save();
        });

        self::deleting(function($model){
            $user = User::where("id", $model->id_usuario)->first();
            $logro = Logro::where("id", $model->id_logro)->first();

            $user->coins = $user->coins - $logro->coins;
            $user->save();
        });
    }
}
