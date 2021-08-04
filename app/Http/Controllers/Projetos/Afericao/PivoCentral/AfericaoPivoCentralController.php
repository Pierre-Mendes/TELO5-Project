<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes_DBA\LevantamentoCentroParteAerea;
use Auth;
use DB;
use Session;
use App\Classes\Constantes\Notificacao;
use App\Classes\Sistema\Fazenda;
use App\Classes\Sistema\Pivo;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\CanhaoFinal;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\CabecalhoBombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Sistema\VelocidadeAfericao_100;
use App\Classes\Sistema\VelocidadePercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use App\Classes\FormCalculate\CombinedAreaCalc;
use App\Classes\FormCalculate\DepthAreaCalc;
use App\Classes\Projetos\Afericao\PivoCentral\fichaTecnica;

class AfericaoPivoCentralController extends Controller
{
    public function managerMeasurements()
    {
        if (session()->has('fazenda')) {
            $fazenda = session()->get('fazenda');
            $afericoes = AfericaoPivoCentral::select('afericoes_pivos_centrais.id', 'afericoes_pivos_centrais.nome_pivo', 'afericoes_pivos_centrais.data_afericao', 'P.nome as pivo', 'afericoes_pivos_centrais.numero_lances', 'afericoes_pivos_centrais.tem_balanco', 'afericoes_pivos_centrais.versoes')
                ->join('pivos as P', 'P.id', 'afericoes_pivos_centrais.marca_modelo_pivo')
                ->where('afericoes_pivos_centrais.id_fazenda', $fazenda['id'])
                ->where('afericoes_pivos_centrais.ativa', 1)
                ->where('afericoes_pivos_centrais.tipo_projeto', 'A')
                ->orderBy('afericoes_pivos_centrais.data_afericao', 'desc')
                ->paginate(20);
            foreach ($afericoes as $afericao) {
                if ($afericao['tem_balanco'] == "sim") {
                    $afericao['numero_lances'] = ($afericao['numero_lances'] - 1) . " + " . __('afericao.balanco');
                }
                unset($afericao['tem_balanco']);
            }
            return view('projetos.afericao.pivoCentral.gerenciar', compact('afericoes'));
        } else {
            Notificacao::gerarModal('afericao.atencao', 'afericao.selecione_fazenda', 'warning');
            return redirect()->back();
        }
    }

    public function searchGauging(Request $request) 
    {
        $afericoes = [];
        
        if (session()->has('fazenda')) {
            $fazenda = session()->get('fazenda');

            if(empty($request['filter'])) {
                $afericoes = AfericaoPivoCentral::select('afericoes_pivos_centrais.id', 'afericoes_pivos_centrais.nome_pivo', 'afericoes_pivos_centrais.data_afericao', 'P.nome as pivo', 'afericoes_pivos_centrais.numero_lances', 'afericoes_pivos_centrais.tem_balanco')
                    ->join('pivos as P', 'P.id', 'afericoes_pivos_centrais.marca_modelo_pivo')
                    ->where('afericoes_pivos_centrais.id_fazenda', $fazenda['id'])
                    ->where('afericoes_pivos_centrais.ativa', 1)
                    ->where('afericoes_pivos_centrais.tipo_projeto', 'A')
                    ->orderBy('afericoes_pivos_centrais.data_afericao', 'desc')
                ->where(function ($query) use ($request){
                    if (!empty($request['filter'])) {
                        $query->orWhere('afericoes_pivos_centrais.nome_pivo', 'like', '%'.$request['filter'].'%')
                        ->orWhere('P.nome as pivo', 'like', '%'.$request['filter'].'%');
                    }
                })->paginate(10);
            } else {
                $afericoes = AfericaoPivoCentral::select('afericoes_pivos_centrais.id', 'afericoes_pivos_centrais.nome_pivo', 'afericoes_pivos_centrais.data_afericao', 'P.nome as pivo', 'afericoes_pivos_centrais.numero_lances', 'afericoes_pivos_centrais.tem_balanco')
                    ->join('pivos as P', 'P.id', 'afericoes_pivos_centrais.marca_modelo_pivo')
                    ->where('afericoes_pivos_centrais.id_fazenda', $fazenda['id'])
                    ->where('afericoes_pivos_centrais.ativa', 1)
                    ->where('afericoes_pivos_centrais.tipo_projeto', 'A')
                    ->orderBy('afericoes_pivos_centrais.data_afericao', 'desc')
                ->where(function ($query) use ($request){
                    if (!empty($request['filter'])) {
                        $query->orWhere('afericoes_pivos_centrais.nome_pivo', 'like', '%'.$request['filter'].'%');
                    }
                })->paginate(10);
            }
        }

        

        return view('projetos.afericao.pivoCentral.gerenciar', compact('afericoes'));
    }

