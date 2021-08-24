<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Sistema\Bocal;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\CanhaoFinal;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Constantes\Notificacao;
use Auth;
use DB;




class MapaOriginal extends Model
{

    protected $fillable = [
        'id_afericao' , 'id_emissor', 'id_usuario', 'posicao_emissor', 'vazao_aspersor',
        'vazao_liberada', 'pressao_entrada', 'lamina_media', 'lamina_aplicada',


        'area_aspersor', 'area_acumulada', 'vazao_spray_requerida', 'q_bocal_1', 'q_bocal_2',
        'comprimento', 'q_max_valvula', 'vazao_sprays_teorica', 'vazao_sprays_real', 'velocidade', 'perda_carga_teorica',
        'perda_carga_real', 'perda_pressao_acumulada_real', 'pressao_saida', 'aai', 'si', 'li', 'li_si',
        'desvios', 'si_desvios'
    ];

    public static function gerarMapaOriginal($id_afericao, $calcula_velocidade = null)
    {
        /**
         * Esta função realiza os cálculos para a geração do mapa original
         * 
         * Neste processo, são realizados três blocos de cálculo, estes blocos são necessários devido a existência de somatórios ao longo da execução,
         * que devem ser calculados inicialmente para serem usados adiante
         */

        //Inicialização das variáveis
        $mapa = [];
        $entrada = [];
        $mapa_original = [];
        /* Inicialização de variaveis de próximo e anterior */
        $anterior = [];
        $proximo = [];
        

        /* Recuperando dados da aferição */
        $entrada = AfericaoPivoCentral::
            select(
                'afericoes_pivos_centrais.tempo_funcionamento as tempo','afericoes_pivos_centrais.valv_reguladoras as valvula_reguladora', 'afericoes_pivos_centrais.id as id_afericao','afericoes_pivos_centrais.lamina_anual as lamina_anual',
                'afericoes_pivos_centrais.giro_equipamento as angulo_pivo','afericoes_pivos_centrais.marca_modelo_emissores as modelo_emissores',  'afericoes_pivos_centrais.altura_emissores', 'afericoes_pivos_centrais.defletor as defletor', 'afericoes_pivos_centrais.custo_medio as custo_medio',
                'AH.rugosidade as coeficiente_rugosidade', 'AH.altitude_centro as altitude_centro', 'AH.altitude_mais_alto as altitude_mais_alto', 
                'AH.pressao_centro as pressao_centro','AH.pressao_ponta as pressao_ponta', 'CF.vazao_canhao_final as vazao_canhao' , 'CF.vazao_canhao_final as vazao_canhao_final', 'CF.alcance_canhao_final as alcance_canhao_final', 'afericoes_pivos_centrais.tem_balanco',
                'afericoes_pivos_centrais.numero_lances'
            )->
            leftjoin('pivos_conjugados as PC', function($join)
            {
                $join->on('afericoes_pivos_centrais.id', '=', 'PC.id_afericao')
                ->whereNull('PC.deleted_at');
            })->
            leftjoin('canhoes_finais as CF', function($join)
            {
                $join->on('afericoes_pivos_centrais.id', '=', 'CF.id_afericao')
                ->whereNull('CF.deleted_at');
            })->
            leftjoin('afericao_hidraulicas as AH', 'afericoes_pivos_centrais.id', 'AH.id_afericao')->
            where('afericoes_pivos_centrais.id', $id_afericao)->
            /*where('afericoes_pivos_centrais.tipo_projeto', 'A')->*/
            first();

        /* Recuperando dados dos emissores */
        $aspersores = Emissor::select(
            'emissores.saida_1 as bocal_1', 'emissores.saida_2 as bocal_2', 'emissores.emissor as fabricante', 'emissores.espacamento as espacamento', 'emissores.numero as numero',
            'emissores.diametro', 'emissores.psi as valvulas_reguladoras_psi', 'emissores.tipo_valvula as valvulas_reguladoras_tipo', 'emissores.id as id_emissor',
            'L.numero_lance as lance', 'B1.vazao as vazao_1', 'B2.vazao as vazao_2'
        )->
        join('lances as L', 'emissores.id_lance', 'L.id')->
        leftJoin('bocais as B1', function($join)
        {
            $join->on('emissores.saida_1', '=', 'B1.nome');
            $join->on('emissores.emissor', '=', 'B1.fabricante');
        })->
        leftJoin('bocais as B2', function($join)
        {
            $join->on('emissores.saida_2', '=', 'B2.nome');
            $join->on('emissores.emissor', '=', 'B2.fabricante');
        })->
        where('L.id_afericao', $id_afericao)->orderBy('L.numero_lance', 'asc')->orderBy('emissores.numero', 'asc')->
        groupBy('emissores.id')->
        get();


        $entrada['desnivel_total'] = $entrada['altitude_mais_alto'] - $entrada['altitude_centro'];

        // Atribuição inicial de valores para variáveis de outras colunas
        $proximo['comprimento_proximo'] = 0; 
        $anterior['comprimento_anterior'] = 0; 
        $anterior['q_total_teorica_anterior'] = "primeiro"; 
        $anterior['q_total_real_anterior'] = 0; 
        $anterior['perda_pressao_acumulada_real_anterior'] = 0;

        $entrada['somatorio_perda_carga_real'] = 0;
        $entrada['somatorio_espacamentos'] = 0;
        $entrada['qt_emissores_5_porcento'] = 0;

        $entrada['comprimento_balanco'] = 0;
        $entrada['numero_saidas_sem_plug'] = 0;
      
        $comprimento_ultimo_lance = 0;

        //obtendo o somatório de pressao ok e espacamentos
        $entrada['somatorio_vazao_ok'] = 0;
        foreach ($aspersores as $key => $aspersor) {
            
            //Jogando para baixo o valor da vazão para valores de bocais não registrados
            if($aspersor['vazao_1'] == null && $aspersor['bocal_1'] != 0){
                $aspersor['vazao_1'] = 0.000001;
            }
            if($aspersor['vazao_2'] == null && $aspersor['bocal_2'] != 0){
                $aspersor['vazao_2'] = 0.000001;
            }

            //Realizando o somatório das saídas que tem emissor instalado
            if($aspersor['bocal_1'] != 0){
                $entrada['numero_saidas_sem_plug']+=1;
            }
            if($aspersor['bocal_2'] != 0){
                $entrada['numero_saidas_sem_plug']+=1;
            }
            
            //Verificando se o emissor é de I-WOB ou I-WOB ou NELSON ou KOMET
            if($aspersor['fabricante'] == "I-WOB" || $aspersor['fabricante'] == "I-WOB UP3" || $aspersor['fabricante'] == "NELSON" || $aspersor['fabricante'] == "KOMET" ){
                $entrada['qt_emissores_5_porcento'] = $entrada['qt_emissores_5_porcento'] + 1;
            }

            $q1 = $aspersor['vazao_1'];
            $q2 = $aspersor['vazao_2'];
            $vr = MapaOriginal::getValorValvulaReguladoraMca($aspersor['valvulas_reguladoras_psi']  . " PSI");
            $pb = MapaOriginal::getPressaoCadastroBocal($aspersor['fabricante']); 
            $vazao = ($q1 * pow($vr, (0.5))) / pow(($pb), (0.5)) + ($q2 * pow($vr, (0.5))) / pow(($pb), (0.5)) ;
            $entrada['somatorio_vazao_ok']+=$vazao;
            
            $entrada['somatorio_espacamentos'] += $aspersor['espacamento'];

            if($aspersor['lance'] == $entrada['numero_lances']){
                $comprimento_ultimo_lance += $aspersor['espacamento'];
            }
        }

        $entrada['somatorio_espacamentos_sem_canhao'] = $entrada['somatorio_vazao_ok'];
        $entrada['raio'] = $entrada['somatorio_espacamentos'];
        $entrada['area_total_com_canhao'] = ((pi()*pow(($entrada['somatorio_espacamentos'] + $entrada['alcance_canhao_final']), 2))/10000)*($entrada['angulo_pivo'] / 360);
        $entrada['area_total'] = ((pi()*pow(($entrada['somatorio_espacamentos']), 2))/10000)*($entrada['angulo_pivo'] / 360);
        $entrada['lamina'] = ($entrada['somatorio_vazao_ok']*$entrada['tempo'])/($entrada['area_total']*10);
        $entrada['vazao_sistema'] = $entrada['somatorio_vazao_ok']; /* Verificar */
        
        /* Somando a vazao do canhao ao somatório de vazao ok*/
        $entrada['somatorio_vazao_ok'] += $entrada['vazao_canhao'];
        
        $entrada['primeiro'] = True;
        $entrada['pos'] = 1;
        

        foreach ($aspersores as $key => $aspersor) {

            //Obtendo valores do emissor Anterior
            if(!empty($aspersores[$key -1 ])){
                $anterior['comprimento_anterior'] = $mapa[$key - 1]['comprimento']; 
                $anterior['q_total_teorica_anterior'] =  $mapa[$key - 1]['vazao_sprays_teorica'];
                $anterior['q_total_real_anterior'] =  $mapa[$key - 1]['vazao_sprays_real'];
                $anterior['q_vazao_requerida_anterior'] =  $mapa[$key - 1]['vazao_spray_requerida'];
            }

            //Obtendo valores do próximo emissor
            if(!empty($aspersores[$key+1])){
                $proximo['comprimento_proximo'] =  $anterior['comprimento_anterior'] + $aspersores[$key+1]['espacamento'] + $aspersor['espacamento'];
            }else{
                $proximo['comprimento_proximo'] = 0;
            }

            /*Realização do primeiro bloco de cálculos */
            $mapa_original = MapaOriginal::processarAspersor($entrada, $anterior, $proximo, $aspersor);

            /* Atualizando o valor do somatorio da perda de carga real */
            $entrada['somatorio_perda_carga_real']+=$mapa_original['perda_carga_real'];
            $entrada['pos'] = $entrada['pos'] + 1;

            /*Push do emissor calculado a lista*/
            array_push($mapa, $mapa_original);
            $entrada['primeiro'] = False;
        }

        /*Atualização dos valores do emissor anterior */
        $anterior['perda_pressao_acumulada_real_anterior'] = 0;
        $anterior['bocal_anterior'] = 0;
        $anterior['area_anterior'] = 0;

        /*Atualização dos valores de entrada */
        $entrada['primeiro'] = True;
        $entrada['somatorio_si'] = 0;
        $entrada['somatorio_li_si'] = 0;
        $entrada['somatorio_si_desvios'] = 0;
        $entrada['proximo_bocal'] = 0;
        $entrada['proximo_proximo_bocal'] = 0;
        $entrada['area_prox'] = 0;
        $entrada['primeiro_bocal'] = True;

        foreach ($aspersores as $key => $aspersor) {

            if(!empty($aspersores[$key -1 ])){
                $anterior['perda_pressao_acumulada_real_anterior'] = $mapa[$key - 1]['perda_pressao_acumulada_real']; //Variável do anterior
                $anterior['bocal_anterior'] = $mapa[$key -1]['bocal-1'];
                $anterior['area_anterior'] = $mapa[$key-1]['area_aspersor'];
            }

            if(!empty($mapa[$key+1])){
                $entrada['proximo_bocal'] = $mapa[$key+1]['bocal-1'];
                $entrada['area_prox'] = $mapa[$key+1]['area_aspersor'];
                if(!empty($mapa[$key+2])){
                    $entrada['proximo_proximo_bocal'] = $mapa[$key+2]['bocal-1'];
                }else{
                    $entrada['proximo_proximo_bocal'] = 0;
                }
            }else{
                $entrada['proximo_bocal'] = 0;
                $entrada['proximo_proximo_bocal'] = 0;
                $entrada['area_prox'] = 0;
            }

            //if()

            
            /*Realização do segundo bloco de cálculos */
            MapaOriginal::processarAspersor2($entrada, $anterior, $mapa[$key]);
            
            /*
            * Verificando a consistência dos valores calculados
            */
            if($mapa[$key]['pressao_entrada'] < 0 || $mapa[$key]['pressao_saida'] < 0){
                Notificacao::gerarModal('afericao.erro', 'afericao.problemaPressaoSaidaNegativa', 'danger');
                return null;
            }

            $entrada['primeiro'] = False;
            $entrada['somatorio_si']+=$mapa[$key]['si'];
            $entrada['somatorio_li_si']+=$mapa[$key]['li_si'];
            if($aspersor['bocal_1'] != 0){
                $entrada['primeiro_bocal'] = False;
            }
        }

        foreach ($aspersores as $key => $aspersor) {
            /* Realização do terceiro bloco de cálculos */
            $mapa[$key]['desvios'] = abs($mapa[$key]['li'] - ($entrada['somatorio_li_si'] / $entrada['somatorio_si']));
            $mapa[$key]['si_desvios'] = $mapa[$key]['si'] * $mapa[$key]['desvios'];
            $entrada['somatorio_si_desvios']+=$mapa[$key]['si_desvios'];
            
        }
        //Calculos sem válvula reguladora
        //Raio irrigado
        $entrada['raio_irrigado'] = $mapa_original['comprimento'] + $entrada['alcance_canhao_final'];


        //Balanço
        if ($entrada['tem_balanco'] == 'sim'){
            $entrada['balanco'] = $comprimento_ultimo_lance;

            //Raio da ultima torre
            $entrada['raio_ultima_torre'] = $entrada['raio_irrigado'] - $comprimento_ultimo_lance - $entrada['alcance_canhao_final'];
        }else{
            $entrada['raio_ultima_torre'] = $entrada['raio_irrigado'] - $entrada['alcance_canhao_final'];
        }


        if(isset($calcula_velocidade)){
            //Tempo a 100%
            $velocidade_afericao = RedimensionamentoPercentimetro::geraRedimensionamentoPercentimetro($entrada['id_afericao']);
            $entrada['tempo_a_100'] = (($entrada['raio_ultima_torre'] * 2 * pi()) / $velocidade_afericao['verificacao_velocidade']['media_velocidade']) / 360 * $entrada['angulo_pivo'];

            //Tempo de Irrigação por ponto (min) - 100%
            $entrada['tempo_irri_ponto_min'] = ($entrada['somatorio_vazao_ok'] * $entrada['tempo_a_100'])/($entrada['area_total_com_canhao'] * 10);

        }
        
        if($entrada['qt_emissores_5_porcento']/count($aspersores) > 0.5){
            $uniformidade_aplicacao = 1 - ($entrada['somatorio_si_desvios'] / $entrada['somatorio_li_si']) - 0.05;
        }else{
            $uniformidade_aplicacao = 1 - ($entrada['somatorio_si_desvios'] / $entrada['somatorio_li_si']) - 0.1;
        }
        //dump ($entrada['somatorio_si_desvios'] . " - " . $entrada['somatorio_li_si']) ;
        $entrada['uniformidade_aplicacao'] = $uniformidade_aplicacao*100;

        /*Retorno da lista com os cálculos realizados de cada saída */
        $mapa_velocidade = [];
        $mapa_velocidade[0] = $entrada;
        $mapa_velocidade[1] = $mapa;
        return $mapa_velocidade;
    }

