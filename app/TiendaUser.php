<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiendaUser extends Model
{
    protected $table = 'tienda_user';

    protected $hidden = [
        'id','id_tienda','id_user',
    ];
}
