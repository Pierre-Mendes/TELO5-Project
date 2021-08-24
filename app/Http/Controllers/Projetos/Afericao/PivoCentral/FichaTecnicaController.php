<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Classes\Projetos\Afericao\PivoCentral\TrechoAdutora;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use App\Classes\Projetos\Afericao\PivoCentral\RelatorioVelocidade;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\CabecalhoBombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\CustoLaminaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\fichaTecnica;
use App\Classes\Projetos\Afericao\PivoCentral\FichaTecnicaAdutora;
use App\Classes\Projetos\Afericao\PivoCentral\FichaTecnicaFuncioPivo;
use App\Classes\Projetos\Afericao\PivoCentral\FichaTecnicaRedimenPerc;
use App\Classes\Constantes\Notificacao;
use App\Classes\Projetos\Redimensionamento\PivoCentral\InfoRedimensionamento;

class FichaTecnicaController extends Controller
{
    public function Datasheet($id_afericao)
    {

        $tipo_projeto = '';
        $id_afericao_original = 0;
        $id_afericao_redimensionamento = 0;

        $infoR = InfoRedimensionamento::select('id_afericao_original')->where('id_afericao_redimensionamento', $id_afericao)->get();
        if (count($infoR) > 0) {
            $tipo_projeto = 'R';
            // id da aferição original = $infoR[0]['id_afericao_original'];
            $id_afericao_original = $infoR[0]['id_afericao_original'];
            $id_afericao_redimensionamento = (int)$id_afericao;
        } else {
            $infoR = InfoRedimensionamento::select('id_afericao_redimensionamento')->where('id_afericao_original', $id_afericao)->get();
            if (count($infoR) > 0) {
                $tipo_projeto = 'A';
                // id do redimensionamento = $infoR[0]['id_afericao_redimensionamento'];
                $id_afericao_redimensionamento = $infoR[0]['id_afericao_redimensionamento'];
                $id_afericao_original = $id_afericao;
            }
        }

        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }

        $dados_ficha_tecnica = AfericaoPivoCentral::select(
            'afericoes_pivos_centrais.*',
            'U.nome as nome_consultor', 'U.telefone as telefone_consultor', 'U.email as email_consultor',
            'F.nome AS nome_fazenda', 'F.cidade AS cidade_fazenda', 'F.estado AS estado_fazenda', 'F.pais AS pais_fazenda', 'F.latitude AS latitude_fazenda', 'F.longitude AS longitude_fazenda',
            'PIV.fabricante AS fabricante_pivo', 'PIV.nome AS nome_modelo_pivo',
            'P.nome as nome_proprietario'
            )
            ->join('fazendas AS F', 'afericoes_pivos_centrais.id_fazenda', 'F.id')
            ->join('users as U', 'afericoes_pivos_centrais.id_usuario', 'U.id')
            ->join('pivos as PIV', 'afericoes_pivos_centrais.marca_modelo_pivo', 'PIV.id')
            ->join('proprietarios as P', 'F.id_proprietario', 'P.id')
            ->where('afericoes_pivos_centrais.id', $id_afericao)
            ->first();

        $dados_coordenadas = AfericaoHidraulica::select('longitude', 'latitude')->where('id_afericao', $id_afericao)->get();

        //Dados de pivô conjugado
        $dados_pivo_conjugado = PivoConjugado::where('id_afericao', $id_afericao)->first();

        //Obtendo o valor do motorreduotor
        $somatorio_motorredutor = Lance::select(DB::raw('SUM(motorredutor) as soma'))->where('id_afericao', $id_afericao)->first()['soma'];
        
        if(empty($somatorio_motorredutor)){
            $somatorio_motorredutor = 0;
        }
        $somatorio_potencia = 0;
        //Verificando se o pivô tem conjugado
        if (!empty($dados_pivo_conjugado)) $dados_ficha_tecnica->conjugado = 'sim';
        else $dados_ficha_tecnica->conjugado = 'nao';

        //Dados específicos que são gerados pela função do cálculo da Adutora
        $cabecalho_bombeamento = CabecalhoBombeamento::where('id_afericao', $id_afericao)->first();
        $afericao = AfericaoPivoCentral::where('id', $id_afericao)->first();
        $trechos_adutora = Adutora::where('id_afericao', $id_afericao)->get();
        
        $dados_adutora = Adutora::adductor_calculate($cabecalho_bombeamento, $trechos_adutora, $afericao);

        //Somandos os desníveis da adutora
        $total_desnivel_adutora = 0;
        for($i = 0; $i < count($dados_adutora); $i++){
            $total_desnivel_adutora += $dados_adutora[$i]['desnivel'];
        }

        //Variáveis para o somatório da perda de carga total dos trechos
        $total_comprimento = 0;
        $total_hf = 0;
        foreach($trechos_adutora AS $key => $trecho){
            $total_comprimento += $trecho['comprimento'];
            $total_hf += $dados_adutora[$key]['hf'];
        }
        $dados_adutora['comprimento_total'] = $total_comprimento;
        $dados_adutora['hf_total'] = $total_hf;

        //Dados do mapa original
        $dados_mapa_original = MapaOriginal::gerarMapaOriginal($id_afericao, 2);

        //variaveis dos campos de textos 
        $texto_uniformidade =  "";
        $texto_observacoes = "";
        $texto_velocidade_100 = "";
        $texto_conclusao ="";

        //verificar se ficha tecnica existe
        $status_ft = '';
        // Buscar a fica técnica desta aferição
        $ficha_tecnica = fichaTecnica::where('id_afericao', $id_afericao)->get();
        // Verificar se encontrou ficha técnica
        if (count($ficha_tecnica) > 0) {
            // Caso tenha encontrado, verificar se a versão da ficha técnica é igua a versão  da aferição
            if ($ficha_tecnica[0]['versoes'] == $dados_ficha_tecnica['versoes']) {
                // Não gerará novos valores textos
                $status_ft = 'noChange';
                // Trago os valores da ficha técnica existente
                $texto_uniformidade =  $ficha_tecnica[0]['txt_uniformidade'];
                $texto_observacoes = $ficha_tecnica[0]['txt_observacoes'];
                $texto_velocidade_100 = $ficha_tecnica[0]['txt_teste_velocidade'];
                $texto_conclusao = $ficha_tecnica[0]['txt_conclusao'];
            } else {
                // Se as versões forem diferente será gerado os valores textos
                // E será feito update na ficha técnica
                $status_ft = 'edit';
            }
        } else {
            // Se a ficha técnica não existe será criado uma com os valores gerados
            $status_ft = 'insert';
        }