    private static function processarAspersor($entrada, $anterior, $proximo, $aspersor)
    {
        /**
         * Calculos do sistema
         */
        $mapa_original = [];

        $mapa_original['area'] = ((pi() * pow($entrada['raio'], 2)) / (10000)); 
        $mapa_original['vazao'] = ($mapa_original['area'] * 10 * $entrada['lamina']) / $entrada['tempo']; 
        $mapa_original['lamina'] = ($mapa_original['vazao'] * $entrada['tempo']) / ($mapa_original['area'] * 10); 
        $mapa_original['fabricante'] =$aspersor['fabricante'];; //Fabricante do bocal
        $mapa_original['id_emissor'] = $aspersor['id_emissor'];
        $mapa_original['id_afericao'] = $entrada['id_afericao'];
        $mapa_original['id_usuario'] = Auth::user()->id; //Usuário atual
        $mapa_original['posicao_emissor'] = $entrada['pos'];
        $mapa_original['bocal-1'] = $aspersor['bocal_1']; //Numero do bocal 1
        $mapa_original['bocal-2'] = $aspersor['bocal_2']; //Numero do bocal 2
        $mapa_original['diametro_bocal'] = $aspersor['diametro'];
        $mapa_original['espacamento'] = $aspersor['espacamento'];
        $mapa_original['valvulas_reguladoras_psi'] = $aspersor['valvulas_reguladoras_psi'] . " PSI"; 
        $mapa_original['valvulas_reguladoras_tipo'] = $aspersor['valvulas_reguladoras_tipo']; 
        $mapa_original['numero_lance'] = $aspersor['lance'];


        /*Obtenção do valor em MCA da válvula reguladora através do seu valor em PSI */
        $mapa_original['valvulas_reguladoras_mca'] = MapaOriginal::getValorValvulaReguladoraMca($mapa_original['valvulas_reguladoras_psi']);

        $mapa_original['comprimento'] = $anterior['comprimento_anterior'] + $mapa_original['espacamento'];

        //Calculo da área do aspersor
        if (empty($proximo['comprimento_proximo'])) {
            
            $mapa_original['area_aspersor'] = pi() * (pow($mapa_original['comprimento'], 2) - pow($anterior['comprimento_anterior'], 2)) * ($entrada['angulo_pivo'] / 360);
        } else {
            $mapa_original['area_aspersor'] =
                ((pi() * pow((($mapa_original['comprimento'] + $proximo['comprimento_proximo']) / 2), 2)) - (pi() * pow((($mapa_original['comprimento'] + $anterior['comprimento_anterior']) / 2), 2))) * ($entrada['angulo_pivo'] / 360);
        }

    

        $mapa_original['area_acumulada'] = (pi() * pow($mapa_original['comprimento'], 2) * ($entrada['angulo_pivo'] / 360)) / 10000;
        $mapa_original['vazao_spray_requerida'] = (($mapa_original['area_aspersor'] / 10000) * 10 * $mapa_original['lamina']) / $entrada['tempo'];

        //$mapa_original['q_bocal_1'] = Bocal::select('vazao')->where('fabricante', $mapa_original['fabricante'])->where('nome', $mapa_original['bocal-1'])->first()['vazao'];
        //$mapa_original['q_bocal_2'] = Bocal::select('vazao')->where('fabricante', $mapa_original['fabricante'])->where('nome', $mapa_original['bocal-2'])->first()['vazao'];
        $mapa_original['q_bocal_1'] = $aspersor["vazao_1"];
        $mapa_original['q_bocal_2'] = $aspersor["vazao_2"];


        $mapa_original['pressao_cadastro_bocal_1'] = MapaOriginal::getPressaoCadastroBocal($mapa_original['fabricante']); 
        $mapa_original['pressao_cadastro_bocal_2'] = MapaOriginal::getPressaoCadastroBocal($mapa_original['fabricante']); 

        $mapa_original['vazao_aspersor'] = ($mapa_original['q_bocal_1'] * pow($mapa_original['valvulas_reguladoras_mca'], (1 / 2))) / pow(($mapa_original['pressao_cadastro_bocal_1']), (1 / 2)) + ($mapa_original['q_bocal_2'] * pow($mapa_original['valvulas_reguladoras_mca'], (1 / 2))) / pow(($mapa_original['pressao_cadastro_bocal_2']), (1 / 2));
        
        $mapa_original['q_max_valvula'] = MapaOriginal::getVazaoMaxValvula($mapa_original['valvulas_reguladoras_tipo'], $mapa_original['valvulas_reguladoras_psi']); 
        
        if($entrada['primeiro']){
            $mapa_original['vazao_sprays_teorica'] = $entrada['vazao_sistema'];
            $mapa_original['vazao_sprays_real'] = $entrada['somatorio_vazao_ok'];
        }else{
            $mapa_original['vazao_sprays_teorica'] = $anterior['q_total_teorica_anterior'] - $anterior['q_vazao_requerida_anterior'];
            $mapa_original['vazao_sprays_real'] = $anterior['q_total_real_anterior'] - $mapa_original['vazao_aspersor'];
        }
        if($mapa_original['vazao_sprays_real'] < 0){
            $mapa_original['vazao_sprays_real'] = 0;
        }
        $mapa_original['velocidade'] = (($mapa_original['vazao_sprays_real'] / 3600) * 4) / (pi() * (pow($mapa_original['diametro_bocal'], 2)));
        $mapa_original['perda_carga_teorica'] = 10.641 * (pow($mapa_original['diametro_bocal'], (-4.87))) * (pow((($mapa_original['vazao_sprays_teorica'] / 3600) / ($entrada['coeficiente_rugosidade'])), (1.852))) * $mapa_original['espacamento'];
        $mapa_original['perda_carga_real'] = 10.641 * (pow($mapa_original['diametro_bocal'], (-4.87))) * (pow((($mapa_original['vazao_sprays_real'] / 3600) / ($entrada['coeficiente_rugosidade'])), (1.852))) * $mapa_original['espacamento'];
        return $mapa_original;
    }

