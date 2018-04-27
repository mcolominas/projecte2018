<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
