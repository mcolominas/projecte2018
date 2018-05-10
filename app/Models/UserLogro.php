<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogro extends Model
{
    protected $table = 'users_logros';

    protected $hidden = [
        'id','id_usuario','id_logro',
    ];
}
