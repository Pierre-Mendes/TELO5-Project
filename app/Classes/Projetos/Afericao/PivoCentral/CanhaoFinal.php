<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CanhaoFinal extends Model
{
    protected $table = 'canhoes_finais';

    use SoftDeletes;

    protected $dates =  ['deleted_at'];

    protected $fillable = [
        
        'id_afericao', 'marca_canhao_final', 'potencia_canhao_final', 'vazao_canhao_final', 'modelo_canhao_final',
        'bomba_canhao_final', 'bocais_canhao_final', 'alcance_canhao_final', 'motor_canhao_final',
        'valv_reguladora_canhao_final',
    ];
}
