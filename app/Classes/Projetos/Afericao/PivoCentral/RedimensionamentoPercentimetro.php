<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Sistema\VelocidadeAfericao_100;
use App\Classes\Sistema\VelocidadePercentimetro;
use Auth;

class RedimensionamentoPercentimetro extends Model
{
    protected $fillable = [
        'id_afericao', 'id_local',  'percentimetro','projeto', 'medido', 'variacao'
    ];

    public static function geraRedimensionamentoPercentimetro($id_afericao){

        $velocidade_afericao = [];
        $verificacao_velocidade = [];
        $redimensionamento_percentimetro = [];
        $tabela_resultante = [];

        $velocidade = VelocidadeAfericao_100::select(
        'velocidade_afericao_100.minuto01', 'velocidade_afericao_100.segundo01', 'velocidade_afericao_100.distancia01',
        'velocidade_afericao_100.minuto02', 'velocidade_afericao_100.segundo02', 'velocidade_afericao_100.distancia02', 
        'velocidade_afericao_100.minuto03', 'velocidade_afericao_100.segundo03', 'velocidade_afericao_100.distancia03',
        'velocidade_afericao_100.minuto04', 'velocidade_afericao_100.segundo04', 'velocidade_afericao_100.distancia04',
        'nao_aferiu',
        'AP.minuto_perc_01', 'AP.segundo_perc_01', 'AP.distancia_perc_01', 'AP.minuto_perc_02', 'AP.segundo_perc_02', 'AP.distancia_perc_02',
        'AP.minuto_perc_03', 'AP.segundo_perc_03', 'AP.distancia_perc_03', 'AP.minuto_perc_04', 'AP.segundo_perc_04', 'AP.distancia_perc_04',
        'AP.minuto_movi_01', 'AP.segundo_movi_01', 'AP.minuto_parado_01', 'AP.segundo_parado_01', 'AP.minuto_movi_02', 'AP.segundo_movi_02', 'AP.minuto_parado_02', 'AP.segundo_parado_02',
        'AP.minuto_movi_03', 'AP.segundo_movi_03', 'AP.minuto_parado_03', 'AP.segundo_parado_03', 'AP.minuto_movi_04', 'AP.segundo_movi_04', 'AP.minuto_parado_04', 'AP.segundo_parado_04')
        ->leftjoin('velocidade_afericao_percentimetro as AP', 'velocidade_afericao_100.id_afericao', 'AP.id_afericao')
        ->where('AP.id_afericao', $id_afericao)
        ->first();

        //Calculo tabela Verificação Velocidade
        $verificacao_velocidade['espaco1'] = $velocidade['distancia01'];
        $verificacao_velocidade['espaco2'] = $velocidade['distancia02'];
        $verificacao_velocidade['espaco3'] = $velocidade['distancia03'];
        $verificacao_velocidade['espaco4'] = $velocidade['distancia04'];
        $verificacao_velocidade['tempo1']  = ($velocidade['minuto01'] * 60 + $velocidade['segundo01']);
        $verificacao_velocidade['tempo2']  = ($velocidade['minuto02'] * 60 + $velocidade['segundo02']);
        $verificacao_velocidade['tempo3']  = ($velocidade['minuto03'] * 60 + $velocidade['segundo03']);
        $verificacao_velocidade['velocidade_mh_1'] = ($velocidade['distancia01'] / $verificacao_velocidade['tempo1']) * 3600;
        $verificacao_velocidade['velocidade_mh_2'] = ($velocidade['distancia02'] / $verificacao_velocidade['tempo2']) * 3600;
        $verificacao_velocidade['velocidade_mh_3'] = ($velocidade['distancia03'] / $verificacao_velocidade['tempo3']) * 3600;  
           
        if (empty($velocidade['minuto04']) || empty($velocidade['segundo04']) || empty($velocidade['distancia04']) ){
            $verificacao_velocidade['tempo4'] = 0;
            $verificacao_velocidade['velocidade_mh_4'] = 0;
            $med = 3;
        }else{
            $verificacao_velocidade['tempo4'] = ($velocidade['minuto04'] * 60 + $velocidade['segundo04']);
            $verificacao_velocidade['velocidade_mh_4'] = ($velocidade['distancia04'] / $verificacao_velocidade['tempo4']) * 3600; 
            $med = 4;
        }

        $verificacao_velocidade['media_tempo'] = ($verificacao_velocidade['tempo1'] + $verificacao_velocidade['tempo2'] + $verificacao_velocidade['tempo3'] + $verificacao_velocidade['tempo4']) / $med;
        $verificacao_velocidade['media_velocidade'] = ($verificacao_velocidade['velocidade_mh_1'] + $verificacao_velocidade['velocidade_mh_2'] + $verificacao_velocidade['velocidade_mh_3'] + $verificacao_velocidade['velocidade_mh_4']) / $med;

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Calculo tabela Redimensionamento Percentímetro
        $val = 80;
        for ($i=1; $i<=4; $i++){            
            if ((!empty($velocidade['minuto_movi_0'.$i]) || $velocidade['minuto_movi_0'.$i] >= 0) && !empty($velocidade['segundo_movi_0'.$i])){
                $redimensionamento_percentimetro['tempo_perc_movimentado_'.$i] = ($velocidade['minuto_movi_0'.$i] * 60 + $velocidade['segundo_movi_0'.$i]);
                $redimensionamento_percentimetro['tempo_perc_parado_'.$i] = ($velocidade['minuto_parado_0'.$i] * 60 + $velocidade['segundo_parado_0'.$i]);
                
                $tempo_perc = ($velocidade['minuto_movi_0'.$i] * 60 + $velocidade['segundo_movi_0'.$i]) + ($velocidade['minuto_parado_0'.$i] * 60 + $velocidade['segundo_parado_0'.$i]);

                $redimensionamento_percentimetro['espaco_'.$val] = $verificacao_velocidade['media_velocidade'] * ($velocidade['minuto_movi_0'.$i] * 60 + $velocidade['segundo_movi_0'.$i]) / 3600;
                $redimensionamento_percentimetro['velocidade_perc_'.$val] = $redimensionamento_percentimetro['espaco_'.$val] / $tempo_perc* 3600;

                $val = $val - 20;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        ///////////////Tabela resultante
        //Calculo para 100%
        $tabela_resultante['medido_100']  = $verificacao_velocidade['media_velocidade'];
        $tabela_resultante['projeto_100'] = $tabela_resultante['medido_100'];

        //Calculo da coluna de projeto
        for ($i=90; $i>=10; $i = $i - 10){
            $tabela_resultante['projeto_'.$i] = $tabela_resultante['projeto_100'] * ($i / 100);    
        }
        //Calculo da colunda de medidos
        if ($velocidade['nao_aferiu'] == 0){
            $tabela_resultante['medido_80'] = $redimensionamento_percentimetro['velocidade_perc_80'];
            $tabela_resultante['medido_60'] = $redimensionamento_percentimetro['velocidade_perc_60'];
            $tabela_resultante['medido_40'] = $redimensionamento_percentimetro['velocidade_perc_40'];
            $tabela_resultante['medido_20'] = $redimensionamento_percentimetro['velocidade_perc_20'];
            
            $tabela_resultante['medido_90'] = ($tabela_resultante['medido_100']+$tabela_resultante['medido_80'])/2;
            $tabela_resultante['medido_70'] = ($tabela_resultante['medido_80']+$tabela_resultante['medido_60'])/2;
            $tabela_resultante['medido_50'] = ($tabela_resultante['medido_60']+$tabela_resultante['medido_40'])/2;
            $tabela_resultante['medido_30'] = ($tabela_resultante['medido_40']+$tabela_resultante['medido_20'])/2;
            $tabela_resultante['medido_10'] = $tabela_resultante['medido_20']/2;

            //Calculo da coluna variação
            for ($i = 100; $i>=10; $i = $i-10){
                $tabela_resultante['variacao_'.$i] = -($tabela_resultante['projeto_'.$i]/$tabela_resultante['medido_'.$i]*100-100)/100;
                if ($tabela_resultante['variacao_'.$i] == -0) $tabela_resultante['variacao_'.$i] = 0;
            }

            $tabela_resultante['maior_positivo'] = max($tabela_resultante['variacao_30'], $tabela_resultante['variacao_40'], $tabela_resultante['variacao_50'], $tabela_resultante['variacao_60'], $tabela_resultante['variacao_70'], $tabela_resultante['variacao_80'], $tabela_resultante['variacao_90'], $tabela_resultante['variacao_100']);
            $tabela_resultante['maior_negativo'] = min($tabela_resultante['variacao_30'], $tabela_resultante['variacao_40'], $tabela_resultante['variacao_50'], $tabela_resultante['variacao_60'], $tabela_resultante['variacao_70'], $tabela_resultante['variacao_80'], $tabela_resultante['variacao_90'], $tabela_resultante['variacao_100']);
            
            if ($tabela_resultante['maior_negativo'] == -0) $tabela_resultante['maior_negativo'] = 0;

            $tabela_resultante['maior_positivo'] > ($tabela_resultante['maior_negativo'] * -1) ? $tabela_resultante['maior_variacao'] = $tabela_resultante['maior_positivo'] : $tabela_resultante['maior_variacao'] = $tabela_resultante['maior_negativo'];
        }       
        
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //Retorno
        $velocidade_afericao['verificacao_velocidade'] = $verificacao_velocidade;
        $velocidade_afericao['redimensionamento_percentimetro'] = $redimensionamento_percentimetro;
        $velocidade_afericao['tabela_resultante'] = $tabela_resultante;

        return $velocidade_afericao;
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
}