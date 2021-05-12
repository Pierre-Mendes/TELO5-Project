<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Lance extends Model
{
    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'numero_tubos', 'numero_emissores', 'diametro',
        'valvula_reguladora', 'comprimento', 'motorredutor', 'numero_lance', 'id_afericao'
    ];


}