    public function createGauging()
    {
        if (session()->has('fazenda')) {
            $id_fazenda = Session::get('fazenda')['id'];
            $fazenda = Fazenda::select('fazendas.*', 'P.nome as nome_proprietario', 'U.nome as nome_consultor')
                ->where('fazendas.id', $id_fazenda)
                ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                ->join('users as U', 'U.id', 'fazendas.id_consultor')
                ->first();
            $pivos = Pivo::select('id', 'fabricante', 'nome')->orderBy('fabricante')->get();
            $nomes_pivos_fazenda = AfericaoPivoCentral::select('nome_pivo')
                ->where('afericoes_pivos_centrais.tipo_projeto', 'A')
                ->where('id_fazenda', $id_fazenda)->where('ativa', 1)
                ->get();
            /**Convertendo o resaultado em lista */
            $lista_nomes = array();
            foreach ($nomes_pivos_fazenda as $nome) {
                array_push($lista_nomes, $nome['nome_pivo'] . "");
            }

            foreach ($pivos as $pivo) {
                $pivo['resumo'] = $pivo['fabricante'] . " - " . $pivo['nome'];
            }

            return view('projetos.afericao.pivoCentral.cadastro.cadastroAfericao', compact('fazenda', 'pivos', 'lista_nomes'));
        } else {
            Notificacao::gerarModal('afericao.atencao', 'afericao.selecione_fazenda', 'warning');
            return redirect()->route('projetos.afericao.pivoCentral.gerenciar');
        }
    }

    public function saveGauging(Request $request)
    {
        $dados = $request->all();

        if (isset($dados['possui_pivo_conjugado'])) {
            $dados['id_usuario'] = Auth::user()->id;
            //Validação dos campos do pivô conjugado
            if (
                ($dados['area_pivo_01'] == null && $dados['vazao_pivo_01'] != null) || ($dados['area_pivo_01'] != null && $dados['vazao_pivo_01'] == null) ||
                ($dados['area_pivo_02'] == null && $dados['vazao_pivo_02'] != null) || ($dados['area_pivo_02'] != null && $dados['vazao_pivo_02'] == null) ||
                ($dados['area_pivo_03'] == null && $dados['vazao_pivo_03'] != null) || ($dados['area_pivo_03'] != null && $dados['vazao_pivo_03'] == null) ||
                ($dados['area_pivo_04'] == null && $dados['vazao_pivo_04'] != null) || ($dados['area_pivo_04'] != null && $dados['vazao_pivo_04'] == null)
                ) {
                Notificacao::gerarAlert('afericao.erro', 'afericao.erro_preenchimento_formulario_pivo_conjugado', 'danger');
                return redirect()->back();
            }
        }
        /*Validação campos canhao final */
        if (isset($dados['possui_canhao_final']) && (!isset($dados['vazao_canhao_final']) || !isset($dados['alcance_canhao_final']))) {
            Notificacao::gerarAlert('afericao.erro', 'levatamento.erro_preenchimento_canhao_final', 'danger');
            return redirect()->back();
        }
        
        /*Adicionando o balanco a quantidade de lances se ele existir */
        if(isset($dados['tem_balanco'])){
            $dados['numero_lances'] = $dados['numero_lances'] + 1;
        }

        //Convertendo os arrays de problemas em string
        if(isset($dados['problema_torre_central'] )){ $dados['problema_torre_central'] = implode(",", $dados['problema_torre_central']);  }
        if(isset($dados['problema_valvula_psi'] )){ $dados['problema_valvula_psi'] = implode(",", $dados['problema_valvula_psi']);}
        if(isset($dados['problema_parte_aerea'] )){$dados['problema_parte_aerea'] = implode(",", $dados['problema_parte_aerea']);}
        if(isset($dados['problema_canhao_final'] )){$dados['problema_canhao_final'] = implode(",", $dados['problema_canhao_final']); }
        if(isset($dados['problema_casa_bomba'] )){$dados['problema_casa_bomba'] = implode(",", $dados['problema_casa_bomba']);}
        if(isset($dados['problema_adutora'] )){$dados['problema_adutora'] = implode(",", $dados['problema_adutora']);}
        if(isset($dados['problema_chave_partida'] )){ $dados['problema_chave_partida'] = implode(",", $dados['problema_chave_partida']);  }
        if(isset($dados['problema_succao'] )){ $dados['problema_succao'] = implode(",", $dados['problema_succao']); }
        if(isset($dados['problema_motor_principal'] )){ $dados['problema_motor_principal'] = implode(",", $dados['problema_motor_principal']); }
        if(isset($dados['problema_bomba_principal'] )){  $dados['problema_bomba_principal'] = implode(",", $dados['problema_bomba_principal']);  }
        if(isset($dados['problema_motor_auxiliar'] )){  $dados['problema_motor_auxiliar'] = implode(",", $dados['problema_motor_auxiliar']); }
        if(isset($dados['problema_bomba_auxiliar'] )){ $dados['problema_bomba_auxiliar'] = implode(",", $dados['problema_bomba_auxiliar']);  }

        $dados['id_usuario'] = Auth::user()->id;

        $dados['id_afericao'] = DB::transaction(function () use ($dados) {
            // dd($dados);
            $afericao = AfericaoPivoCentral::create($dados);
            $dados['id_afericao'] = $afericao['id'];
            if(isset($dados['possui_pivo_conjugado'])){
                PivoConjugado::create($dados);
            }
            if(isset($dados['possui_canhao_final'])){
                CanhaoFinal::create($dados);
            }
            ProblemaAfericao::create($dados);
            AfericaoHidraulica::create($dados);
            AfericaoPivoCentral::where('id_fazenda', $dados['id_fazenda'])
                ->where('nome_pivo', $dados['nome_pivo'])
                ->where('afericoes_pivos_centrais.tipo_projeto', 'A')
                ->where('id', '!=', $afericao['id'])
                ->update(['ativa' => 0]);

            /**Gravando no banco de dados todos os lances da aferição */
            for ($i = 1; $i <= $dados['numero_lances']; $i++) {
                Lance::create([
                    'id_afericao' => $dados['id_afericao'],
                    'numero_lance' => ($i),
                ]);
            }
            return $afericao['id'];
        });
        if (!empty($dados['id_afericao'])) {
            // session()->put('afericao', $dados['id_afericao']);
            // session()->put('numero_lance', $dados['numero_lances']);
            return redirect()->route('add_measurement_the_session', $dados['id_afericao']);
        } else {
            Notificacao::gerarAlert('afericao.erro', 'afericao.falhaGravarBd', 'danger');
            return redirect()->back();
        }
    }

