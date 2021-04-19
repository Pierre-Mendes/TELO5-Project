<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use App\Classes\Projetos\Afericao\PivoCentral\CanhaoFinal;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use DB;

class Adutora extends Model
{
    protected $table = 'adutoras';

    protected $fillable = [
        'id_afericao' ,
        'tipo_cano' , 'diametro', 'coeficiente_hw', 'numero_canos',
        'comprimento', 'desnivel', 'altitude', 'latitude', 'longitude'
    ];

    public static function calcularAdutora($cabecalho_bombeamento, $trechos_adutora, $afericao){
        $somatorios = MapaOriginal::select( DB::raw('sum( vazao_aspersor) as vazao_total'))->where('id_afericao', $afericao['id'])->first();        
        $pressao_inicial = Bombeamento::select('pressao_bomba')->where('id_bombeamento', $cabecalho_bombeamento['id'])->first()['pressao_bomba'];
        $vazao_canhao_final  = CanhaoFinal::select('vazao_canhao_final')->where('id_afericao', $afericao['id'])->first()['vazao_canhao_final'];
        
        if(empty($vazao_canhao_final)){
            $vazao_canhao_final = 0;
        }

        $calculos_adutoras = [];

        $somatorio_comprimento = 0;
        /*Calculos de somatorio */
        foreach ($trechos_adutora as $key => $trecho) {
            $somatorio_comprimento += $trecho['comprimento'];
        }
        $desnivel_total = $afericao['altitude_centro'] - $cabecalho_bombeamento['altitude_casa_bomba'];

        $linha_calculo = [];
        foreach($trechos_adutora as $key => $trecho){            
            $linha_calculo['vazao'] = ($somatorios['vazao_total'] + $vazao_canhao_final) / $trecho['numero_canos'];
            $linha_calculo['hf'] = 10.643*(1/(pow($trecho['diametro']*0.985, 4.87)))*(pow(($linha_calculo['vazao']/3600)/$trecho['coeficiente_hw'],1.852))*$trecho['comprimento'];
            $linha_calculo['perda_pressao'] = $trecho['desnivel'] + $linha_calculo['hf'];
            $linha_calculo['desnivel'] = $trecho['desnivel'];
            if($key == 0){
                $linha_calculo['pressao_final'] = $pressao_inicial - $linha_calculo['perda_pressao'];
                $linha_calculo['pressao_inicial'] = $pressao_inicial;
            }else{
                $linha_calculo['pressao_final'] = $calculos_adutoras[$key - 1]['pressao_final'] - $linha_calculo['perda_pressao'];
                $linha_calculo['pressao_inicial'] = $calculos_adutoras[$key-1]['pressao_final'];
            }
            $linha_calculo['velocidade'] = ($linha_calculo['vazao']/3600)/((PI()*(pow($trecho['diametro'], 2))/4));
            array_push($calculos_adutoras, $linha_calculo);
        }
        return $calculos_adutoras;
    }
}