    private static function processarAspersor2($entrada, $anterior, &$mapa_original){
        if($entrada['primeiro']){
            //dd($mapa_original['perda_carga_real'], $entrada['somatorio_perda_carga_real'], $entrada['altura_emissores'], $entrada['desnivel_total'], $entrada['raio'], $mapa_original['espacamento']);
            $mapa_original['perda_pressao_acumulada_real'] = $mapa_original['perda_carga_real'] +  $entrada['somatorio_perda_carga_real']*0.1 + $entrada['altura_emissores'] + (($entrada['desnivel_total'] / $entrada['raio']) * $mapa_original['espacamento']);
            $mapa_original['pressao_entrada'] = $entrada['pressao_centro'] - $mapa_original['perda_pressao_acumulada_real'];
        }else{
            $mapa_original['perda_pressao_acumulada_real'] = $mapa_original['perda_carga_real'] + $anterior['perda_pressao_acumulada_real_anterior'] + (($entrada['desnivel_total'] / $entrada['raio']) * $mapa_original['espacamento']);
            $mapa_original['pressao_entrada'] = $entrada['pressao_centro'] - $mapa_original['perda_pressao_acumulada_real'];
        }

        $mapa_original['perda_carga_parte_aerea'] = $entrada['somatorio_perda_carga_real'] + ($entrada['somatorio_perda_carga_real'] * 0.1);

        if ($mapa_original['pressao_entrada'] > $mapa_original['valvulas_reguladoras_mca']) {
            $mapa_original['pressao_saida'] = $mapa_original['valvulas_reguladoras_mca'];
        } else {
            $mapa_original['pressao_saida'] = $mapa_original['pressao_entrada'];
        }


        if ($mapa_original['q_bocal_1'] > $mapa_original['q_max_valvula']) {
            $mapa_original['vazao_liberada'] = $mapa_original['q_max_valvula'];
        } else {
            $mapa_original['vazao_liberada'] = ($mapa_original['vazao_aspersor'] * pow($mapa_original['pressao_saida'], (1 / 2))) / pow($mapa_original['valvulas_reguladoras_mca'], (1 / 2));
        }
        

        if ($mapa_original['vazao_liberada'] == 0) {
            $mapa_original['lamina_aplicada'] = $mapa_original['lamina'];
        } else {
            if($entrada['primeiro_bocal']){
                $mapa_original['lamina_aplicada'] = ($mapa_original['vazao_liberada'] * $entrada['tempo']) / (($mapa_original['area_aspersor'] / 10000) * 10);
            }
            else if($anterior['bocal_anterior'] == 0){
                $mapa_original['lamina_aplicada'] = ($mapa_original['vazao_liberada'] * $entrada['tempo']) / ((($mapa_original['area_aspersor'] +$anterior['area_anterior']) / 10000) * 10);
            }else if($entrada['proximo_bocal'] == 0 && $entrada['proximo_proximo_bocal'] != 0){
                $mapa_original['lamina_aplicada'] = ($mapa_original['vazao_liberada'] * $entrada['tempo']) / ((($mapa_original['area_aspersor'] + $entrada['area_prox']) / 10000) * 10);
            }else{
                $mapa_original['lamina_aplicada'] = ($mapa_original['vazao_liberada'] * $entrada['tempo']) / (($mapa_original['area_aspersor'] / 10000) * 10);
            }
        }

        $mapa_original['lamina_media'] = $mapa_original['lamina'];
        
        if ($mapa_original['lamina_aplicada'] >= (0.95 * $mapa_original['lamina_media'])) {
            $mapa_original['aai'] = $mapa_original['area_aspersor'];
        } else {
            $mapa_original['aai'] = 0;
        }

        $mapa_original['si'] = $mapa_original['comprimento'];
        $mapa_original['li'] = $mapa_original['lamina_aplicada'];
        $mapa_original['li_si'] = $mapa_original['comprimento'] * $mapa_original['lamina_aplicada'];
    }