    public function editGauging($id_afericao)
    {
        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $entrada = AfericaoPivoCentral::
            /*select(
                'afericoes_pivos_centrais.tempo_funcionamento as tempo', 'afericoes_pivos_centrais.id as id_afericao','afericoes_pivos_centrais.giro_equipamento as angulo_pivo',  'afericoes_pivos_centrais.altura_emissores',
                'AH.rugosidade as coeficiente_rugosidade', 'AH.altitude_centro as altitude_centro', 'AH.altitude_mais_alto as altitude_mais_alto',
                'AH.pressao_centro as pressao_centro', 'CF.vazao_canhao_final as vazao_canhao' , 'CF.vazao_canhao_final as vazao_canhao_final',
            )->*/leftjoin('pivos_conjugados as PC', function ($join) {
                $join->on('afericoes_pivos_centrais.id', '=', 'PC.id_afericao')
                    ->whereNull('PC.deleted_at');
            })->leftjoin('canhoes_finais as CF', function ($join) {
                $join->on('afericoes_pivos_centrais.id', '=', 'CF.id_afericao')
                    ->whereNull('CF.deleted_at');
            })->leftjoin('afericao_hidraulicas as AH', 'afericoes_pivos_centrais.id', 'AH.id_afericao')->leftjoin('problemas_afericoes as PA', 'afericoes_pivos_centrais.id', 'PA.id_afericao')->where('afericoes_pivos_centrais.id', $id_afericao)->
            //whereNull('PC.deleted_at')->whereNull('CF.deleted_at')->whereNull('AH.deleted_at')->whereNull('PA.deleted_at')->
            first();
        $pivos = Pivo::select('id', 'fabricante', 'nome')->orderBy('fabricante')->get();
        $nomes_pivos_fazenda = AfericaoPivoCentral::select('nome_pivo')->where('id_fazenda', $entrada['id_fazenda'])->where('ativa', 1)->get();

        /**Convertendo o resaultado em lista */
        $lista_nomes = array();
        foreach ($nomes_pivos_fazenda as $nome) {
            array_push($lista_nomes, $nome['nome_pivo'] . "");
        }


        foreach ($pivos as $pivo) {
            $pivo['resumo'] = $pivo['fabricante'] . " - " . $pivo['nome'];
        }
        return view('projetos.afericao.pivoCentral.cadastro.editarAfericao', compact('pivos', 'lista_nomes', 'entrada', 'id_afericao'));
    }

