<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FichaTecnicaAdutora extends Model
{
    protected $table = 'ficha_tecnica_adutora';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'trecho_adutora', 'id_ficha_tecnica', 'coeficiente_hf', 'velocidade', 
        'pressao_inicial', 'pressao_final', 'diametro', 'comprimento', 
        'material'
    ];
}
