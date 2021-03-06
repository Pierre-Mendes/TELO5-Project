<?php

namespace App\Classes\Projetos\Redimensionamento\PivoCentral;
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
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;

use Auth;
class NovoMapa extends Model
{
    private $bocais;

    public function getBocaisDB(){
        if(empty($this->bocais)){
            $this->bocais = Bocal::orderBy('fabricante', 'asc')->orderBy('intervalo_trabalho', 'asc')->get();
        }
        return $this->bocais;
    }

    public function encontrarBocalIdealAtravesVazaoRequerida($fabricante, $vazao_requerida){
        foreach($this->getBocaisDB() as $bocal){
            if(strtoupper($bocal['fabricante']) == strtoupper($fabricante)){
                
                if( number_format($vazao_requerida,4) <= number_format($bocal['intervalo_trabalho'],4)){
                    if($bocal['nome'] < 6 && strtoupper($bocal['fabricante']) == ('I-WOB' || 'I-WOB UP3')){
                        return 6.0;
                    }
                    return $bocal['nome'];
                }
            }
        }
        return 0;
    }

    public function encontrarVazaoBocalAtravesNumero($fabricante, $numero_bocal){
        foreach($this->getBocaisDB() as $bocal){
            if(strtoupper($bocal['fabricante']) == strtoupper($fabricante)){
                if($numero_bocal == $bocal['nome']){
                    //dump($vazao_requerida . ' - ' . $bocal['vazao']);
                    return $bocal['vazao'];
                }
            }
        }
        return 0.0000001;
    }