    public function updateGauging(Request $req)
    {
        $dados = $req->all();
        if(isset($dados['possui_pivo_conjugado'])){
            $dados['id_usuario'] = Auth::user()->id;
            //Validação dos campos do pivô conjugado
            if(
                ($dados['area_pivo_01'] == null && $dados['vazao_pivo_01'] != null) || ($dados['area_pivo_01'] != null && $dados['vazao_pivo_01'] == null) ||
                ($dados['area_pivo_02'] == null && $dados['vazao_pivo_02'] != null) || ($dados['area_pivo_02'] != null && $dados['vazao_pivo_02'] == null) ||
                ($dados['area_pivo_03'] == null && $dados['vazao_pivo_03'] != null) || ($dados['area_pivo_03'] != null && $dados['vazao_pivo_03'] == null) ||
                ($dados['area_pivo_04'] == null && $dados['vazao_pivo_04'] != null) || ($dados['area_pivo_04'] != null && $dados['vazao_pivo_04'] == null)
            ){
                Notificacao::gerarAlert('afericao.erro', 'afericao.erro_preenchimento_formulario_pivo_conjugado', 'danger');
                return redirect()->back();
            }
        }

        if (isset($dados['possui_canhao_final']) && (!isset($dados['vazao_canhao_final']) || !isset($dados['alcance_canhao_final']))) {
            Notificacao::gerarAlert('afericao.erro', 'levatamento.erro_preenchimento_canhao_final', 'danger');
            return redirect()->back();
        }
        
        //Convertendo os arrauys de problemas em string
        if(isset($dados['problema_torre_central'] )){ $dados['problema_torre_central'] = implode(",", $dados['problema_torre_central']);  }
        if(isset($dados['problema_valvula_psi'] )){ $dados['problema_valvula_psi'] = implode(",", $dados['problema_valvula_psi']);}
        if(isset($dados['problema_parte_aerea'] )){$dados['problema_parte_aerea'] = implode(",", $dados['problema_parte_aerea']);}
        if(isset($dados['problema_canhao_final'] )){$dados['problema_canhao_final'] = implode(",", $dados['problema_canhao_final']); }
        if(isset($dados['problema_casa_bomba'] )){$dados['problema_casa_bomba'] = implode(",", $dados['problema_casa_bomba']);}
        if(isset($dados['problema_adutora'] )){$dados['problema_adutora'] = implode(",", $dados['problema_adutora']);}
        if(isset($dados['problema_chave_partida'] )){ $dados['problema_chave_partida'] = implode(",", $dados['problema_chave_partida']);  }
        if(isset($dados['problema_succao'] )){ $dados['problema_succao'] = implode(",", $dados['problema_succao']); }
        if(isset($dados['problema_motor_principal'] )){ $dados['problema_motor_principal'] = implode(",", $dados['problema_motor_principal']); }
        if(isset($dados['problema_bomba_principal'] )){  $dados['problema_bomba_principal'] = implode(",", $dados['problema_bomba_principal']);  }
        if(isset($dados['problema_motor_auxiliar'] )){  $dados['problema_motor_auxiliar'] = implode(",", $dados['problema_motor_auxiliar']); }
        if(isset($dados['problema_bomba_auxiliar'] )){ $dados['problema_bomba_auxiliar'] = implode(",", $dados['problema_bomba_auxiliar']);  }

        
        $versoes = AfericaoPivoCentral::select('versoes')->where('id', $dados['id_afericao'])->get();
        $somaVersoes = $versoes + 0;
        $updateVersoes = AfericaoPivoCentral::where('id', $dados['id_afericao'])->increment('versoes', $somaVersoes)->update(['versoes' => $somaVersoes]);
        // AfericaoPivoCentral::where('id', $dados['id_afericao'])->update(['versoes' => $updateVersoes]);
        // $updateVersoes = AfericaoPivoCentral::where('id', $dados['id_afericao'])->update(['versoes' => $updateVersoes]);
        // dd($updateVersoes);
        
        // $lastNumber = AfericaoPivoCentral::where('id', $dados['id_afericao'])->where('versoes')->get() + 1;
        // dd($lastNumber);
        // AfericaoPivoCentral::find($dados['id_afericao'])->update(['versoes' => $lastNumber]);
        // $versao->update(['versoes' => $lastNumber]);

        $retorno = false;
        $retorno = DB::transaction(function () use ($dados){
            AfericaoPivoCentral::find($dados['id_afericao'])->update($dados);
            if(isset($dados['possui_pivo_conjugado'])){
                /* Verificar se existe o conjugado antes */
                $conjugado = PivoConjugado::where('id_afericao', $dados['id_afericao'])->first();
                if(empty($conjugado['id'])){
                    PivoConjugado::create($dados);
                }else{
                    PivoConjugado::find($conjugado['id'])->update($dados);
                }
            }else{
                /* Remove o pivo conjugado se existir */
                PivoConjugado::where('id_afericao', $dados['id_afericao'])->delete();
            }
            if(isset($dados['possui_canhao_final'])){
                /* Verificar se existe o canhao existe antes */
                $canhao_final = CanhaoFinal::where('id_afericao', $dados['id_afericao'])->first();
                if(empty($canhao_final['id'])){
                    CanhaoFinal::create($dados);
                }else{
                    CanhaoFinal::find($canhao_final['id'])->update($dados);
                }
            }else{
                /* Remove o canhao final se existir */
                CanhaoFinal::where('id_afericao', $dados['id_afericao'])->delete();
            }

            $id_problemas = ProblemaAfericao::select('id')->where('id_afericao', $dados['id_afericao'])->first()['id'];
            ProblemaAfericao::find($id_problemas)->update($dados);
            $id_hidraulica = AfericaoHidraulica::select('id')->where('id_afericao', $dados['id_afericao'])->first()['id'];
            AfericaoHidraulica::find($id_hidraulica)->update($dados);
            //Removendo o mapa original cadastrado
            MapaOriginal::where('id_afericao', $dados['id_afericao'])->delete();
            return true;
        });

        if($retorno){
            Notificacao::gerarAlert('afericao.sucesso', 'afericao.edicao_sucesso', 'success');
            if($dados['botao'] == "sair"){
                return redirect()->route('gauging_status',$dados['id_afericao'] );
            }
            return redirect()->back();
        }else{
            Notificacao::gerarAlert('afericao.erro', 'afericao.falhaGravarBd', 'danger');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $delete = AfericaoPivoCentral::find($id);
        $delete->delete();
        return redirect()->route('gauging_manager')->with('Sucesso', 'Foi deletado');
    }

    public function calcCombinedArea(Request $req)
    {
        $dados = $req->all();

        $combinedArea = CombinedAreaCalc::combinedArea(
            $dados['area_pivo_1'], 
            $dados['area_pivo_2'], 
            $dados['area_pivo_3'], 
            $dados['area_pivo_4']
        );

        return ($combinedArea);
    }
    
    public function calcDepthArea(Request $req)
    {
        $dados = $req->all();

        $depthArea = DepthAreaCalc::depthAreacalc(
            $dados['area_pivo_1'],
            $dados['area_pivo_2'],
            $dados['area_pivo_3'],
            $dados['area_pivo_4'],
            $dados['vazao_pivo_1'],
            $dados['vazao_pivo_2'],
            $dados['vazao_pivo_3'],
            $dados['vazao_pivo_4']
        );
        
        return ($depthArea);

    }
    
    public function loadRegisteredMeasurement($id_afericao)
    {
        $afericao = AfericaoPivoCentral::find($id_afericao);
        if(empty($afericao) || $afericao['tipo_projeto'] != "A"){
            return redirect()->route('dashboard');
        }else{
            /* Adicionando a aferição e o número do lance atual a sessão do usuário */
            $afericao['pivo'] = Pivo::select('espacamento')->where('id', $afericao['marca_modelo_pivo'])->first();
            session()->put('afericao', $afericao);
            session()->put('numero_lance', 1);
            return redirect()->route('span_create');
        }
    }

    public function createSpan()
    {
        /*Verifica se existe uma aferição e um número de lance na sessão */
        if(session()->has('afericao') && session()->has('numero_lance')){
            $lance = Lance::
                where('id_afericao', session()->get('afericao')['id'])
                ->where('numero_lance', session()->get('numero_lance'))
                ->first();
            return view('projetos.afericao.pivoCentral.cadastro.cadastrarLance', compact('lance'));
        }else{
            Notificacao::gerarAlert('afericao.erro', 'afericao.cadastre_uma_afericao_para_registrar_os_lances', 'danger');
            return redirect()->route('gauging_manager');
        }
    }

    public function saveSpan(Request $req)
    {
        /**
         * Atualiza o lance e faz a chamada para o cadastro de emissores
         */
        $lance = $req->all();

        if (Lance::find($lance['id'])) {
            Lance::find($lance['id'])
                    ->update($lance);
        } else { 
            Lance::create($lance);
        }
        session()->put('lance', $lance);
        return redirect()->route('issuer_create');
    }

    public function backSpanPrevious()
    {
        $numero_lance_atual = session()->get('numero_lance');
        if($numero_lance_atual <= 1){
            return redirect()->back();
        }
        session()->put('numero_lance', $numero_lance_atual - 1);
        return redirect()->route('span_create');
    }

    public function createIssuer()
    {
        if (session()->has('numero_lance') && session()->has('lance')) {
            $espacamento = session()->get('lance')['espacamento'];
            $espacamento = $espacamento[0];
            $emissores = Emissor::select('saida_1', 'saida_2')
                ->where('id_lance', session()->get('lance')['id'])
                ->orderBy('numero')
                ->get();
            return view('projetos.afericao.pivoCentral.cadastro.cadastrarEmissores', compact('emissores', 'espacamento'));
        } else {
            Notificacao::gerarModal('afericao.erro', "erro.afericao_nao_encontrada", 'danger');
            return redirect()->route('span_create');
        }
    }

    public function saveSpanAndIssuer(Request $req)
    {
        
        $dados = $req->all();
        $lance = session()->get('lance');
        // $lance['comprimento'] = $dados['comprimento'];
        Lance::where('id', $lance['id'])->update( array('comprimento' => $dados['comprimento']) );
        $resultado = DB::transaction(function () use ($dados, $lance) {
            $lanceDB = Lance::find($lance['id']);
            $emissores = Emissor::where('id_lance', $lanceDB['id'])->orderBy('numero', 'asc')->get();
            if($emissores->count() == 0){
                //Cadastrar emissor
                for($i = 0; $i < count($dados['numero_emissor']); $i++){
                    $emissor = [];
                    $emissor['numero'] = $dados['numero_emissor'][$i];
                    $emissor['saida_1'] = $dados['bocal_1'][$i];
                    if(empty($dados['bocal_2'][$i])){
                        $emissor['saida_2'] = 0;
                    }else{
                        $emissor['saida_2'] = $dados['bocal_2'][$i];
                    }
                    $emissor['espacamento'] = $dados['espacamento'][$i];
                    $emissor['diametro'] = $lanceDB['diametro'];
                    $emissor['emissor'] = $dados['emissor'][$i];
                    $emissor['tipo_valvula'] = $dados['tipo_valvula'][$i];
                    $emissor['psi'] = $dados['valvula_reguladora'][$i];
                    $emissor['id_lance'] = $lanceDB['id'];
                    Emissor::create($emissor);
                }
            }else{
                //Editar emissor
                
                foreach ($emissores as $i => $emissor) {
                    $emissor['numero'] = $dados['numero_emissor'][$i];
                    $emissor['saida_1'] = $dados['bocal_1'][$i];
                    if(empty($dados['bocal_2'][$i])){
                        $emissor['saida_2'] = 0;
                    }else{
                        $emissor['saida_2'] = $dados['bocal_2'][$i];
                    }
                    $emissor['espacamento'] = $dados['espacamento'][$i];
                    $emissor['diametro'] = $lanceDB['diametro'];
                    $emissor['emissor'] = $dados['emissor'][$i];
                    $emissor['tipo_valvula'] = $dados['tipo_valvula'][$i];
                    $emissor['psi'] = $dados['valvula_reguladora'][$i];
                    $emissor->save();
                }
            }
            return "sucesso";
        });

        if($resultado == "sucesso"){
            if( ($lance['numero_lance'] + 1) <= session()->get('afericao')['numero_lances'] ){
                if($dados['botao'] == "sair"){
                    session()->forget('numero_lance');
                    session()->forget('afericao');
                    session()->forget('lance');
                    return redirect()->route('gauging_status', $lance['id_afericao']);
                }
                session()->forget('lance');
                session()->put('numero_lance', ($lance['numero_lance'] + 1));
                return redirect()->route('span_create');
            } else {
                session()->forget('numero_lance');
                session()->forget('afericao');
                session()->forget('lance');
                AfericaoPivoCentral::find($lance['id_afericao'])->update(['mapa_bocais_pendente'=> 0]);
                Notificacao::gerarModal("afericao.sucesso", "afericao.cadastroEmissoresSucesso", 'success');
                return redirect()->route('originalMap_manager', $lance['id_afericao']);
            }
        } else {
            Notificacao::gerarAlert('afericao.erro', 'afericao.falhaGravarBd', 'danger');
            return redirect()->back();
        }
    }

    public function continueNozzleMap($id_afericao)
    {

        $afericao = AfericaoPivoCentral::find($id_afericao);
        $afericao['id_afericao'] = $afericao['id'];
        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($afericao['id_afericao'])){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }

        if($afericao['mapa_bocais_pendente'] == 0){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.afericaoJaCompleta', 'warning');
            return redirect()->route('dashboard');
        }

        $afericao['pivo'] = Pivo::select('espacamento')->where('id', $afericao['marca_modelo_pivo'])->first();
        $num_lance = Lance::where('id_afericao', $afericao['id'])->whereNotNull('numero_emissores')->count();

        $id_lance_parado = Lance::select('id')->where('id_afericao', $id_afericao)->whereNotNull('numero_emissores')->orderBy('id', 'desc')->first();
        $emissores_lance = Emissor::where('id_lance', $id_lance_parado['id'])->count();

        if ($emissores_lance > 0) $num_lance = $num_lance + 1;

        if ($num_lance > $afericao['numero_lances']) return redirect()->back();
        else{
            /* Adicionando a aferição e o número do lance atual a sessão do usuário */
            session()->put('afericao', $afericao);
            session()->put('numero_lance', $num_lance);
            return redirect()->route('span_create');
        }
    }

