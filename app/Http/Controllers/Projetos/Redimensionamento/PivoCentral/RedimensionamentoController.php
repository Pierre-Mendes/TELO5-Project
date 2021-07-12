<?php

namespace App\Http\Controllers\Projetos\Redimensionamento\PivoCentral;

use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Projetos\Afericao\PivoCentral\CanhaoFinal;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\TrechoAdutora;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use App\Classes\Projetos\Redimensionamento\PivoCentral\NovoMapa;
use App\Classes\Projetos\Redimensionamento\PivoCentral\InfoRedimensionamento;
use App\Classes\Constantes\Notificacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use File;
use Storage;

class RedimensionamentoController extends Controller
{
    public function managerRedimensionamento(){
        if(session()->has('fazenda')){
            $fazenda = session()->get('fazenda');
            $redimensionamentos = AfericaoPivoCentral::select('afericoes_pivos_centrais.id', 'afericoes_pivos_centrais.nome_pivo', 'afericoes_pivos_centrais.data_afericao', 'P.nome as pivo', 'afericoes_pivos_centrais.numero_lances', 'afericoes_pivos_centrais.tem_balanco')
                ->join('pivos as P', 'P.id', 'afericoes_pivos_centrais.marca_modelo_pivo')
                ->where('afericoes_pivos_centrais.id_fazenda', $fazenda['id'])
                ->where('afericoes_pivos_centrais.ativa', 1)
                ->where('afericoes_pivos_centrais.tipo_projeto', 'R')
                ->orderBy('afericoes_pivos_centrais.data_afericao', 'desc')
                ->paginate(20);
                // dd($redimensionamentos);
            $pivos = AfericaoPivoCentral::
                select('afericoes_pivos_centrais.id', 'nome_pivo', 'P.nome as marca_modelo_pivo')->
                join('pivos as P', 'afericoes_pivos_centrais.marca_modelo_pivo', 'P.id')->
                where('afericoes_pivos_centrais.id_fazenda', $fazenda['id'])->
                where('afericoes_pivos_centrais.ativa', 1)->
                where('mapa_bocais_pendente', 0)->
                where('adutora_pendente', 0)->
                where('bombeamento_pendente', 0)->
                where('velocidade_pendente', 0)->
                where('afericoes_pivos_centrais.tipo_projeto', 'A')->
                get(); 
            foreach($redimensionamentos as $redimensionamento){
                if($redimensionamento['tem_balanco'] == "sim"){
                    $redimensionamento['numero_lances'] = ($redimensionamento['numero_lances'] - 1) . " + " . __('afericao.balanco');  
                }
                unset($redimensionamento['tem_balanco']);
            }
            return view('projetos.redimensionamento.gerenciarRedimensionamento', compact('redimensionamentos', 'pivos'));
        }else{
            Notificacao::gerarModal('afericao.atencao', 'afericao.selecione_fazenda', 'warning');
            return redirect()->route('dashboard');
        }
    }

    public function createRedimensionamento(request $req){
        $id_afericao = $req->all()['id_afericao'];
        $novoId = InfoRedimensionamento::duplicarInformacoesAfericao($id_afericao);
        
        if(empty($novoId)){
            Notificacao::gerarAlert('redimensionamento.erro', 'redimensionamento.falhaDuplicarDados', 'danger');
            return redirect()->back();
        }
        return redirect()->route('redimensionamento_setup_view', $novoId);
    }

