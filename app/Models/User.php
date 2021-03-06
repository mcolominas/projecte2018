<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Comentario', 'id_usuario', 'id');
    }

    protected function juegos()
    {
        return $this->hasMany('App\Models\Juego', 'id_creador', 'id');
    }

    protected function baneados()
    {
        return $this->hasMany('App\Models\Baneado', 'id_usuario', 'id');
    }

    protected function logros()
    {
        return $this->belongsToMany('App\Models\Logro', 'users_logros', 'id_usuario', 'id_logro');
    }

    protected function misCompras()
    {
        return $this->belongsToMany('App\Models\Tienda', 'tienda_user', 'id_user', 'id_tienda');
    }

    protected function jugando()
    {
        return $this->belongsToMany('App\Models\Juego', 'users_jugando', 'id_usuario', 'id_juego');
    }

    //Otros
    public function isConectado(){
        return !Auth::guest();
    }

    public function isAdmin(){
        return $this->isConectado() && Auth::user()->rol === "admin";
    }

    public function isDesarrollador(){
        return $this->isConectado() && Auth::user()->rol === "desarrollador";
    }

    public function isNormal(){
        return $this->isConectado() && Auth::user()->rol === "normal";
    }
}