    public function archiveGauging($id)
    {
        AfericaoPivoCentral::find($id)->update(['ativa' => 0]);
        Notificacao::gerarAlert('afericao.sucesso', 'afericao.remocaoSucesso', 'info');
        return redirect()->back();
    }

    public function manageIssuer($id_afericao)
    {
        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $emissores = Emissor::select(
                'emissores.id',
                'emissores.numero',
                'emissores.saida_1',
                'emissores.saida_2',
                'emissores.espacamento',
                'emissores.diametro',
                'emissores.emissor',
                'emissores.tipo_valvula',
                'emissores.psi',
                'emissores.id_lance',
                'L.numero_lance'
            )
            ->join('lances as L', 'L.id', 'emissores.id_lance')
            ->join('afericoes_pivos_centrais AS AP', 'AP.id', 'L.id_afericao')
            ->where('L.id_afericao', $id_afericao)
            ->orderby('L.numero_lance', 'asc')
            ->orderby('emissores.numero', 'asc')
            ->paginate(100);
        $afericao = AfericaoPivoCentral::select('tem_balanco', 'numero_lances')->where('id', $id_afericao)->first();
        return view('projetos.afericao.pivoCentral.cadastro.gerenciarEmissores', compact('emissores', 'id_afericao', 'afericao'));
    }

