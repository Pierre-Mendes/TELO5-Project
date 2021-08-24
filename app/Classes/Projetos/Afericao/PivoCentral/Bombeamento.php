<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bombeamento extends Model
{
    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_bombeamento' , 'id_usuario', 'comprimento_succao', 'diametro_succao', 'marca', 'modelo', 'numero_rotores',
        'diametro_rotor', 'material_succao', 'rendimento_bomba', 'shutoff', 'rotacao', 'pressao_bomba', 'altura_succao',
        'tipo_motor', 'modelo_motor', 'potencia', 'numero_motores', 'chave_partida', 'fator_servico', 'corrente_nominal', 
        'rendimento', 'tensao_nominal', 'frequencia',

        'corrente_leitura_1_fase_1', 'corrente_leitura_1_fase_2', 'corrente_leitura_1_fase_3',
        'corrente_leitura_2_fase_1', 'corrente_leitura_2_fase_2', 'corrente_leitura_2_fase_3',

        'tensao_leitura_1_fase_1', 'tensao_leitura_1_fase_2', 'tensao_leitura_1_fase_3',
        'tensao_leitura_2_fase_1', 'tensao_leitura_2_fase_2', 'tensao_leitura_2_fase_3',
    ];

    public function calcularMediaCorrentes(){
        $soma = $this->corrente_leitura_1_fase_1 + $this->corrente_leitura_1_fase_2 + $this->corrente_leitura_1_fase_3;
        if(!empty($this->corrente_leitura_2_fase_1)){
            $soma = $soma + $this->corrente_leitura_2_fase_1 + $this->corrente_leitura_2_fase_2 + $this->corrente_leitura_2_fase_3;
            return $soma/6;
        }else{
            return $soma/3;
        }
    }

    public static function calcularIndiceCarregamento($corrente_leitura, $corrente_nominal,  $tensao_leitura, $tensao_nominal){
        $correcao_corrente = ($corrente_leitura * $tensao_leitura * pow(3, (1/2)))/$tensao_nominal;
        $indice_carregamento = ($correcao_corrente/$corrente_nominal);
        return $indice_carregamento; 
    }
}