    public function calcularNovoMapa($id_afericao)
    {
        /**
         * Esta fun????o realiza os c??lculos para a gera????o do novo mapa
         * 
         * Neste processo, s??o realizados tr??s blocos de c??lculo, estes blocos s??o necess??rios devido a exist??ncia de somat??rios ao longo da execu????o,
         * que devem ser calculados inicialmente para serem usados adiante
         */

                
        //Inicializa????o das vari??veis
        $mapa = [];
        $entrada = [];
        $mapa_original = [];
        /* Inicializa????o de variaveis de pr??ximo e anterior */
        $anterior = [];
        $proximo = [];
        
        /* Recuperando dados da aferi????o */
        $entrada = AfericaoPivoCentral::
            select(
                'afericoes_pivos_centrais.tempo_funcionamento as tempo', 'afericoes_pivos_centrais.valv_reguladoras as valvula_reguladora','afericoes_pivos_centrais.id as id_afericao', 
                'afericoes_pivos_centrais.lamina_anual as lamina_anual','afericoes_pivos_centrais.defletor as defletor', 'afericoes_pivos_centrais.custo_medio as custo_medio',
                'afericoes_pivos_centrais.giro_equipamento as angulo_pivo','afericoes_pivos_centrais.marca_modelo_emissores as modelo_emissores',  'afericoes_pivos_centrais.altura_emissores',
                'AH.rugosidade as coeficiente_rugosidade', 'AH.altitude_centro as altitude_centro', 'AH.altitude_mais_alto as altitude_mais_alto', 
                'AH.pressao_centro as pressao_centro','AH.pressao_ponta as pressao_ponta', 'CF.vazao_canhao_final as vazao_canhao' , 'CF.vazao_canhao_final as vazao_canhao_final',
                'CF.alcance_canhao_final as alcance_canhao_final', 'afericoes_pivos_centrais.tem_balanco',
                'afericoes_pivos_centrais.numero_lances'
            )->leftjoin('pivos_conjugados as PC', function($join)
            {
                $join->on('afericoes_pivos_centrais.id', '=', 'PC.id_afericao')
                ->whereNull('PC.deleted_at');
            })
            ->leftjoin('canhoes_finais as CF', function($join)
            {
                $join->on('afericoes_pivos_centrais.id', '=', 'CF.id_afericao')
                ->whereNull('CF.deleted_at');
            })
            ->leftjoin('afericao_hidraulicas as AH', 'afericoes_pivos_centrais.id', 'AH.id_afericao')
            ->where('afericoes_pivos_centrais.id', $id_afericao)
            ->where('afericoes_pivos_centrais.tipo_projeto', 'R')
            ->first();

        /* Recuperando dados dos emissores */
        $aspersores = Emissor::select(
            'emissores.saida_1 as bocal_1', 'emissores.saida_2 as bocal_2', 'emissores.emissor as fabricante', 'emissores.espacamento as espacamento', 'emissores.numero as numero',
            'emissores.diametro', 'emissores.psi as valvulas_reguladoras_psi', 'emissores.tipo_valvula as valvulas_reguladoras_tipo', 'emissores.id as id_emissor',
            'L.numero_lance as lance' , 'emissores.created_at', 'emissores.updated_at'
        )->
        join('lances as L', 'emissores.id_lance', 'L.id')->
        where('L.id_afericao', $id_afericao)->orderBy('L.numero_lance', 'asc')->orderBy('emissores.numero', 'asc')->
        groupBy('emissores.id')->
        get();

        if(empty($entrada)){
            return null;
        }

        /* Informa????es do redimensionamento */
        $variaveis_redimensionamento = InfoRedimensionamento::where('id_afericao_redimensionamento', $id_afericao)->first();

        $entrada['desnivel_total'] = $entrada['altitude_mais_alto'] - $entrada['altitude_centro'];

        // Atribui????o inicial de valores para vari??veis de outras colunas
        $proximo['comprimento_proximo'] = 0; 
        $anterior['comprimento_anterior'] = 0; 
        $anterior['q_total_teorica_anterior'] = "primeiro"; 
        $anterior['q_total_real_anterior'] = 0; 
        $anterior['perda_pressao_acumulada_real_anterior'] = 0;


        $entrada['lances_c_plug'] = $variaveis_redimensionamento['num_lances_c_plug'];
        $entrada['num_emissores_c_plug_inicio'] = $variaveis_redimensionamento['num_emissores_c_plug_inicio'];
        $entrada['espacamento_maximo_plug'] = $variaveis_redimensionamento['espacamento_maximo_plug'];
        $entrada['id_afericao_original'] = $variaveis_redimensionamento['id_afericao_original'];

        $entrada['somatorio_perda_carga_real'] = 0;
        $entrada['somatorio_espacamentos'] = 0;
        $entrada['qt_emissores_5_porcento'] = 0;

        $entrada['comprimento_balanco'] = 0;
        $entrada['numero_saidas_sem_plug'] = 0;
      
        $comprimento_ultimo_lance = 0;

        //obtendo o somat??rio de pressao ok e espacamentos
        $entrada['somatorio_vazao_ok'] = $variaveis_redimensionamento['vazao_total'];
        foreach ($aspersores as $key => $aspersor) {

            //Verificando se o emissor ?? de I-WOB ou I-WOB ou NELSON ou KOMET
            if($aspersor['fabricante'] == "I-WOB" || $aspersor['fabricante'] == "I-WOB UP3" || $aspersor['fabricante'] == "NELSON" || $aspersor['fabricante'] == "KOMET" ){
                $entrada['qt_emissores_5_porcento'] = $entrada['qt_emissores_5_porcento'] + 1;
            }

            $entrada['somatorio_espacamentos'] += $aspersor['espacamento'];

            if($aspersor['lance'] == $entrada['numero_lances']){
                $comprimento_ultimo_lance += $aspersor['espacamento'];
            }
        }

        //$entrada['somatorio_espacamentos_sem_canhao'] = $entrada['somatorio_vazao_ok'];
        $entrada['raio'] = $entrada['somatorio_espacamentos'];
        $entrada['area_total_com_canhao'] = ((pi()*pow(($entrada['somatorio_espacamentos'] + $entrada['alcance_canhao_final']), 2))/10000)*($entrada['angulo_pivo'] / 360);
        $entrada['area_total'] = ((pi()*pow(($entrada['somatorio_espacamentos']), 2))/10000)*($entrada['angulo_pivo'] / 360);
        $entrada['lamina'] = ($entrada['somatorio_vazao_ok']*$entrada['tempo'])/($entrada['area_total']*10);
        $entrada['vazao_sistema'] = $entrada['somatorio_vazao_ok']; /* Verificar */
        
        /* Somando a vazao do canhao ao somat??rio de vazao ok*/
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

                $anterior['numero_bocal'] =  $mapa[$key - 1]['bocal-1'];
                $anterior['lamina_anterior'] =  $mapa[$key - 1]['lamina'];
                $anterior['area_anterior'] =  $mapa[$key - 1]['area_aspersor'];
            }

            //Obtendo valores do pr??ximo emissor
            if(!empty($aspersores[$key+1])){
                $proximo['comprimento_proximo'] =  $anterior['comprimento_anterior'] + $aspersores[$key+1]['espacamento'] + $aspersor['espacamento'];
            }else{
                $proximo['comprimento_proximo'] = 0;
            }