    public static function getValorValvulaReguladoraMca($valvulaPSI)
    {
        $retorno = 0;
        switch ($valvulaPSI) {
            case '10 PSI':
                $retorno = 7.029;
                break;
            case '15 PSI':
                $retorno = 10.5435;
                break;
            case '20 PSI':
                $retorno = 14.058;
                break;
            case '25 PSI':
                $retorno = 17.5725;
                break;
            case '30 PSI':
                $retorno = 21.087;
                break;
            case '35 PSI':
                $retorno = 24.6015;
                break;
            case '40 PSI':
                $retorno = 28.116;
                break;
            case '45 PSI':
                $retorno = 31.6305;
                break;
            case '50 PSI':
                $retorno = 35.145;
                break;
            default:
                break;
        }
        return $retorno;

    }

    public static function getVazaoMaxValvula($tipo_valvula, $valor_psi){
        $resultado = 0;
        if($tipo_valvula =="LF"){
            switch ($valor_psi) {
                case "6 PSI": $resultado = 	1.136	; break;
                case "10 PSI": $resultado = 	1.817	; break;
                case "15 PSI": $resultado = 	1.817	; break;
                case "20 PSI": $resultado = 	1.817	; break;
                case "25 PSI": $resultado = 	1.817	; break;
                case "30 PSI": $resultado = 	1.817	; break;
                case "35 PSI": $resultado = 	1.817	; break;
                case "40 PSI": $resultado = 	1.817	; break;

                default: break;
            }
        }else if($tipo_valvula == "MF"){
            switch ($valor_psi) {
                case "6 PSI": $resultado = 	3.634	; break;
                case "10 PSI": $resultado = 	3.634	; break;
                case "15 PSI": $resultado = 	4.542	; break;
                case "20 PSI": $resultado = 	4.542	; break;
                case "25 PSI": $resultado = 	4.542	; break;
                case "30 PSI": $resultado = 	4.542	; break;
                case "35 PSI": $resultado = 	4.542	; break;
                case "40 PSI": $resultado = 	4.542	; break;
                default: break;
            }
        }else if($tipo_valvula == "HF"){
            switch ($valor_psi) {
                case "6 PSI": $resultado = 	0	; break;
                case "10 PSI": $resultado = 	7.268	; break;
                case "15 PSI": $resultado = 	7.268	; break;
                case "20 PSI": $resultado = 	7.268	; break;
                case "25 PSI": $resultado = 	7.268	; break;
                case "30 PSI": $resultado = 	7.268	; break;
                case "35 PSI": $resultado = 	7.268	; break;
                case "40 PSI": $resultado = 	7.268	; break;
                default:
                    break;
            }
        }else if($tipo_valvula == "PSR"){
            switch ($valor_psi) {
                case "6 PSI": $resultado = 	3.407	; break;
                case "10 PSI": $resultado = 	3.407	; break;
                case "15 PSI": $resultado = 	3.407	; break;
                case "20 PSI": $resultado = 	3.407	; break;
                case "25 PSI": $resultado = 	3.407	; break;
                case "30 PSI": $resultado = 	3.407	; break;
                case "35 PSI": $resultado = 	3.407	; break;
                case "40 PSI": $resultado = 	3.407	; break;
                default: break;
            }
        }
        return $resultado;
    }

    public static function getPressaoCadastroBocal($fabricante){
        $retorno = 0;
        $fabricante = strtoupper($fabricante);
        switch($fabricante){
            case "FABRIMAR":
                $retorno = 7.03;
                break;
            case "NELSON":
                $retorno = 7.03;
                break;
            case "SUPER SPRAY - UP3":
                $retorno = 7.03;
                break;
            case "SUPER SPRAY UP3":
                $retorno = 7.03;
                break;
            case "SUPER SPRAY":
                $retorno = 7.03;
                break;
            case "I-WOB UP3":
                $retorno = 7.03;
                break;
            case "I-WOB":
                $retorno = 7.03;
                break;
            case "FAN SPRAY":
                $retorno = 7.03;
                break;
            case "KOMET":
                $retorno = 7.03;
                break;
            case "TRASH BUSTER":
                $retorno = 17.57;
                break;
            default: 
                break;
        }
        return $retorno;
    }
}
