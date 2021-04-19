<?php

namespace App\Classes\Sistema;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class VelocidadePercentimetro extends Model
{
    protected $table = 'velocidade_afericao_percentimetro';
    use softDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_afericao', 'tipo_movimento',
        'minuto_perc_01', 'segundo_perc_01', 'distancia_perc_01', 'minuto_perc_02', 'segundo_perc_02', 'distancia_perc_02',
        'minuto_perc_03', 'segundo_perc_03', 'distancia_perc_03', 'minuto_perc_04', 'segundo_perc_04', 'distancia_perc_04',
        'minuto_movi_01', 'segundo_movi_01', 'minuto_parado_01', 'segundo_parado_01', 'minuto_movi_02', 'segundo_movi_02', 'minuto_parado_02', 'segundo_parado_02',
        'minuto_movi_03', 'segundo_movi_03', 'minuto_parado_03', 'segundo_parado_03', 'minuto_movi_04', 'segundo_movi_04', 'minuto_parado_04', 'segundo_parado_04'
    ];

}