    public function setupViewRedimensionamento($id_redimensionamento){
        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_redimensionamento)){
            Notificacao::gerarAlert('afericao.aviso', 'redimensionamento.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $novoMapa = new NovoMapa();
        $redimensionamento =  $novoMapa->calcularNovoMapa($id_redimensionamento);
        if(empty($redimensionamento)){
            Notificacao::gerarAlert('redimensionamento.falha', 'redimensionamento.falhaExecucaoMapa', 'danger');
            return redirect()->route('dashboard');
        }
        RedimensionamentoController::atualizarBocais($redimensionamento[1], $id_redimensionamento);
        $afericao = MapaOriginal::gerarMapaOriginal($redimensionamento[0]['id_afericao_original'], true);

        $adutora_red = Adutora::where('id_afericao', $redimensionamento[0]['id_afericao'])->first();
        $bombeamentos_red = Bombeamento::where('id_bombeamento', $adutora_red['id'])->get();
        // $trechos_red = Adutora::where('id_adutora', $adutora_red['id'])->get();

        $adutora_afe = Adutora::where('id_afericao', $redimensionamento[0]['id_afericao_original'])->first();
        // $trechos_afe = Adutora::where('id_adutora', $adutora_afe['id'])->get();
        $bombeamentos_afe = Bombeamento::where('id_bombeamento', $adutora_afe['id'])->get();

        $afericao[0]['pressao_na_bomba'] = RedimensionamentoController::getPressaoNaBomba($adutora_afe, $bombeamentos_afe);
        $redimensionamento[0]['pressao_na_bomba'] = RedimensionamentoController::getPressaoNaBomba($adutora_red, $bombeamentos_red);
        
        $infosTrechos = RedimensionamentoController::getinfosTrechosAdutora($adutora_afe, $trechos_afe, $afericao[0]['somatorio_vazao_ok'], $afericao[0]['vazao_canhao_final']);
        $afericao[0]['hf_adutora'] = $infosTrechos['hf'];
        $afericao[0]['desnivel_motobomba'] = $infosTrechos['desnivel'];
        $afericao[0]['rugosidade_adutora'] = $infosTrechos['rugosidade'];
        $afericao[0]['pressao_ponta_requerida'] = RedimensionamentoController::getPressaoRequerida($afericao[0]['valvula_reguladora']);
        $afericao[0]['pressao_requerida'] = $afericao[0]['hf_adutora'] + $afericao[0]['desnivel_motobomba'] + $afericao[0]['somatorio_perda_carga_real']*1.1 + $afericao[0]['desnivel_total'] + $afericao[0]['pressao_ponta'] + $afericao[0]['altura_emissores'];
        $afericao[0]['pressao_5_4_2'] = RedimensionamentoController::calcularPessao542($bombeamentos_afe, $afericao[0], $adutora_afe);
        
        $infosTrechos = RedimensionamentoController::getinfosTrechosAdutora($adutora_red, $trechos_red, $redimensionamento[0]['somatorio_vazao_ok'], $afericao[0]['vazao_canhao_final']);
        $redimensionamento[0]['hf_adutora'] = $infosTrechos['hf'];
        $redimensionamento[0]['desnivel_motobomba'] = $infosTrechos['desnivel'];
        $redimensionamento[0]['rugosidade_adutora'] = $infosTrechos['rugosidade'];
        $redimensionamento[0]['pressao_ponta_requerida'] = RedimensionamentoController::getPressaoRequerida($redimensionamento[0]['valvula_reguladora']);
        $redimensionamento[0]['pressao_requerida'] = $redimensionamento[0]['hf_adutora'] + $redimensionamento[0]['desnivel_motobomba'] + $redimensionamento[0]['somatorio_perda_carga_real']*1.1 + $redimensionamento[0]['desnivel_total'] + $redimensionamento[0]['pressao_ponta'] + $redimensionamento[0]['altura_emissores'];
        $redimensionamento[0]['pressao_5_4_2'] = RedimensionamentoController::calcularPessao542($bombeamentos_red, $redimensionamento[0], $adutora_red);
        $redimensionamento[0]['id_adutora'] = $adutora_red['id'];

        // $imagens = [];
        // if(Storage::exists('public/projetos/redimensionamento/' . $redimensionamento[0]['id_afericao'])){
        //     $imagens = File::allFiles(public_path('storage/projetos/redimensionamento/'. $redimensionamento[0]['id_afericao']));
        // }
        return view('projetos.redimensionamento.cadastro.cadastroRedimensionamento', compact('redimensionamento', 'afericao', 'imagens'));
        // return view('projetos.redimensionamento.cadastro.createRedimensionamento', compact('redimensionamento', 'afericao', 'imagens'));
    }

    public function atualizarInformacoesRedimensionamento(Request $req){
        $dados = $req->all();
        //Salvando as imagens adicionadas 
        if($req->hasFile('images')){
            foreach ($req->file('images') as $key => $imagem) {
                if($imagem->getMimeType() == 'image/jpeg' || $imagem->getClientSize() < 999999){
                    $upload = $imagem->store('public/projetos/redimensionamento/' . $dados['id_redimensionamento']);
                }
            }
        }

        //Removendo do diretório as imagens deletadas
        if(!empty($dados['excluir_imagens'])){
            $vetorImagensDeletadas = explode(',' , $dados['excluir_imagens']);
            unset($vetorImagensDeletadas[count($vetorImagensDeletadas)-1]);
            foreach($vetorImagensDeletadas as $key=>$imagem){
                $vetorImagensDeletadas[$key] = 'public/projetos/redimensionamento/' . $dados['id_redimensionamento'] . '/' . $imagem; 
            }
            Storage::delete($vetorImagensDeletadas);
        }

        DB::beginTransaction();

        //afe
        if(empty($dados['giro_equipamento'])){ unset($dados['giro_equipamento']);}
        if(empty($dados['lamina_anual'])){ unset($dados['lamina_anual']);}
        if(empty($dados['defletor'])){ unset($dados['defletor']);}
        if(empty($dados['custo_medio'])){ unset($dados['custo_medio']);}
        
        AfericaoPivoCentral::find($dados['id_redimensionamento'])->update([
            'giro_equipamento' => $dados['giro_equipamento'],
            'lamina_anual' => $dados['lamina_anual'],
            'defletor' => $dados['defletor'],
            'custo_medio' => $dados['custo_medio'],
            'valv_reguladoras' => $dados['valv_reguladoras'],
            'marca_modelo_emissores' => $dados['marca_modelo_emissores'],
        ]);
        
        //hidr.
        $dados['rugosidade_pivo']; //coeficiente
        if(!empty($dados['rugosidade_pivo'])){
            AfericaoHidraulica::where('id_afericao', $dados['id_redimensionamento'])->first()->update(['rugosidade' => $dados['rugosidade_pivo']]);
        }

        if(!empty($dados['rugosidade_adutora'])){
            $trechos = Adutora::select('id', 'coeficiente_hw')->where('id', $dados['id_adutora'])->get();
            foreach ($trechos as $key => $trecho) {
                if($trecho['coeficiente_hw'] != $dados['rugosidade_adutora']){
                    Adutora::find($trecho['id'])->update(['coeficiente_hw' => $dados['rugosidade_adutora']]);
                }
            }
        }

        if(!empty($dados['editar_emissores'])){
            $lance = null;
            $emissores = Emissor::select('emissores.id', 'emissores.emissor', 'emissores.tipo_valvula', 'emissores.psi', 'emissores.id_lance')
                ->join('lances as L', 'L.id' , 'emissores.id_lance')
                ->where('L.id_afericao', $dados['id_redimensionamento'])
                ->orderby('L.numero_lance', 'asc')
                ->orderBy('emissores.numero', 'asc')
                ->get();
            foreach ($emissores as $key => $emissor) {
                if($emissor['emissor'] != $dados['marca_modelo_emissores'] || $emissor['tipo_valvula'] != $dados['tipo_valvula'] || $emissor['psi'] != $dados['valv_reguladoras']){
                    Emissor::find($emissor['id'])->update([
                        'emissor' => $dados['marca_modelo_emissores'], 
                        'tipo_valvula' => $dados['tipo_valvula'], 
                        'psi' => $dados['valv_reguladoras'], 
                    ]);
                }    
            }
        }
        
        $canhao_final = CanhaoFinal::where('id_afericao', $dados['id_redimensionamento'])->first();
        if(empty($canhao_final)){
            if(($dados['alcance_canhao_final'] > 0) && ($dados['vazao_canhao_final'] > 0)){
                CanhaoFinal::create([
                    'id_afericao' => $dados['id_redimensionamento'],
                    'alcance_canhao_final' => $dados['alcance_canhao_final'],
                    'vazao_canhao_final' => $dados['vazao_canhao_final'],
                    'valv_reguladora_canhao_final' => $dados['valv_reguladoras'],
                ]);
            }
        }else{
            $canhao_final->update([
                'alcance_canhao_final' => $dados['alcance_canhao_final'],
                'vazao_canhao_final' => $dados['vazao_canhao_final'],
            ]);
        }

        $dados['vazao_total'] = $dados['vazao'];
        if(empty($dados['vazao_total'])){ unset($dados['vazao_total']);}
        if(empty($dados['lances_c_plug'])){ unset($dados['lances_c_plug']);}
        if(empty($dados['espacamento_maximo_plug'])){ unset($dados['espacamento_maximo_plug']);}
        if(empty($dados['num_emissores_c_plug_inicio'])){ unset($dados['num_emissores_c_plug_inicio']);}
        if(empty($dados['lances_c_plug'])){ unset($dados['lances_c_plug']);}

        InfoRedimensionamento::where('id_afericao_redimensionamento', $dados['id_redimensionamento'])->first()->update($dados);
        $novoMapa = new NovoMapa();
        $redimensionamento =  $novoMapa->calcularNovoMapa($dados['id_redimensionamento']);
        if( !empty($redimensionamento) ) {
            //Sucesso!
            //Removendo o mapa original cadastrado
            MapaOriginal::where('id_afericao', $dados['id_redimensionamento'])->delete();
            //Confirmando as alterações no banco de dados
            DB::commit();
            Notificacao::gerarAlert('redimensionamento.atualizadoSucesso', 'redimensionamento.mapaDeBocaisAtualizado', 'success');
        } else {
            //Fail, desfaz as alterações no banco de dados
            DB::rollBack();
            Notificacao::gerarAlert('redimensionamento.erro', 'redimensionamento.falha_atualizacao', 'danger');
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        $delete = AfericaoPivoCentral::find($id);
        $delete->delete();
        return redirect()->route('resizing_manager')->with('Sucesso', 'Foi deletado');
    }
    
    /**
     * Funções estáticas da classe
     */
    private static function getPressaoRequerida($valvula_reguladora){
        switch ($valvula_reguladora) {
            case 6:
                return 6.22;
                break;
            case 10:
                return 9.03;
            case 15:
                return 12.54;
                break;
            case 20:
                return 16.06;
                break;
            case 25:
                return 19.57;
                break;
            case 30:
                return 23.09;
                break;
            case 35:
                return 26.60;
                break;
            case 40:
                return 30.12;
                break;
            case 45:
                return 33.63;
                break;
            case 50:
                return 37.15;
                break;
            default:
                return 0;
                break;
        }
    }

    private static function getinfosTrechosAdutora($adutora, $trechos, $vazao_total, $vazao_canhao = 0){
        $hf_trechos = 0;
        $desnivel = 0;
        $rugosidade_adutora = 0;
        foreach ($trechos as $key => $trecho) {
            $desnivel += $trecho['desnivel'];
            $vazao = ($vazao_total + $vazao_canhao) / $trecho['numero_canos'];
            $hf = 10.643*(1/(pow($trecho['diametro']*0.985, 4.87)))*(pow(($vazao/3600)/$trecho['coeficiente_hw'],1.852))*$trecho['comprimento'];
            $hf_trechos += $hf;
            $rugosidade_adutora = $trecho['coeficiente_hw'];
        }
        return ['hf' => $hf_trechos, 'desnivel' => $desnivel, 'rugosidade' => $rugosidade_adutora];
    }

    private static function getPressaoNaBomba($adutora, $bombeamentos){
        if($adutora['tipo_instalacao'] == 2) { //Paralelo
            $adutora['pressao_na_bomba'] = $bombeamentos[0]['pressao_bomba'];
        }else{
            $adutora['pressao_na_bomba'] = 0;
            foreach ($bombeamentos as $key => $bomba) {
                $adutora['pressao_na_bomba'] += $bomba['pressao_bomba'];
            }
        }
        return $adutora['pressao_na_bomba'];
    }

    private static function calcularPessao542($bombeamentos, $afericao, $adutora){
        $somatorio_hf = 0;
        foreach ($bombeamentos as $key => $bombeamento) {
            $somatorio_hf+=10.643*(1/(pow($bombeamento['diametro_succao']*0.985, 4.87)))*(pow(($afericao['somatorio_vazao_ok']/3600)/ RedimensionamentoController::getHwMaterial($bombeamento['material_succao']),1.852))*$bombeamento['comprimento_succao'];
        }
        $hf = $somatorio_hf + ($adutora['altitude_casa_bomba'] - $adutora['altitude_nivel_agua']) + $afericao['desnivel_motobomba'] + $afericao['hf_adutora'] + $afericao['desnivel_total'] + $afericao['somatorio_perda_carga_real'] + $afericao['pressao_ponta_requerida'] + $afericao['altura_emissores'];
        if($hf < 100){
            return $hf + 5;
        }else{
            return $hf*1.05;
        }

    }

    private static function getHwMaterial($material){
        switch ($material) {
            case 0:
                return 125;
            case 1:
                return 120;
            case 2:
                return 135;
            case 3:
                return 140;
            default:
                return 0;
        }
    }

    private static function atualizarBocais($emissores, $id_redimensionamento){
        $aspersores = Emissor::
            select('emissores.id', 'emissores.saida_1', 'emissores.saida_2')->
            join('lances as L', 'emissores.id_lance', 'L.id')->
            where('L.id_afericao', $id_redimensionamento)->orderBy('L.numero_lance', 'asc')->orderBy('emissores.numero', 'asc')->
            get();
        foreach ($emissores as $key => $emissor) {
            if(isset($aspersores[$key]) && $aspersores[$key]['id'] == $emissor['id_emissor'] && ($emissor['bocal-1'] != $aspersores[$key]['saida_1'] || $emissor['bocal-2'] != $aspersores[$key]['saida_2'])){
                Emissor::find($emissor['id_emissor'])->update(['saida_1' => $emissor['bocal-1'], 'saida_2' => $emissor['bocal-2']]);
            }
        }
    }
}
