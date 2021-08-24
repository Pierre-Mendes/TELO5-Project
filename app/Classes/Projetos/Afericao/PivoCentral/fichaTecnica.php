<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fichaTecnica extends Model
{
    protected $table = 'ficha_tecnica';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id', 'id_afericao', 'txt_observacoes', 'txt_teste_velocidade', 
        'txt_uniformidade', 'txt_conclusao', 'versoes', 'composicao_parte_aerea', 
        'area_total' , 'lamina_diaria', 'raio_irrigado', 'vazao_total', 'uniformidade_aplicacao', 
        'raio_ultima_torre', 'balanco', 'velocidade_a_100', 'alcance_canhao', 'tempo_a_100', 
        'altura_emissores', 'lamina_conjugada', 'desnivel_centro_ao_ponto_mais_alto', 
        'desnivel_centro_ao_ponto_mais_alto', 'perda_carga_parte_aerea', 'desnivel_motobomba', 
        'perda_carga_total_adutora', 'pressao_ponta', 'altura_manometrica', 'potencia_total_sistema', 
        'lamina_anual', 'consumo_eletrico_anual', 'custo_eletrico'
    ];
}