            /*Realiza????o do primeiro bloco de c??lculos */
            $mapa_original = $this->processarAspersor($entrada, $anterior, $proximo, $aspersor);

            /* Atualizando o valor do somatorio da perda de carga real */
            $entrada['somatorio_perda_carga_real']+=$mapa_original['perda_carga_real'];
            $entrada['pos'] = $entrada['pos'] + 1;

            /*Push do emissor calculado a lista*/
            array_push($mapa, $mapa_original);
            $entrada['primeiro'] = False;
        }

        /*Atualiza????o dos valores do emissor anterior */
        $anterior['perda_pressao_acumulada_real_anterior'] = 0;
        $anterior['bocal_anterior'] = 0;
        $anterior['area_anterior'] = 0;

        /*Atualiza????o dos valores de entrada */
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
                $anterior['perda_pressao_acumulada_real_anterior'] = $mapa[$key - 1]['perda_pressao_acumulada_real']; //Vari??vel do anterior
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

            /*Realiza????o do segundo bloco de c??lculos */
            $this->processarAspersor2($entrada, $anterior, $mapa[$key]);
            
            /*
            * Verificando a consist??ncia dos valores calculados
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
            /* Realiza????o do terceiro bloco de c??lculos */
            $mapa[$key]['desvios'] = abs($mapa[$key]['li'] - ($entrada['somatorio_li_si'] / $entrada['somatorio_si']));
            $mapa[$key]['si_desvios'] = $mapa[$key]['si'] * $mapa[$key]['desvios'];
            $entrada['somatorio_si_desvios']+=$mapa[$key]['si_desvios'];
            
        }
        //Calculos sem v??lvula reguladora
        //Raio irrigado
        $entrada['raio_irrigado'] = $mapa_original['comprimento'] + $entrada['alcance_canhao_final'];


        //Balan??o
        if ($entrada['tem_balanco'] == 'sim'){
            $entrada['balanco'] = $comprimento_ultimo_lance;

            //Raio da ultima torre
            $entrada['raio_ultima_torre'] = $entrada['raio_irrigado'] - $comprimento_ultimo_lance - $entrada['alcance_canhao_final'];
        }else{
            $entrada['raio_ultima_torre'] = $entrada['raio_irrigado'] - $entrada['alcance_canhao_final'];
        }


        //Tempo a 100%
        $velocidade_afericao = RedimensionamentoPercentimetro::geraRedimensionamentoPercentimetro($entrada['id_afericao']);
        $entrada['tempo_a_100'] = (($entrada['raio_ultima_torre'] * 2 * pi()) / $velocidade_afericao['verificacao_velocidade']['media_velocidade']) / 360 * $entrada['angulo_pivo'];

        //Tempo de Irriga????o por ponto (min) - 100%
        $entrada['tempo_irri_ponto_min'] = ($entrada['somatorio_vazao_ok'] * $entrada['tempo_a_100'])/($entrada['area_total_com_canhao'] * 10);

        if($entrada['qt_emissores_5_porcento']/count($aspersores) > 0.5){
            $uniformidade_aplicacao = 1 - ($entrada['somatorio_si_desvios'] / $entrada['somatorio_li_si']) - 0.05;
        }else{
            $uniformidade_aplicacao = 1 - ($entrada['somatorio_si_desvios'] / $entrada['somatorio_li_si']) - 0.1;
        }
        //dump ($entrada['somatorio_si_desvios'] . " - " . $entrada['somatorio_li_si']) ;
        $entrada['uniformidade_aplicacao'] = $uniformidade_aplicacao*100;

        /*Retorno da lista com os c??lculos realizados de cada sa??da */
        $mapa_velocidade = [];
        $mapa_velocidade[0] = $entrada;
        $mapa_velocidade[1] = $mapa;
        return $mapa_velocidade;
    }

    private function processarAspersor($entrada, $anterior, $proximo, $aspersor)
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
        $mapa_original['id_usuario'] = Auth::user()->id; //Usu??rio atual
        $mapa_original['posicao_emissor'] = $entrada['pos'];
        $mapa_original['bocal-2'] =0; //Numero do bocal 2
        $mapa_original['diametro_bocal'] = $aspersor['diametro'];
        $mapa_original['espacamento'] = $aspersor['espacamento'];
        $mapa_original['valvulas_reguladoras_psi'] = $aspersor['valvulas_reguladoras_psi'] . " PSI"; 
        $mapa_original['valvulas_reguladoras_tipo'] = $aspersor['valvulas_reguladoras_tipo']; 
        $mapa_original['numero_lance'] = $aspersor['lance'];


        /*Obten????o do valor em MCA da v??lvula reguladora atrav??s do seu valor em PSI */
        $mapa_original['valvulas_reguladoras_mca'] = MapaOriginal::getValorValvulaReguladoraMca($mapa_original['valvulas_reguladoras_psi']);

        $mapa_original['comprimento'] = $anterior['comprimento_anterior'] + $mapa_original['espacamento'];

        //Calculo da ??rea do aspersor
        if (empty($proximo['comprimento_proximo'])) {
            $mapa_original['area_aspersor'] = pi() * (pow($mapa_original['comprimento'], 2) - pow($anterior['comprimento_anterior'], 2)) * ($entrada['angulo_pivo'] / 360);
        } else {
            $mapa_original['area_aspersor'] =
                ((pi() * pow((($mapa_original['comprimento'] + $proximo['comprimento_proximo']) / 2), 2)) - (pi() * pow((($mapa_original['comprimento'] + $anterior['comprimento_anterior']) / 2), 2))) * ($entrada['angulo_pivo'] / 360);
        }

        $mapa_original['area_acumulada'] = (pi() * pow($mapa_original['comprimento'], 2) * ($entrada['angulo_pivo'] / 360)) / 10000;

        if(isset($anterior['numero_bocal']) && $anterior['numero_bocal'] == 0){
            $mapa_original['vazao_spray_requerida'] = ((($mapa_original['area_aspersor'] / 10000) * 10 * $mapa_original['lamina']) / $entrada['tempo']) + ((($anterior['area_anterior'] / 10000) * 10 * $anterior['lamina_anterior']) / $entrada['tempo']);
        }else{           
            $mapa_original['vazao_spray_requerida'] = (($mapa_original['area_aspersor'] / 10000) * 10 * $mapa_original['lamina']) / $entrada['tempo'];
        }
        
        if( $mapa_original['posicao_emissor'] <= $entrada['num_emissores_c_plug_inicio'] ||  ($aspersor['lance'] <= $entrada['lances_c_plug']  && $aspersor['espacamento'] < $entrada['espacamento_maximo_plug'] && $mapa_original["vazao_spray_requerida"] <= 3) && ((!$entrada['primeiro'] && $anterior['numero_bocal'] != 0 ) || ( $aspersor['bocal_1'] == 0 && $aspersor['created_at'] == $aspersor['updated_at'] ))){
            $mapa_original['bocal-1'] = 0;
        }else{
            $resultadoBocais = $this->encontrarBocalIdealAtravesVazaoRequerida($mapa_original['fabricante'], $mapa_original["vazao_spray_requerida"]);
            $resultadoBocais = explode('/', $resultadoBocais);
            $mapa_original['bocal-1'] = (isset($resultadoBocais[0])) ? $resultadoBocais[0] : 0;
            $mapa_original['bocal-2'] = (isset($resultadoBocais[1])) ? $resultadoBocais[1] : 0;
        }
        
        $mapa_original['q_bocal_1'] = $this->encontrarVazaoBocalAtravesNumero($mapa_original['fabricante'], $mapa_original['bocal-1']);
        $mapa_original['q_bocal_2'] = 0;


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

    private function processarAspersor2($entrada, $anterior, &$mapa_original){
        if($entrada['primeiro']){
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

        if($mapa_original['lamina_aplicada'] > 2*($mapa_original['lamina_media']) && $mapa_original['numero_lance'] == 1){
            $mapa_original['lamina_aplicada'] = $mapa_original['lamina_aplicada'] / ($mapa_original['lamina_aplicada']/ $mapa_original['lamina_media']);
        }

        
        if ($mapa_original['lamina_aplicada'] >= (0.95 * $mapa_original['lamina_media'])) {
            $mapa_original['aai'] = $mapa_original['area_aspersor'];
        } else {
            $mapa_original['aai'] = 0;
        }

        $mapa_original['si'] = $mapa_original['comprimento'];
        $mapa_original['li'] = $mapa_original['lamina_aplicada'];
        $mapa_original['li_si'] = $mapa_original['comprimento'] * $mapa_original['lamina_aplicada'];
    }
}
