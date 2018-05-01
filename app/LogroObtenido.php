<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogroObtenido extends Model
{
    protected $table = 'logros_obtenidos';

    protected $hidden = [
        'id','id_usuario','id_logro','created_at', 'updated_at',
    ];
}
