<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Emissor extends Model
{
    protected $table = 'emissores';
    use softDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'numero', 'saida_1', 'saida_2', 'espacamento',
        'diametro', 'emissor', 'tipo_valvula', 'psi', 'id_lance'
    ];

}