        // Montagem do texto de uniformidade
        if ($status_ft != 'noChange') {
        if($dados_ficha_tecnica['tipo_projeto'] == "A"){
            $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.texto_uniformidade_1', [
                'lamina' => number_format($dados_mapa_original[0]['lamina'], 2), 
                'horas' => $dados_mapa_original[0]['tempo'] 
            ]);
        }else{
            $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.texto_uniformidade_7', [
                'lamina' => number_format($dados_mapa_original[0]['lamina'], 2), 
                'horas' => $dados_mapa_original[0]['tempo'] 
            ]);
        }
        
        $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.texto_uniformidade_2', [
            'vazao' => number_format($dados_mapa_original[0]['somatorio_vazao_ok'], 2), 
            'area' => number_format($dados_mapa_original[0]['area_total_com_canhao'],2), 
            'raio_irrigado' => number_format($dados_mapa_original[0]['raio_irrigado'],2) 
        ]);
        $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.texto_uniformidade_3', [
            'uniformidade_potencial' => number_format($dados_mapa_original[0]['uniformidade_aplicacao'],2)
        ]);

        if($dados_mapa_original[0]['uniformidade_aplicacao'] > 90){
            $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.otimo');
        }else if($dados_mapa_original[0]['uniformidade_aplicacao'] <=90 && $dados_mapa_original[0]['uniformidade_aplicacao'] >85){
            $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.bom');
        }else if($dados_mapa_original[0]['uniformidade_aplicacao'] <=85 && $dados_mapa_original[0]['uniformidade_aplicacao'] >80){
            $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.regular');
        }else{
            $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.ruim');
        }
        $texto_uniformidade = $texto_uniformidade . __('fichaTecnica.texto_uniformidade_4') . __('fichaTecnica.texto_uniformidade_5') . __('fichaTecnica.texto_uniformidade_6');
        }

        //Função de truncar
        function truncar($val, $f="0")
        {
            if(($p = strpos($val, '.')) !== false) {
                $val = floatval(substr($val, 0, $p + 1 + $f));
            }
            return $val;
        }
        
        //Custo de lâmina
        $dados_custo_lamina = CustoLaminaAfericao::calculaCustoLamina($id_afericao, $afericao, $cabecalho_bombeamento,  $somatorio_motorredutor);
        //Dados de velocidade
        $dados_velocidade = $dados_mapa_original[0];
        //Dados velocidade do pivô
        $velocidade_pivo = [];
        for ($i = 100; $i>=5; $i=$i-5){
            $velocidade_pivo[$i]['volta'] = truncar(($dados_mapa_original[0]['tempo_a_100'] * 100 / $i)) + ((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i) - (truncar($dados_mapa_original[0]['tempo_a_100'] * 100 / $i))) * 60 / 100);
            $velocidade_pivo[$i]['volta_1_2'] = truncar((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i)) / 2) + (((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i) / 2) - (truncar((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i) / 2)))) * 60 / 100);
            $velocidade_pivo[$i]['volta_1_4'] = truncar((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i)) / 4) + (((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i) / 4) - (truncar((($dados_mapa_original[0]['tempo_a_100'] * 100 / $i) / 4)))) * 60 / 100);
            $velocidade_pivo[$i]['lamina_mm'] = $dados_mapa_original[0]['tempo_irri_ponto_min'] * 100 / $i;
            $velocidade_pivo[$i]['estimativa_custo_eletrico'] = $dados_custo_lamina['eletrico']['custo_mm_ha'] * $velocidade_pivo[$i]['lamina_mm'];
            if (array_key_exists('diesel', $velocidade_pivo[$i]))
            $velocidade_pivo[$i]['estimativa_custo_diesel'] = $dados_custo_lamina['diesel']['custo_anual_mm_ha'] * $velocidade_pivo[$i]['lamina_mm'];
        }

        //Dados velocidade redimensionamento
        $dados_velocidade_red = RedimensionamentoPercentimetro::geraRedimensionamentoPercentimetro($id_afericao);
        
        //Dados Aferição Hidráulica
        $dados_afericao_hidraulica = AfericaoHidraulica::where('id_afericao', $id_afericao)->first();

        //Dados de bombeamento
        $bombeamentos = Bombeamento::where('id_bombeamento', $cabecalho_bombeamento['id'])->get();
        $dados_estimativa_custo_lamina = [];
        $dados_estimativa_custo_lamina['lamina_anual'] = $dados_custo_lamina['eletrico']['lamina_anual_mm'];
        $dados_estimativa_custo_lamina['num_motores'] = 0;
        
        //Calculos para correções de bombeamento
        foreach($bombeamentos as $key => $bombeamento){
            $cons = $bombeamento['corrente_nominal'];

            if (!isset($bombeamento['corrente_leitura_1_fase_1'])) $bombeamento["corrente_leitura_1_fase_1_corrigido"] = 0;
            else $bombeamento["corrente_leitura_1_fase_1_corrigido"] = $bombeamento["corrente_leitura_1_fase_1"] * $bombeamento["tensao_leitura_1_fase_1"] * sqrt(3) / $bombeamento['tensao_nominal'];
            
            if (!isset($bombeamento['corrente_leitura_1_fase_2'])) $bombeamento["corrente_leitura_1_fase_2_corrigido"] = 0;
            else $bombeamento["corrente_leitura_1_fase_2_corrigido"] = $bombeamento["corrente_leitura_1_fase_2"] * $bombeamento["tensao_leitura_1_fase_2"] * sqrt(3) / $bombeamento['tensao_nominal'];

            if (!isset($bombeamento['corrente_leitura_1_fase_3'])) $bombeamento["corrente_leitura_1_fase_3_corrigido"] = 0;
            else $bombeamento["corrente_leitura_1_fase_3_corrigido"] = $bombeamento["corrente_leitura_1_fase_3"] * $bombeamento["tensao_leitura_1_fase_3"] * sqrt(3) / $bombeamento['tensao_nominal'];

            if (!isset($bombeamento['corrente_leitura_2_fase_1'])) $bombeamento["corrente_leitura_2_fase_1_corrigido"] = 0;
            else $bombeamento["corrente_leitura_2_fase_1_corrigido"] = $bombeamento["corrente_leitura_2_fase_1"] * $bombeamento["tensao_leitura_2_fase_1"] * sqrt(3) / $bombeamento['tensao_nominal'];

            if (!isset($bombeamento['corrente_leitura_2_fase_2'])) $bombeamento["corrente_leitura_2_fase_2_corrigido"] = 0;
            else $bombeamento["corrente_leitura_2_fase_2_corrigido"] = $bombeamento["corrente_leitura_2_fase_2"] * $bombeamento["tensao_leitura_2_fase_2"] * sqrt(3) / $bombeamento['tensao_nominal'];

            if (!isset($bombeamento['corrente_leitura_2_fase_3'])) $bombeamento["corrente_leitura_2_fase_3_corrigido"] = 0;
            else $bombeamento["corrente_leitura_2_fase_3_corrigido"] = $bombeamento["corrente_leitura_2_fase_3"] * $bombeamento["tensao_leitura_2_fase_3"] * sqrt(3) / $bombeamento['tensao_nominal'];
            
            if ($bombeamento["tensao_leitura_1_fase_1"] == 0) $bombeamento["tensao_leitura_1_fase_1_corrigido"] = 0;
            else{
                if ($bombeamento["tensao_leitura_1_fase_1"] <= 300) $bombeamento["tensao_leitura_1_fase_1_corrigido"] = $bombeamento["tensao_leitura_1_fase_1"] * sqrt(3);
                else $bombeamento["tensao_leitura_1_fase_1_corrigido"] = $bombeamento["tensao_leitura_1_fase_1"];
            }

            if ($bombeamento["tensao_leitura_1_fase_2"] == 0) $bombeamento["tensao_leitura_1_fase_2_corrigido"] = 0;
            else{
                if ($bombeamento["tensao_leitura_1_fase_2"] <= 300) $bombeamento["tensao_leitura_1_fase_2_corrigido"] = $bombeamento["tensao_leitura_1_fase_2"] * sqrt(3);
                else $bombeamento["tensao_leitura_1_fase_2_corrigido"] = $bombeamento["tensao_leitura_1_fase_2"];
            }

            if ($bombeamento["tensao_leitura_1_fase_3"] == 0) $bombeamento["tensao_leitura_1_fase_3_corrigido"] = 0;
            else{
                if ($bombeamento["tensao_leitura_1_fase_3"] <= 300) $bombeamento["tensao_leitura_1_fase_3_corrigido"] = $bombeamento["tensao_leitura_1_fase_3"] * sqrt(3);
                else $bombeamento["tensao_leitura_1_fase_3_corrigido"] = $bombeamento["tensao_leitura_1_fase_3"];
            }

            if ($bombeamento["tensao_leitura_2_fase_1"] == 0) $bombeamento["tensao_leitura_2_fase_1_corrigido"] = 0;
            else{
                if ($bombeamento["tensao_leitura_2_fase_1"] <= 300) $bombeamento["tensao_leitura_2_fase_1_corrigido"] = $bombeamento["tensao_leitura_2_fase_1"] * sqrt(3);
                else $bombeamento["tensao_leitura_2_fase_1_corrigido"] = $bombeamento["tensao_leitura_2_fase_1"];
            }
            
            if ($bombeamento["tensao_leitura_2_fase_2"] == 0) $bombeamento["tensao_leitura_2_fase_2_corrigido"] = 0;
            else{
                if ($bombeamento["tensao_leitura_2_fase_2"] <= 300) $bombeamento["tensao_leitura_2_fase_2_corrigido"] = $bombeamento["tensao_leitura_2_fase_2"] * sqrt(3);
                else $bombeamento["tensao_leitura_2_fase_2_corrigido"] = $bombeamento["tensao_leitura_2_fase_2"];
            }

            if ($bombeamento["tensao_leitura_2_fase_3"] == 0) $bombeamento["tensao_leitura_2_fase_3_corrigido"] = 0;
            else{
                if ($bombeamento["tensao_leitura_2_fase_3"] <= 300) $bombeamento["tensao_leitura_2_fase_3_corrigido"] = $bombeamento["tensao_leitura_2_fase_3"] * sqrt(3);
                else $bombeamento["tensao_leitura_2_fase_3_corrigido"] = $bombeamento["tensao_leitura_2_fase_3"];
            }

            //Cálculos das médias
            $media_corrente_corrigida_1 = ($bombeamento["corrente_leitura_1_fase_1_corrigido"] + $bombeamento["corrente_leitura_1_fase_2_corrigido"] + $bombeamento["corrente_leitura_1_fase_3_corrigido"]) / 3;
            $media_corrente_corrigida_2 = ($bombeamento["corrente_leitura_2_fase_1_corrigido"] + $bombeamento["corrente_leitura_2_fase_2_corrigido"] + $bombeamento["corrente_leitura_2_fase_3_corrigido"]) / 3;
            $media_tensao_corrigida_1 = ($bombeamento["tensao_leitura_1_fase_1_corrigido"] + $bombeamento["tensao_leitura_1_fase_2_corrigido"] + $bombeamento["tensao_leitura_1_fase_3_corrigido"]) / 3;
            $media_tensao_corrigida_2 = ($bombeamento["tensao_leitura_2_fase_1_corrigido"] + $bombeamento["tensao_leitura_2_fase_2_corrigido"] + $bombeamento["tensao_leitura_2_fase_3_corrigido"]) / 3;
            
            if ($bombeamento['tipo_motor'] == "eletrico"){
                if (!isset($bombeamento["corrente_leitura_1_fase_1_corrigido"])) $bombeamento['indice_carregamento_1_fase_1_corrigido'] = 0;
                else $bombeamento['indice_carregamento_1_fase_1_corrigido'] = ($bombeamento["corrente_leitura_1_fase_1_corrigido"] / $cons) * 100;

                if (!isset($bombeamento["corrente_leitura_1_fase_2_corrigido"])) $bombeamento['indice_carregamento_1_fase_2_corrigido'] = 0;
                else $bombeamento['indice_carregamento_1_fase_2_corrigido'] = ($bombeamento["corrente_leitura_1_fase_2_corrigido"] / $cons) *100;
                
                if (!isset($bombeamento["corrente_leitura_1_fase_3_corrigido"])) $bombeamento['indice_carregamento_1_fase_3_corrigido'] = 0;
                else $bombeamento['indice_carregamento_1_fase_3_corrigido'] = ($bombeamento["corrente_leitura_1_fase_3_corrigido"] / $cons) * 100;

                if (!isset($bombeamento["corrente_leitura_2_fase_1_corrigido"])) $bombeamento['indice_carregamento_2_fase_1_corrigido'] = 0;
                else $bombeamento['indice_carregamento_2_fase_1_corrigido'] = ($bombeamento["corrente_leitura_2_fase_1_corrigido"] / $cons) * 100;

                if (!isset($bombeamento["corrente_leitura_2_fase_2_corrigido"])) $bombeamento['indice_carregamento_2_fase_2_corrigido'] = 0;
                else $bombeamento['indice_carregamento_2_fase_2_corrigido'] = ($bombeamento["corrente_leitura_2_fase_2_corrigido"] / $cons) * 100;
                
                if (!isset($bombeamento["corrente_leitura_3_fase_3_corrigido"])) $bombeamento['indice_carregamento_3_fase_3_corrigido'] = 0;
                else $bombeamento['indice_carregamento_3_fase_3_corrigido'] = ($bombeamento["corrente_leitura_3_fase_3_corrigido"] / $cons) * 100;

                if ($media_corrente_corrigida_1 == 0) $bombeamento['indice_carregamento_1_final_corrigido'] = 0;
                else ($bombeamento['indice_carregamento_1_final_corrigido'] = $media_corrente_corrigida_1 / $cons) * 100;

                if ($media_corrente_corrigida_2 == 0) $bombeamento['indice_carregamento_2_final_corrigido'] = 0;
                else ($bombeamento['indice_carregamento_2_final_corrigido'] = $media_corrente_corrigida_2 / $cons) * 100;
            }
            
            //Estimativa de custo de aplicação da lâmina
            $dados_estimativa_custo_lamina['num_motores'] += $bombeamento['numero_motores'];
            //$dados_estimativa_custo_lamina['motor'] = /* $bombeamento['tipo_motor']*/ "ERROR";

            if ($bombeamento['tipo_motor'] == 'eletrico'){
                $somatorio_potencia += ($bombeamento['potencia'] * $bombeamento['numero_motores'] * ($bombeamento->calcularMediaCorrentes())/$bombeamento['corrente_nominal']);
                $dados_estimativa_custo_lamina['consumo_eletrico_anual'] = number_format($dados_custo_lamina['eletrico']['consumo_anual'],2,",",".");
                $dados_estimativa_custo_lamina['custo_eletrico'] = round($dados_custo_lamina['eletrico']['custo_mm_ha'], 2);
                $dados_estimativa_custo_lamina['custo_medio'] = $dados_custo_lamina['eletrico']['custo_medio_kwh'];        
            }else{
                /** Verificar chaves da matriz */
                $dados_estimativa_custo_lamina['consumo_diesel_anual'] = number_format($dados_custo_lamina['diesel']['consumo_l_mm_ha'], 2);
                $dados_estimativa_custo_lamina['custo_diesel'] = $dados_custo_lamina['diesel']['custo_anual_mm_ha'];
                $dados_estimativa_custo_lamina['custo_medio_diesel'] = $dados_custo_lamina['diesel']['custo_h'];
            }            
        }

        $dados_estimativa_custo_lamina['potencia_total_sistema'] = number_format($somatorio_potencia + $somatorio_motorredutor, 2);

        //Dados Altura Manométrica
        $dados_altura_manometrica = [];
        $dados_altura_manometrica['desnivel_centro_ponto_mais_alto'] = $dados_afericao_hidraulica['altitude_mais_alto'] - $dados_afericao_hidraulica['altitude_centro'];
        $dados_altura_manometrica['perda_carga_parte_aerea'] = $dados_mapa_original[1][0]['perda_carga_parte_aerea'];
        $dados_altura_manometrica['altura_emissores'] = $dados_velocidade['altura_emissores'];
        $dados_altura_manometrica['pressao_ponta'] = $dados_afericao_hidraulica['pressao_ponta'];
        $dados_altura_manometrica['pressao_entrada_centro_pivo'] = $dados_afericao_hidraulica['pressao_centro'];
        $dados_altura_manometrica['desnivel_motobomba_centro'] = $total_desnivel_adutora;
        $dados_altura_manometrica['perda_carga_total_adutora'] = $total_hf;
        $dados_altura_manometrica['altura_manometrica_total_requerida'] = $total_hf + $total_desnivel_adutora + $dados_altura_manometrica['desnivel_centro_ponto_mais_alto'] +  $dados_altura_manometrica['perda_carga_parte_aerea'] + $dados_altura_manometrica['altura_emissores'] + $dados_altura_manometrica['pressao_ponta'];

        $lamina_conjugada = 0;
        if (!empty($dados_pivo_conjugado)){
            //Cálculo  da área total do sistema
            $area_total_sistema = $dados_mapa_original[0]['area_total_com_canhao'] + $dados_pivo_conjugado['area_pivo_01'] + $dados_pivo_conjugado['area_pivo_02'] + $dados_pivo_conjugado['area_pivo_03'] + $dados_pivo_conjugado['area_pivo_04'];
            
            //Cálculo de lâmina conjugada, caso o pivô tenha
            $lamina_conjugada =
            (
                ( (($dados_pivo_conjugado['area_pivo_01'] * $dados_pivo_conjugado['vazao_pivo_01']) + ($dados_pivo_conjugado['area_pivo_02'] * $dados_pivo_conjugado['vazao_pivo_02']) + ($dados_pivo_conjugado['area_pivo_03'] * $dados_pivo_conjugado['vazao_pivo_03']) + ($dados_pivo_conjugado['area_pivo_04'] * $dados_pivo_conjugado['vazao_pivo_04']) + ($dados_mapa_original[0]['area_total_com_canhao'] * $dados_mapa_original[0]['somatorio_vazao_ok']))
                / ($dados_pivo_conjugado['area_pivo_01'] + $dados_pivo_conjugado['area_pivo_02'] + $dados_pivo_conjugado['area_pivo_03'] + $dados_pivo_conjugado['area_pivo_04'] + $dados_mapa_original[0]['area_total_com_canhao']))
                / ($dados_pivo_conjugado['area_pivo_01'] + $dados_pivo_conjugado['area_pivo_02'] + $dados_pivo_conjugado['area_pivo_03'] + $dados_pivo_conjugado['area_pivo_04'] + $dados_mapa_original[0]['area_total_com_canhao'])
                * ($dados_ficha_tecnica->tempo_funcionamento / 10)
            );
            
            //Montagem do texto de observações
            if ($status_ft != 'noChange') {
                $texto_observacoes = __('fichaTecnica.areaTotalSistema').__('unidadesAcoes.(ha)').": ".number_format($area_total_sistema, 2)."; "
                .__('fichaTecnica.laminaConjugada').__('unidadesAcoes.(mm)').": ".number_format($lamina_conjugada, 2).". ";
             }
        }
        
        if ($status_ft != 'noChange') {
        //Problemas que possui
        $problemas_afericao = ProblemaAfericao::where('id_afericao', $id_afericao)->first();

        //Atribuindo quais são os problemas para o vetor
        $problemas = [];
        if ($problemas_afericao['problema_torre_central'] != null) array_push($problemas,  explode(',', $problemas_afericao['problema_torre_central']));

        if ($problemas_afericao['problema_valvula_psi'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_valvula_psi']));
        
        if ($problemas_afericao['problema_parte_aerea'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_parte_aerea']));

        if ($problemas_afericao['problema_canhao_final'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_canhao_final']));

        if ($problemas_afericao['problema_casa_bomba'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_casa_bomba']));

        if ($problemas_afericao['problema_adutora'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_adutora']));

        if ($problemas_afericao['problema_chave_partida'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_chave_partida']));

        if ($problemas_afericao['problema_succao'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_succao']));

        if ($problemas_afericao['problema_motor_principal'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_motor_principal']));

        if ($problemas_afericao['problema_bomba_principal'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_bomba_principal']));

        if ($problemas_afericao['problema_motor_auxiliar'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_motor_auxiliar']));

        if ($problemas_afericao['problema_bomba_auxiliar'] != null) array_push($problemas, explode(',', $problemas_afericao['problema_bomba_auxiliar']));

        //Percorrendo todos os problemas e adicionando ao texto de observação
        foreach($problemas AS $problema){
            for ($i=0; $i<count($problema); $i++){
                $texto_observacoes = $texto_observacoes.__('afericao.problema'.$problema[$i])."; ";
            }
        }

        //Texto para velocidade a 100%
        if(isset($dados_velocidade_red['tabela_resultante']['maior_variacao']))
            $texto_velocidade_100 = __('fichaTecnica.textoVelocidade100_1', ['media_velocidade' => number_format($dados_velocidade_red['verificacao_velocidade']['media_velocidade'], 2), 'lamina' => number_format($velocidade_pivo[100]['lamina_mm'], 2), 'maior_variacao' => number_format(($dados_velocidade_red['tabela_resultante']['maior_variacao'] * 100), 2)]);
        else
            $texto_velocidade_100 = __('fichaTecnica.textoVelocidade100_1', ['media_velocidade' => number_format($dados_velocidade_red['verificacao_velocidade']['media_velocidade'], 2), 'lamina' => number_format($velocidade_pivo[100]['lamina_mm'], 2)]);
        
        if (isset($dados_velocidade_red['tabela_resultante']['maior_positivo'])){
            if(($dados_velocidade_red['tabela_resultante']['maior_positivo'] > 0.05) || ($dados_velocidade_red['tabela_resultante']['maior_negativo'] < -0.005)){
                $texto_velocidade_100 = $texto_velocidade_100.__('fichaTecnica.textoVelocidade100_2');
            }else{
                $texto_velocidade_100 = $texto_velocidade_100.__('fichaTecnica.textoVelocidade100_3');
            }
            if(($dados_velocidade_red['tabela_resultante']['maior_positivo'] > 0.05) || ($dados_velocidade_red['tabela_resultante']['maior_negativo'] < -0.005)){
                $texto_velocidade_100 = $texto_velocidade_100.__('fichaTecnica.textoVelocidade100_4');
            }else{
                $texto_velocidade_100 = $texto_velocidade_100.__('fichaTecnica.textoVelocidade100_5');
            }
        }
        }
        
        //Arrays para o gráfico de velocidade
        $projetada = [];
        $aferida   = [];
        foreach($dados_velocidade_red['tabela_resultante'] as $key => $dado){
            if (substr($key, 0, 7) == 'projeto') array_push($projetada, $dado);
            if (substr($key, 0, 6) == 'medido') array_push($aferida, $dado);
        }
        sort($projetada);
        //rsort($aferida);
        sort($aferida);
        $projetada = json_encode($projetada);
        $aferida   = json_encode($aferida);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////// FIM TEXTO VELOCIDADE

        //Textos para a conclusão

        //Valor de pressão para o tipo da válvula
        if ($dados_ficha_tecnica->valv_reguladoras == 10) $valor_pressao = 7.029;
        if ($dados_ficha_tecnica->valv_reguladoras == 15) $valor_pressao = 10.5435;
        if ($dados_ficha_tecnica->valv_reguladoras == 20) $valor_pressao = 14.058;
        if ($dados_ficha_tecnica->valv_reguladoras == 25) $valor_pressao = 17.5725;
        if ($dados_ficha_tecnica->valv_reguladoras == 30) $valor_pressao = 21.087;
        if ($dados_ficha_tecnica->valv_reguladoras == 35) $valor_pressao = 24.6015;
        if ($dados_ficha_tecnica->valv_reguladoras == 40) $valor_pressao = 28.116;
        if ($dados_ficha_tecnica->valv_reguladoras == 45) $valor_pressao = 31.6305;
        if ($dados_ficha_tecnica->valv_reguladoras == 50) $valor_pressao = 35.145;
        
        if ($status_ft != 'noChange') {
        //add uniformidade no texto da conclusão
        if($dados_ficha_tecnica['tipo_projeto'] == "A"){
            $texto_conclusao = __('fichaTecnica.conclusao17');

            if($dados_mapa_original[0]['uniformidade_aplicacao'] > 90){
                $texto_conclusao = $texto_conclusao .  __('fichaTecnica.conclusao14');
            }else if ($dados_mapa_original[0]['uniformidade_aplicacao'] < 90 && $dados_mapa_original[0]['uniformidade_aplicacao'] > 85){
                $texto_conclusao = $texto_conclusao .  __('fichaTecnica.conclusao15');
            }else{
                $texto_conclusao = $texto_conclusao .  __('fichaTecnica.conclusao16');
            }

            //Validação quanto a pressão da válvula
            if ($dados_altura_manometrica['pressao_ponta'] < $valor_pressao){
                $texto_conclusao = $texto_conclusao . __('fichaTecnica.conclusao1');
            }
            else if ($dados_altura_manometrica['pressao_ponta'] < $valor_pressao*1.4 ){
                $texto_conclusao = $texto_conclusao . __('fichaTecnica.conclusao2');
            }
            else if($dados_altura_manometrica['pressao_ponta'] >= $valor_pressao*1.4 && $dados_altura_manometrica['pressao_ponta'] <= $valor_pressao*3.5){
                $texto_conclusao = $texto_conclusao . __('fichaTecnica.conclusao13');
            }
            else{
                $texto_conclusao = $texto_conclusao . __('fichaTecnica.conclusao3');
            }

            $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao4', ['x' => count($bombeamentos)]);

            foreach($bombeamentos AS $key => $bombemanto){
                $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao5', ['a' => $key+1, 'y' => $bombeamento['numero_motores']]);
            }
            foreach($bombeamentos AS $key => $bombemanto){
                $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao6', ['x' => $key+1, 'n' => number_format($bombeamento['indice_carregamento_1_final_corrigido'] * 100, 2)]);
                if ($bombeamento['indice_carregamento_1_final_corrigido'] < 0.7) $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao7');
                if ($bombeamento['indice_carregamento_1_final_corrigido'] > 0.7) $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao8');
                if ($bombeamento['indice_carregamento_1_final_corrigido'] > 1) $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao9');
            }

            $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao10');

            //Montando parte da condição para a parte final do texto
            if (isset($dados_velocidade_red['tabela_resultante']['variacao_100'])){
                if (max($dados_velocidade_red['tabela_resultante']['variacao_100'], $dados_velocidade_red['tabela_resultante']['variacao_90'], $dados_velocidade_red['tabela_resultante']['variacao_80'], $dados_velocidade_red['tabela_resultante']['variacao_70'], $dados_velocidade_red['tabela_resultante']['variacao_60'], $dados_velocidade_red['tabela_resultante']['variacao_50'], $dados_velocidade_red['tabela_resultante']['variacao_40']) == 0){
                    $condicao1 = min($dados_velocidade_red['tabela_resultante']['variacao_100'], $dados_velocidade_red['tabela_resultante']['variacao_90'], $dados_velocidade_red['tabela_resultante']['variacao_80'], $dados_velocidade_red['tabela_resultante']['variacao_70'], $dados_velocidade_red['tabela_resultante']['variacao_60'], $dados_velocidade_red['tabela_resultante']['variacao_50'], $dados_velocidade_red['tabela_resultante']['variacao_40']);
                }else{
                    $condicao1 = max($dados_velocidade_red['tabela_resultante']['variacao_100'], $dados_velocidade_red['tabela_resultante']['variacao_90'], $dados_velocidade_red['tabela_resultante']['variacao_80'], $dados_velocidade_red['tabela_resultante']['variacao_70'], $dados_velocidade_red['tabela_resultante']['variacao_60'], $dados_velocidade_red['tabela_resultante']['variacao_50'], $dados_velocidade_red['tabela_resultante']['variacao_40']);
                }            

                if ($condicao1 > 0.05 || $condicao1 < -0.05) $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao11');
                else $texto_conclusao = $texto_conclusao.__('fichaTecnica.conclusao12');
            }
        }else{
            $texto_conclusao = __('fichaTecnica.conclusao18');
        }
        }

        //Montagem do texto para COMPOSIÇÃO PARTE AÉREA
        $texto_composicao = "";
        $dados_lances = Lance::where('id_afericao', $id_afericao)->orderby('numero_lance', 'asc')->get();


        //Dados dos lances
        $dados_lances2 = Lance::join('emissores as E', 'E.id_lance', 'lances.id')
        ->where('id_afericao', $id_afericao)
        ->orderby('numero_lance', 'asc')
        ->orderby('E.numero', 'asc')
        ->get();

        $total_bocais = count($dados_lances2);

        if ( $tipo_projeto == 'R') {
            // Query para listar as saidas dentro de cada lance e suas quantidades do redimensionamento SAIDA 1
            $range_id_lance = Lance::select(DB::raw('group_concat(id) as lances'))->where('id_afericao', $id_afericao_redimensionamento)->get();
            $range = $range_id_lance[0]['lances'];
            $lista_bocais_compra = Emissor::select('saida_1', DB::raw('count(*) as quantidade'))
            ->where(\DB::raw("FIND_IN_SET(id_lance, '".$range."')"),">",\DB::raw("'0'"))
            ->groupby('saida_1')->orderby('saida_1')->get();

            // Query para listar as saidas dentro de cada lance e suas quantidades do redimensionamento SAIDA 2
            $range_id_lance = Lance::select(DB::raw('group_concat(id) as lances'))->where('id_afericao', $id_afericao_redimensionamento)->get();
            $range = $range_id_lance[0]['lances'];
            $lista_bocais_compra2 = Emissor::select('saida_2', DB::raw('count(*) as quantidade'))
            ->where(\DB::raw("FIND_IN_SET(id_lance, '".$range."')"),">",\DB::raw("'0'"))
            ->groupby('saida_2')->orderby('saida_2')->get();

            foreach ($lista_bocais_compra as $total) {
                foreach ($lista_bocais_compra2 as $total_2){
                    if ($total['saida_1'] == $total_2['saida_2']) {
                        $total['quantidade'] = $total['quantidade'] + $total_2['quantidade'];
                    }
                }
            }

            // Query para listar as saidas dentro de cada lance e suas quantidades da afericao SAIDA 1
            $range_id_lance_afericao = Lance::select(DB::raw('group_concat(id) as lances'))->where('id_afericao', $id_afericao_original)->get();
            $range_afericao = $range_id_lance_afericao[0]['lances'];
            $lista_bocais_afericao = Emissor::select('saida_1', DB::raw('count(*) as quantidade'))
            ->where(\DB::raw("FIND_IN_SET(id_lance, '".$range_afericao."')"),">",\DB::raw("'0'"))
            ->groupby('saida_1')->orderby('saida_1')->get();

            
            // Query para listar as saidas dentro de cada lance e suas quantidades da afericao SAIDA 2
            $range_id_lance_afericao = Lance::select(DB::raw('group_concat(id) as lances'))->where('id_afericao', $id_afericao_original)->get();
            $range_afericao = $range_id_lance_afericao[0]['lances'];
            $lista_bocais_afericao_2 = Emissor::select('saida_2', DB::raw('count(*) as quantidade'))
            ->where(\DB::raw("FIND_IN_SET(id_lance, '".$range_afericao."')"),">",\DB::raw("'0'"))
            ->groupby('saida_2')->orderby('saida_2')->get();
            
            foreach ($lista_bocais_afericao as $total_afericao) {
                foreach ($lista_bocais_afericao_2 as $total_2_afericao){
                    if ($total_afericao['saida_1'] == $total_2_afericao['saida_2']) {
                        $total_afericao['quantidade'] = $total_afericao['quantidade'] + $total_2_afericao['quantidade'];
                    }
                }
            }

            $lista_saldo = array();
            foreach ($lista_bocais_compra as $compras) {
                $contador = 0;
                if ($compras['saida_1'] == 0) continue;

                foreach ($lista_bocais_afericao as $lista){
                    if ($compras['saida_1'] == $lista['saida_1']) {
                        if ($compras['quantidade'] > $lista['quantidade']) {
                            $lista_saldo[] = array('saida_1' => $lista['saida_1'], 
                                                   'quantidade' => ($compras['quantidade'] - $lista['quantidade']));
                        }
                        break;
                    }
                    $contador += 1;

                    if ($contador == count($lista_bocais_afericao)) {
                        $lista_saldo[] = array('saida_1' => $compras['saida_1'], 
                                                'quantidade' => ($compras['quantidade']));
                    }
                }
            }
        }


        
        $emissor_max = Lance::where('id_afericao', $id_afericao)->max('numero_emissores');  
        //Percorrendo o array para verificar repetições para contagem de lances e verificando o diametro
        $tubos_lp = $tubos_lm = $tubos_ll = $tubos_lel = $qtd_emissores = 0;
        foreach($dados_lances AS $key => $lances){
            if ($lances['numero_tubos'] == 6){
                $tubos_lp += 1;
                if ($lances['diametro'] >= 0.1413 && $lances['diametro'] < 0.1524) $diametro_lp = '5.9/16"';
                if ($lances['diametro'] >= 0.1524 && $lances['diametro'] < 0.1683) $diametro_lp = '6"';
                if ($lances['diametro'] >= 0.1683 && $lances['diametro'] < 0.2032) $diametro_lp = '6.5/8"';
                if ($lances['diametro'] >= 0.2032 && $lances['diametro'] < 0.219) $diametro_lp = '8"';
                if ($lances['diametro'] >= 0.219 && $lances['diametro'] < 0.254) $diametro_lp = '8.5/8"';
                if ($lances['diametro'] >= 0.254) $diametro_lp = '10"';
            }
            if ($lances['numero_tubos'] == 7){
                $tubos_lm += 1;
                if ($lances['diametro'] >= 0.1413 && $lances['diametro'] < 0.1524) $diametro_lm = '5.9/16"';
                if ($lances['diametro'] >= 0.1524 && $lances['diametro'] < 0.1683) $diametro_lm = '6"';
                if ($lances['diametro'] >= 0.1683 && $lances['diametro'] < 0.2032) $diametro_lm = '6.5/8"';
                if ($lances['diametro'] >= 0.2032 && $lances['diametro'] < 0.219) $diametro_lm = '8"';
                if ($lances['diametro'] >= 0.219 && $lances['diametro'] < 0.254) $diametro_lm = '8.5/8"';
                if ($lances['diametro'] >= 0.254) $diametro_lm = '10"';
            }
            if ($lances['numero_tubos'] == 8){
                $tubos_ll += 1;
                if ($lances['diametro'] >= 0.1413 && $lances['diametro'] < 0.1524) $diametro_ll = '5.9/16"';
                if ($lances['diametro'] >= 0.1524 && $lances['diametro'] < 0.1683) $diametro_ll = '6"';
                if ($lances['diametro'] >= 0.1683 && $lances['diametro'] < 0.2032) $diametro_ll = '6.5/8"';
                if ($lances['diametro'] >= 0.2032 && $lances['diametro'] < 0.219) $diametro_ll = '8"';
                if ($lances['diametro'] >= 0.219 && $lances['diametro'] < 0.254) $diametro_ll = '8.5/8"';
                if ($lances['diametro'] >= 0.254) $diametro_ll = '10"';
            }
            if ($lances['numero_tubos'] == 9){
                $tubos_lel += 1;
                if ($lances['diametro'] >= 0.1413 && $lances['diametro'] < 0.1524) $diametro_lel = '5.9/16"';
                if ($lances['diametro'] >= 0.1524 && $lances['diametro'] < 0.1683) $diametro_lel = '6"';
                if ($lances['diametro'] >= 0.1683 && $lances['diametro'] < 0.2032) $diametro_lel = '6.5/8"';
                if ($lances['diametro'] >= 0.2032 && $lances['diametro'] < 0.219) $diametro_lel = '8"';
                if ($lances['diametro'] >= 0.219 && $lances['diametro'] < 0.254) $diametro_lel = '8.5/8"';
                if ($lances['diametro'] >= 0.254) $diametro_lel = '10"';
            }
        }

        //Concatenando os textos
        if (!empty($tubos_lel)) $texto_composicao = $tubos_lel." LEL ".$diametro_lel;

        if (!empty($texto_composicao)) {
            if (!empty($tubos_ll)) $texto_composicao = $texto_composicao." + ".$tubos_ll." LL ".$diametro_ll;
        }else{
            if (!empty($tubos_ll)) $texto_composicao = $tubos_ll." LL ".$diametro_ll;  
        }

        if (!empty($texto_composicao)) {
            if (!empty($tubos_lm)) $texto_composicao = $texto_composicao." + ".$tubos_lm." LM ".$diametro_lm;
        }else{
            if (!empty($tubos_lm)) $texto_composicao = $tubos_lm." LM ".$diametro_lm;
        }

        if (!empty($texto_composicao)) {
            if (!empty($tubos_lp)) $texto_composicao = $texto_composicao." + ".$tubos_lp." LP ".$diametro_lp;
        }else{
            if (!empty($tubos_lp)) $texto_composicao = $tubos_lp." LP ".$diametro_lp;
        }
        
        if ($afericao['tem_balanco'] == "sim"){
            $texto_composicao = $texto_composicao." + ".__('fichaTecnica.balanco')." = ".$dados_mapa_original[0]['balanco'];
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////// FIM TEXTO COMPOSIÇÃO PARTE AÉREA

        $mapa = $dados_mapa_original[1];
        if(count($mapa) > 0){
            //$afericao = AfericaoPivoCentral::select('tem_balanco', 'numero_lances')->where('id', $id_afericao)->first();
            $laminas_medias = array();
            $laminas = array();
            $emissores = array();
            foreach($mapa as $index => $linha){
                array_push($laminas, $linha['lamina_aplicada']);
                array_push($laminas_medias, $linha['lamina_media']);
                array_push($emissores, ($index + 1));
            }
            $laminas = json_encode($laminas);
            $laminas_medias = json_encode($laminas_medias);
            $emissores = json_encode($emissores);
        }

        if ($status_ft != 'noChange') {
            $vt_ficha_tecnica = [];

            $vt_ficha_tecnica['id_afericao'] = $id_afericao;
            $vt_ficha_tecnica['txt_observacoes'] = $texto_observacoes;
            $vt_ficha_tecnica['txt_teste_velocidade'] = $texto_velocidade_100;
            $vt_ficha_tecnica['txt_uniformidade'] = $texto_uniformidade;
            $vt_ficha_tecnica['txt_conclusao'] = $texto_conclusao;
            $vt_ficha_tecnica['versoes'] = $dados_ficha_tecnica['versoes'];

            // dados da ficha técnica
            $vt_ficha_tecnica['composicao_parte_aerea'] = $texto_composicao;
            $vt_ficha_tecnica['area_total'] = $dados_velocidade['area_total_com_canhao'];
            $vt_ficha_tecnica['lamina_diaria'] = $dados_mapa_original[0]['lamina'];
            $vt_ficha_tecnica['raio_irrigado'] = $dados_velocidade['raio_irrigado'];
            $vt_ficha_tecnica['vazao_total'] = $dados_mapa_original[0]['vazao_sistema'];
            $vt_ficha_tecnica['uniformidade_aplicacao'] = $dados_mapa_original[0]['uniformidade_aplicacao'];
            $vt_ficha_tecnica['raio_ultima_torre'] = $dados_mapa_original[0]['raio_ultima_torre'];
            $vt_ficha_tecnica['balanco'] = $dados_mapa_original[0]['balanco'];
            $vt_ficha_tecnica['velocidade_a_100'] = $dados_velocidade_red['verificacao_velocidade']['media_velocidade'];
            $vt_ficha_tecnica['alcance_canhao'] = $dados_mapa_original[0]['alcance_canhao_final'];
            $vt_ficha_tecnica['tempo_a_100'] = $dados_mapa_original[0]['tempo_a_100'];
            $vt_ficha_tecnica['altura_emissores'] = $dados_velocidade['altura_emissores'];
            $vt_ficha_tecnica['lamina_conjugada'] = $lamina_conjugada;
            $vt_ficha_tecnica['desnivel_centro_ao_ponto_mais_alto'] = $dados_altura_manometrica['desnivel_centro_ponto_mais_alto'];
            $vt_ficha_tecnica['perda_carga_parte_aerea'] = $dados_altura_manometrica['pressao_entrada_centro_pivo'];
            $vt_ficha_tecnica['desnivel_motobomba'] = $dados_altura_manometrica['desnivel_motobomba_centro'];
            $vt_ficha_tecnica['perda_carga_total_adutora'] = $dados_altura_manometrica['perda_carga_total_adutora'];
            $vt_ficha_tecnica['pressao_ponta'] = $dados_altura_manometrica['pressao_ponta'];
            $vt_ficha_tecnica['altura_manometrica'] = $dados_altura_manometrica['altura_manometrica_total_requerida'];
            $vt_ficha_tecnica['potencia_total_sistema'] = (float)$dados_estimativa_custo_lamina['potencia_total_sistema'];
            $vt_ficha_tecnica['lamina_anual'] = $dados_estimativa_custo_lamina['lamina_anual'];
            $vt_ficha_tecnica['consumo_eletrico_anual'] = (float)$dados_estimativa_custo_lamina['consumo_eletrico_anual'];
            $vt_ficha_tecnica['custo_eletrico'] = $dados_estimativa_custo_lamina['custo_eletrico'];


            // dados da adutora
            $vt_ft_adutora = array();
            foreach ($trechos_adutora as $key => $trecho) {

                switch ($trecho['material']) {
                    case 0:
                        $material = __('afericao.acoSac'); break;
                    case 1:
                        $material = __('afericao.az'); break;
                    case 2:
                        $material = "__('afericao.ferroFundido')"; break;
                    case 3:
                        $material = "PVC PN 125"; break;
                    case 4:
                        $material = "PVC PN 140"; break;
                    case 5:
                        $material = "PVC PN 180"; break;
                    case 6:
                        $material = "PVC PN 60"; break;
                    case 7:
                        $material = "PVC PN 80"; break;
                    case 8:
                        $material = "RPVC PN 100"; break;
                    case 9:
                        $material = __('afericao.aluminio'); break;
                }

                $vt_ft_adutora[] = array(
                    'trecho_adutora' => ($key + 1),
                    'coeficiente_hf' => $dados_adutora[$key]['hf'],
                    'velocidade' => $dados_adutora[$key]['velocidade'],
                    'pressao_inicial' => $dados_adutora[$key]['pressao_inicial'],
                    'pressao_final' => $dados_adutora[$key]['pressao_final'],
                    'diametro' => $trecho['diametro'],
                    'comprimento' => $trecho['comprimento'],
                    'material' => $material
                );                 
            }

            // dados funcionamento pivo
            $vt_ft_funcio_pivo = array();
            for ($i = 100; $i >= 5; $i-=5) {
                $vt_ft_funcio_pivo[] = array( 
                    'velocidade' => $i,
                    'volta' => $velocidade_pivo[$i]['volta'],
                    'volta_1_meio' => $velocidade_pivo[$i]['volta_1_2'],
                    'volta_1_quarto' => $velocidade_pivo[$i]['volta_1_4'],
                    'lamina' => $velocidade_pivo[$i]['lamina_mm']
                );
            }

            // dados redimensionamento percentimetro
            $vt_ft_redimen_perc = array();
            for ($j=100; $j>=10; $j-=10) {
                $vt_ft_redimen_perc[] = array(
                    'percentimetro' => $j,
                    'projeto' => $dados_velocidade_red['tabela_resultante']['projeto_'.$j.''],
                    'medida' => $dados_velocidade_red['tabela_resultante']['medido_'.$j.''],
                    'variacao' => $dados_velocidade_red['tabela_resultante']['variacao_'.$j.'']
                );
            }

            $id_ficha_tecnica = $this->saveDatasheet($vt_ficha_tecnica, $vt_ft_adutora, $vt_ft_funcio_pivo, $vt_ft_redimen_perc, $status_ft);
        } else {
            $ficha_tecnica = fichaTecnica::where('id_afericao', $id_afericao)->get();
            $id_ficha_tecnica = $ficha_tecnica[0]['id'];
        }
        
        return view('projetos.afericao.pivoCentral.relatorio.fichaTecnica.fichaTecnica', compact('id_afericao', 'id_ficha_tecnica', 'afericao', 'cabecalho_bombeamento', 'dados_coordenadas', 'lista_bocais_compra',
        'bombeamentos', 'dados_ficha_tecnica', 'dados_estimativa_custo_lamina', 'trechos_adutora', 'dados_adutora', 'dados_mapa_original', 'dados_velocidade', 'dados_lances', 'emissor_max', 'dados_lances2',
        'dados_velocidade_red', 'dados_altura_manometrica', 'dados_custo_lamina', 'velocidade_pivo', 'dados_bocais_redimensionamento', 'dados_bocais_afericao', 'total_bocais', 'lista_saldo',
        'texto_observacoes', 'texto_velocidade_100','texto_uniformidade', 'projetada', 'aferida', 'texto_conclusao', 'lamina_conjugada', 'texto_composicao', 'laminas', 'laminas_medias', 'emissores'));
    }

    public function saveDatasheet($vt_ficha_tecnica, $vt_ft_adutora, $vt_ft_funcio_pivo, $vt_ft_redimen_perc, $modo)
    {
        $dados = $vt_ficha_tecnica;
        $id_ficha_tecnica = 0;
        
        if ($modo == 'insert') {
            // gravando dados da ficha técnica
            fichaTecnica::create($dados);

            $ficha_tecnica = fichaTecnica::where('id_afericao', $dados['id_afericao'])->get();
            $id_ficha_tecnica = $ficha_tecnica[0]['id'];
        } else {
            $ficha_tecnica = fichaTecnica::where('id_afericao', $dados['id_afericao'])->get();
            $id_ficha_tecnica = $ficha_tecnica[0]['id'];
            fichaTecnica::where('id_afericao', $dados['id_afericao'])->update($dados);
        }

        if ($modo != 'insert'){
            //Sucesso!
            //Removendo as tabelas ligadas a ficha técnica
            FichaTecnicaAdutora::where('id_ficha_tecnica', $id_ficha_tecnica)->delete();
            FichaTecnicaFuncioPivo::where('id_ficha_tecnica', $id_ficha_tecnica)->delete();
            FichaTecnicaRedimenPerc::where('id_ficha_tecnica', $id_ficha_tecnica)->delete();
        }
        
        // gravando ficha tecnica da adutora
        if (count($vt_ft_adutora) > 0) {
            foreach ($vt_ft_adutora['trecho_adutora'] as $ft_adutora) {
                $trecho_adutora = [];
                $trecho_adutora['id_ficha_tecnica'] = $id_ficha_tecnica;
                $trecho_adutora['trecho_adutora'] = $ft_adutora['trecho_adutora'];
                $trecho_adutora['coeficiente_hf'] = $ft_adutora['coeficiente_hf'];
                $trecho_adutora['velocidade'] = $ft_adutora['velocidade'];
                $trecho_adutora['pressao_inicial'] = $ft_adutora['pressao_inicial'];
                $trecho_adutora['pressao_final'] = $ft_adutora['pressao_final'];
                $trecho_adutora['diametro'] = $ft_adutora['diametro'];
                $trecho_adutora['comprimento'] = $ft_adutora['comprimento'];
                $trecho_adutora['material'] = $ft_adutora['material'];
                FichaTecnicaAdutora::create($trecho_adutora);
                unset($trecho_adutora);
            }
        }

        // gravando ficha tecnica de funcionamento do pivo
        if (count($vt_ft_funcio_pivo) > 0) {
            foreach ($vt_ft_funcio_pivo['velocidade'] as $ft_funcio_pivo) {
                $trecho_funcio_pivo = [];
                $trecho_funcio_pivo['id_ficha_tecnica'] = $id_ficha_tecnica;
                $trecho_funcio_pivo['velocidade'] = $ft_funcio_pivo['velocidade'];
                $trecho_funcio_pivo['volta'] = $ft_funcio_pivo['volta'];
                $trecho_funcio_pivo['volta_1_meio'] = $ft_funcio_pivo['volta_1_meio'];
                $trecho_funcio_pivo['volta_1_quarto'] = $ft_funcio_pivo['volta_1_quarto'];
                $trecho_funcio_pivo['volta_1_quarto'] = $ft_funcio_pivo['coeficiente_hw_total'];
                FichaTecnicaFuncioPivo::create($trecho_funcio_pivo);
                unset($trecho_funcio_pivo);
            }
        }

        // gravando ficha tecnica do redimensionamento percentimetro
        if (count($vt_ft_redimen_perc) > 0) {
            foreach ($vt_ft_redimen_perc['percentimetro'] as $ft_redimen_perc) {
                $trecho_redimen_perc = [];
                $trecho_redimen_perc['id_ficha_tecnica'] = $id_ficha_tecnica;
                $trecho_redimen_perc['percentimetro'] = $ft_redimen_perc['percentimetro'];
                $trecho_redimen_perc['projeto'] = $ft_redimen_perc['projeto'];
                $trecho_redimen_perc['medida'] = $ft_redimen_perc['medida'];
                $trecho_redimen_perc['variacao'] = $ft_redimen_perc['variacao'];
                FichaTecnicaRedimenPerc::create($trecho_redimen_perc);
                unset($trecho_redimen_perc);
            }
        }

        return $id_ficha_tecnica;
    }
    
    public function updateDatasheet(Request $req)
    {
        $dados = $req->all();
        fichaTecnica::find($dados['id'])->update($dados);

        $ficha_tecnica = fichaTecnica::where('id', $dados['id'])->get();
        $id_afericao = $ficha_tecnica[0]['id_afericao'];
        
        $atualizouFichatecnica = AfericaoPivoCentralController::updateVersion($dados['id_afericao']);
        $menssagem_retorno = ($atualizouFichatecnica) ? __('fichaTecnica.editar_ficha_tecnica_sucesso').__('fichaTecnica.atualizaou_fichatecnica') : __('fichaTecnica.editar_ficha_tecnica_sucesso') ;
        Notificacao::gerarAlert('',$menssagem_retorno, 'success');
        return redirect()->route('gauging_status', $id_afericao);
    }
}