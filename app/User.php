<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relaciones
    protected function comentarios()
    {
        return $this->hasMany('App\Comentario', 'id_usuario', 'id');
    }

    protected function juegos()
    {
        return $this->hasMany('App\Juego', 'id_creador', 'id');
    }

    protected function logros()
    {
        return $this->belongsToMany('App\Logro', 'logros_obtenidos', 'id_usuario', 'id_logro');
    }

    //Otros
    protected function isConectado(){
        return !Auth::guest();
    }

    protected function isAdmin(){
        return $this->isConectado() && Auth::user()->rol === "admin";
    }

    protected function isDesarrollador(){
        return $this->isConectado() && Auth::user()->rol === "desarrollador";
    }

    protected function isNormal(){
        return $this->isConectado() && Auth::user()->rol === "normal";
    }
}