    public function editaEmissores(Request $req)
    {
        $emissor = $req->all();
        Emissor::find($emissor['id_emissor'])->update($emissor);
        return redirect()->back();
    }

    public function editAllEmitters(Request $req)
    {
        $emissores = $req->all();
        //Update nos emissores
        for ($i = 0; $i < count($emissores['id']); $i++) {
            $lista_emissores = [];
            $lista_emissores['numero'] = $emissores['numero'][$i];
            $lista_emissores['saida_1'] = $emissores['saida_1'][$i];
            $lista_emissores['saida_2'] = $emissores['saida_2'][$i];
            $lista_emissores['espacamento'] = $emissores['espacamento'][$i];
            $lista_emissores['valvula_reguladora'] = $emissores['valvula_reguladora'][$i];
            $lista_emissores['tipo_valvula'] = $emissores['tipo_valvula'][$i];
            $lista_emissores['fabricante'] = $emissores['fabricante'][$i];
            Emissor::find($emissores['id'][$i])->update($lista_emissores);
        }

        // Verificando qual página será retornada
        if ($emissores['botao'] == 'sair') return redirect()->route('gauging_status', $req['id_afericao']);
        else return redirect()->back();
    }

    public function gaugingStatus($id_afericao)
    {
        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }

        $afericao_db = AfericaoPivoCentral::find($id_afericao);
        $mapa_original_db = MapaOriginal::where('id_afericao', $id_afericao)->first();

