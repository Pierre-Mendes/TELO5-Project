<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CabecalhoBombeamento extends Model
{

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_afericao' , 'id_usuario', 'altitude_nivel_agua', 'altitude_casa_bomba', 'tipo_instalacao', 'posicionamento_bombeamento', 'captacao',
        'numero_bombas', 'latitude', 'longitude'
    ];
}
