<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\CabecalhoBombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Lane;
use App\Classes\Projetos\Afericao\PivoCentral\RelatorioVelocidade;
use Auth;
use DB;




class CustoLaminaAfericao extends Model
{
    public static function calculaCustoLamina($id_afericao, $afericao = null, $cabecalho_bombeamento_ = null, $motorredutor = 0){
        //Capturando os dados de aferição
        $afericao_pivo_central = $afericao;
        if(empty($afericao_pivo_central)){            
            $afericao_pivo_central = AfericaoPivoCentral::where('id', $id_afericao)->first();
        }
                
        //Capturando os dados de bombeamento
        $cabecalho_bombeamento = $cabecalho_bombeamento_;
        if(empty($cabecalho_bombeamento)){
            $cabecalho_bombeamento = CabecalhoBombeamento::where('id_afericao', $id_afericao)->first();
        }
        $bombeamentos = Bombeamento::where('id_bombeamento', $cabecalho_bombeamento['id'])->get();
        //Dados mapa original
        $dados_mapa_original = RelatorioVelocidade::geraRelatorioVelocidade($id_afericao);

        //Vetores
        $custo_lamina = [];
        $dados_eletricos = [];
        $dados_diesel = [];

        //Somatória dos dados de motorredutor
        if($motorredutor == 0){
            $motorredutor = Lance::select(DB::raw('sum(lances.motorredutor) AS somatoria_motorredutor'))
                ->where('id_afericao', $id_afericao)
                ->first()['somatoria_motorredutor']; 
        }
        
        $dados_eletricos['potencia_total_sistema_cv'] = $dados_diesel['potencia_total_sistema_cv'] = 0;
               
        foreach($bombeamentos as $key => $bombeamento){
            ///////Potência total do sistema (cv)
            //Calculo para corrente elétrica de BOMBEAMENTO
            //////////////////////////////////////////////////Area de calculos ELÉTRICO//////////////////////////////////////////////////
            if ($bombeamento['tipo_motor'] == "eletrico"){
                $corrente_eletrica_1 = ($bombeamento['corrente_leitura_1_fase_1'] * $bombeamento['tensao_leitura_1_fase_1'] * sqrt(3)) / $bombeamento['tensao_nominal'];
                $corrente_eletrica_2 = ($bombeamento['corrente_leitura_1_fase_2'] * $bombeamento['tensao_leitura_1_fase_2'] * sqrt(3)) / $bombeamento['tensao_nominal'];
                $corrente_eletrica_3 = ($bombeamento['corrente_leitura_1_fase_3'] * $bombeamento['tensao_leitura_1_fase_3'] * sqrt(3)) / $bombeamento['tensao_nominal'];
                $media_corrente_eletrica = ($corrente_eletrica_1 + $corrente_eletrica_2 + $corrente_eletrica_3) / (3);
                
                //Indice de carregamento
                if (!empty($media_corrente_eletrica)) $indice_carregamento = ($media_corrente_eletrica / $bombeamento['corrente_nominal']) * 100;
                else $indice_carregamento = 0;

                //Dado final da potencia total do sistema (cv)
                if($motorredutor == 0) $dados_eletricos['potencia_total_sistema_cv'] += $motorredutor + $bombeamento['potencia'] * $bombeamento['numero_motores'] * ($indice_carregamento / 100);

                //Potência total do sistema (kw)
                $dados_eletricos['potencia_total_sistema_kw'] = $dados_eletricos['potencia_total_sistema_cv'] * 0.736;

                //Lâmina Anual (mm):
                $dados_eletricos['lamina_anual_mm'] = $afericao_pivo_central['lamina_anual'];

                //Tempo Anual de operação (h)
                $dados_eletricos['tempo_anual_operacao'] = $dados_eletricos['lamina_anual_mm'] / ($dados_mapa_original['lamina'] / $dados_mapa_original['tempo']);

                //kWh/mm:
                $dados_eletricos['kwh_mm'] = $dados_eletricos['potencia_total_sistema_kw'] * $dados_mapa_original['tempo'] / $dados_mapa_original['lamina'];

                //Consumo Elétrico Anual (h)
                $dados_eletricos['consumo_anual'] = $dados_eletricos['kwh_mm'] * $dados_eletricos['tempo_anual_operacao'] / $dados_mapa_original['area_total_com_canhao'];

                //Custo Médio ($/kWh) ou ($/L):
                $dados_eletricos['custo_medio_kwh'] = $afericao_pivo_central['custo_medio'];

                //Custo Elétrico (R$/mm/ha)
                $dados_eletricos['custo_mm_ha'] = $dados_eletricos['custo_medio_kwh'] * $dados_eletricos['kwh_mm'] / $dados_mapa_original['area_total_com_canhao'];

                //Custo Elétrico Anual (R$/ha)
                $dados_eletricos['custo_anual_ha'] = $dados_eletricos['custo_mm_ha'] * $dados_eletricos['lamina_anual_mm'];

                //Custo Elétrico Anual (R$)
                $dados_eletricos['custo_anual'] = $dados_eletricos['custo_anual_ha'] * $dados_mapa_original['area_total_com_canhao'];

                //Inserindo no array de retorno
                $custo_lamina['eletrico'] = $dados_eletricos;
            }
            //////////////////////////////////////////////////Area de calculos DIESEL//////////////////////////////////////////////////
            else{                
                //Potência total do sistema (cv)
                $dados_diesel['potencia_total_sistema_cv'] += $bombeamento['potencia'] * $bombeamento['numero_motores'];

                //Potência total do sistema (kw)
                $dados_diesel['potencia_total_sistema_kw'] = $dados_diesel['potencia_total_sistema_cv'] * 0.736;

                //Lâmina Anual (mm):
                $dados_diesel['lamina_anual_mm'] = $afericao_pivo_central['lamina_anual'];

                //Consumo do Diesel (L/h)*
                $dados_diesel['consumo_l_h'] = $dados_diesel['potencia_total_sistema_cv'] * 1.15 / 7;

                //Consumo do Diesel (L/mm/area)
                $dados_diesel['consumo_l_mm_area'] = $dados_diesel['consumo_l_h'] / ($dados_mapa_original['lamina'] / $dados_mapa_original['tempo']);

                //Consumo do Diesel (L/mm/ha)
                $dados_diesel['consumo_l_mm_ha'] = $dados_diesel['consumo_l_mm_area'] / $dados_mapa_original['area_total_com_canhao'];

                //Custo do Diesel (R$/h)
                $dados_diesel['custo_h'] = $afericao_pivo_central['custo_medio'];

                //Custo anual do Diesel (R$/mm/ha)
                $dados_diesel['custo_anual_mm_ha'] = $dados_diesel['custo_h'] * $dados_diesel['consumo_l_mm_ha'];

                //Custo do Diesel (R$/ha)
                $dados_diesel['custo_ha'] = $dados_diesel['lamina_anual_mm'] * $dados_diesel['custo_anual_mm_ha'];

                //Custo Anual do Diesel (R$)
                $dados_diesel['custo_anual'] = $dados_diesel['custo_ha'] * $dados_mapa_original['area_total_com_canhao'];
                
                //Inserindo no array de retorno
                $custo_lamina['diesel'] = $dados_diesel;
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
        }
        return $custo_lamina;
    }
}