        if (empty($afericao_db['id'])) {
            return redirect()->back();
        } else {
            $tipo_projeto = $afericao_db['tipo_projeto'];

            if ($afericao_db['tipo_projeto'] == "R") {
                $afericao['cor'] = "green";
                $afericao['mensagem'] = "afericao.concluido";
                $afericao['acao'] = "resizing_edit";
                $afericao['parametro'] = $id_afericao;
                $afericao['botao'] = 'unidadesAcoes.editar';
                $afericao['icone'] = 'fa fa-check';
                $afericao['condicao'] = "ok";
            } else {
                $afericao['cor'] = "green";
                $afericao['mensagem'] = "afericao.concluido";
                $afericao['acao'] = "gauging_edit";
                $afericao['parametro'] = $id_afericao;
                $afericao['botao'] = 'unidadesAcoes.editar';
                $afericao['icone'] = 'fa fa-check';
                $afericao['condicao'] = "ok";
            }

            if ($afericao_db['velocidade_pendente'] == 1) {
                $velocidade['cor'] = "orange";
                $velocidade['mensagem'] = "afericao.pendente";
                $velocidade['acao'] = "gauging_speed_create";
                $velocidade['parametro'] = $id_afericao;
                $velocidade['botao'] = 'afericao.cadastrar';
                $velocidade['icone'] = 'fa fa-clock-o';
                $velocidade['condicao'] = "pendente";

                $relVelocidade['cor'] = "red";
                $relVelocidade['mensagem'] = "afericao.bloqueado";
                $relVelocidade['acao'] = "gauging_status";
                $relVelocidade['parametro'] = "";
                $relVelocidade['botao'] = 'afericao.bloqueado';
                $relVelocidade['icone'] = 'fa fa-lock';
                $relVelocidade['condicao'] = "block";
            } else {
                $velocidade['cor'] = "green";
                $velocidade['mensagem'] = "afericao.concluido";
                $velocidade['acao'] = "gauging_speed_report";
                $velocidade['parametro'] = $id_afericao;
                $velocidade['botao'] = 'afericao.visualizar';
                $velocidade['icone'] = 'fa fa-check';
                $velocidade['condicao'] = "ok";

                if (empty($mapa_original_db)) {
                    $relVelocidade['cor'] = "red";
                    $relVelocidade['mensagem'] = "afericao.bloqueado";
                    $relVelocidade['acao'] = "gauging_status";
                    $relVelocidade['parametro'] = "";
                    $relVelocidade['botao'] = 'afericao.bloqueado';
                    $relVelocidade['icone'] = 'fa fa-lock';
                    $relVelocidade['condicao'] = "block";
                } else {
                    $relVelocidade['cor'] = "green";
                    $relVelocidade['mensagem'] = "afericao.concluido";
                    $relVelocidade['acao'] = "gauging_speed_report";
                    $relVelocidade['parametro'] = $id_afericao;
                    $relVelocidade['botao'] = 'unidadesAcoes.editar';
                    $relVelocidade['icone'] = 'fa fa-flag';
                    $relVelocidade['condicao'] = "ok";
                }
            }

            // BOMBEAMENTO
            $bombeamento['cor'] = "orange";
            $bombeamento['mensagem'] = "afericao.pendente";
            $bombeamento['acao'] = "pumping_create";
            $bombeamento['parametro'] = "$id_afericao";
            $bombeamento['botao'] = 'afericao.cadastrar';
            $bombeamento['icone'] = 'fas fa-clock';
            $bombeamento['condicao'] = "ok";

            if ($afericao_db['bombeamento_pendente'] == 1) {
                $bombeamentos_db = 0;
                $cabecalho_bombeamento = CabecalhoBombeamento::where('id_afericao', $id_afericao)->first();
                if (!empty($cabecalho_bombeamento)) {
                    $bombeamentos_db = Bombeamento::where('id_bombeamento', $cabecalho_bombeamento['id'])->count();
                }

                if ($bombeamentos_db > 0) {
                    $bombeamento['cor'] = "#ff6400";
                    $bombeamento['mensagem'] = "afericao.continuar";
                    $bombeamento['acao'] = "pumping_continue_create";
                    $bombeamento['parametro'] = $id_afericao;
                    $bombeamento['botao'] = 'afericao.continuar';
                    $bombeamento['icone'] = 'fa fa-lock';
                    $bombeamento['condicao'] = "ok";
                } else {
                    $bombeamento['cor'] = "orange";
                    $bombeamento['mensagem'] = "afericao.pendente";
                    $bombeamento['acao'] = "pumping_create";
                    $bombeamento['parametro'] = $id_afericao;
                    $bombeamento['botao'] = 'afericao.cadastrar';
                    $bombeamento['icone'] = 'fa fa-lock';
                    $bombeamento['condicao'] = "ok";
                }
            } else {
                $bombeamento['cor'] = "green";
                $bombeamento['mensagem'] = "afericao.concluido";
                $bombeamento['acao'] = "edit_Pumping";
                $bombeamento['parametro'] = $id_afericao;
                $bombeamento['botao'] = 'unidadesAcoes.editar';
                $bombeamento['icone'] = 'fa fa-check';
                $bombeamento['condicao'] = "ok";
            }

            // ADUTORA
            if ($afericao_db['adutora_pendente'] == 1) {
                $adutora['cor'] = "orange";
                $adutora['mensagem'] = "afericao.pendente";
                $adutora['acao'] = "create_adductor";
                $adutora['parametro'] = $id_afericao;
                $adutora['botao'] = 'afericao.cadastrar';
                $adutora['icone'] = 'fa fa-clock-o';
                $adutora['condicao'] = "pendente";
            } else {

                $adutora['cor'] = "green";
                $adutora['mensagem'] = "afericao.concluido";
                $adutora['acao'] = "adductor_edit";
                $adutora['parametro'] = $id_afericao;
                $adutora['botao'] = 'unidadesAcoes.editar';
                $adutora['icone'] = 'fa fa-check';
                $adutora['condicao'] = "ok";
            }

            if ($afericao_db['mapa_bocais_pendente'] == 0) {

                $emissores['cor'] = "green";
                $emissores['mensagem'] = "afericao.concluido";
                $emissores['acao'] = ($afericao_db['tipo_projeto'] == "A") ? "configurarPivoAfericao" : "configurarPivoRedimensionamento";
                $emissores['parametro'] = $id_afericao;
                $emissores['botao'] = 'unidadesAcoes.editar';
                $emissores['icone'] = 'fa fa-check';
                $emissores['condicao'] = "ok";

                if (empty($mapa_original_db)) {
                    $mapaOriginal['cor'] = "blue";
                    $mapaOriginal['mensagem'] = "afericao.disponivel";
                    $mapaOriginal['acao'] = "originalMap_manager";
                    $mapaOriginal['parametro'] = $id_afericao;
                    $mapaOriginal['botao'] = 'afericao.gerarMapa';
                    $mapaOriginal['icone'] = 'fa fa-flag';
                    $mapaOriginal['condicao'] = "ok";
                } else {
                    $mapaOriginal['cor'] = "green";
                    $mapaOriginal['mensagem'] = "afericao.visualizarMapa";
                    $mapaOriginal['acao'] = "originalMap_manager";
                    $mapaOriginal['parametro'] = $id_afericao;
                    $mapaOriginal['botao'] = 'unidadesAcoes.editar';
                    $mapaOriginal['icone'] = 'fa fa-flag';
                    $mapaOriginal['condicao'] = "ok";
                }
            } else {

                $mapaOriginal['cor'] = "red";
                $mapaOriginal['mensagem'] = "afericao.bloqueado";
                $mapaOriginal['acao'] = "gauging_status";
                $mapaOriginal['parametro'] = "";
                $mapaOriginal['botao'] = 'afericao.bloqueado';
                $mapaOriginal['icone'] = 'fa fa-lock';
                $mapaOriginal['condicao'] = "block";

                $num_lance = Lance::select('id')->where('id_afericao', $id_afericao)->whereNull('numero_emissores')->count();

                if (($num_lance != null) && ($afericao_db['numero_lances'] > $num_lance)) {
                    $emissores['cor'] = "#ff6400";
                    $emissores['mensagem'] = "afericao.continuar";
                    $emissores['acao'] = "gauging_continue";
                    $emissores['parametro'] = $id_afericao;
                    $emissores['botao'] = 'afericao.continuar';
                    $emissores['icone'] = 'fa fa-clock-o';
                    $emissores['condicao'] = "continuar";

                } else {
                    $emissores['cor'] = "orange";
                    $emissores['mensagem'] = "afericao.pendente";
                    $emissores['acao'] = "add_measurement_the_session";
                    $emissores['parametro'] = $id_afericao;
                    $emissores['botao'] = 'afericao.cadastrar';
                    $emissores['icone'] = 'fa fa-clock-o';
                    $emissores['condicao'] = "pendente";
                }
            }

            if ($afericao_db['mapa_bocais_pendente'] == 1 || $afericao_db['adutora_pendente'] == 1 || $afericao_db['bombeamento_pendente'] == 1 || $afericao_db['velocidade_pendente'] == 1) {
                $ftDiag['cor'] = "red";
                $ftDiag['mensagem'] = "afericao.bloqueado";
                $ftDiag['acao'] = "gauging_status";
                $ftDiag['parametro'] = "";
                $ftDiag['botao'] = 'afericao.bloqueado';
                $ftDiag['icone'] = 'fa fa-lock';
                $ftDiag['condicao'] = 'block';
            } else {
                $ftDiag['cor'] = "green";
                $ftDiag['mensagem'] = "afericao.visualizar";
                $ftDiag['acao'] = "manage_datasheet";
                $ftDiag['parametro'] = $id_afericao;
                $ftDiag['botao'] = 'afericao.visualizar';
                $ftDiag['icone'] = 'fas fa-file-alt';
                $ftDiag['condicao'] = 'visualizar';

                AfericaoPivoCentral::where('id', $id_afericao)
                ->update(['versoes' => 1]);
            }            
            
            return view('projetos.afericao.pivoCentral.statusAfericao', compact('velocidade', 'bombeamento', 'adutora', 'emissores', 'mapaOriginal', 'afericao', 'relVelocidade', 'ftDiag', 'tipo_projeto'));
        }
    }
}
