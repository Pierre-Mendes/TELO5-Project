<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;

class UsuariosFazendas extends Model
{
    protected $fillable = [
        'id_usuario', 'id_fazenda'
    ];
}
