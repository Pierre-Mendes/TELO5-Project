<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FichaTecnicaFuncioPivo extends Model
{
    protected $table = 'ficha_tecnica_funcio_pivo';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'velocidade', 'id_ficha_tecnica', 'volta', 'volta_1_meio', 
        'volta_1_quarto', 'lamina', 'estimativa_custo_eletrico'
    ];
}
