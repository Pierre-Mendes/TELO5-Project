<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\TrechoAdutora;
use App\Classes\Constantes\Notificacao;
use Auth;
use DB;
use App\Classes\Projetos\Afericao\PivoCentral\CabecalhoBombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;

class LevantamentoAdutoraController extends Controller
{
    public function createAdductor($id_afericao)
    {

        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $adutora = Adutora::where('id_afericao', $id_afericao)->get();
        if ($adutora->count() == 0) {
            return view('projetos.afericao.pivoCentral.cadastro.cadastroConjuntoMotorBomba', compact('id_afericao'));
        } else {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.ja_existe_adutora', 'info');
            return redirect()->back();
        }
    }

    public function saveAdductor(Request $req)
    {
        $dados = $req->all();
        $dados['id_usuario'] = Auth::user()->id;
        $id_adutora = null;
        $listaTrechos = [];
        // Caso haja dados.
        if (!empty($dados['tipo_cano'])) {
            foreach ($dados['tipo_cano'] as $key => $elemento) {
                $trecho = [];
                $trecho['id_afericao'] = $dados['id_afericao'];
                $trecho['tipo_cano'] = $dados['tipo_cano'][$key];
                $trecho['diametro'] = $dados['diametro'][$key];
                $trecho['coeficiente_hw'] = $dados['coeficiente_hw'][$key];
                $trecho['numero_canos'] = $dados['numero_canos'][$key];
                $trecho['comprimento'] = $dados['comprimento'][$key];
                $trecho['desnivel'] = $dados['desnivel'][$key];
                $trecho['altitude'] = $dados['altitude'][$key];
                $trecho['latitude'] = $dados['latitude'][$key];
                $trecho['longitude'] = $dados['longitude'][$key];
                array_push($listaTrechos, $trecho);
            }
            // Transição para banco de dados.
            $id_adutora = DB::transaction(function () use ($dados, $listaTrechos) {
                AfericaoPivoCentral::find($dados['id_afericao'])->update(['adutora_pendente' => 0]);
                foreach ($listaTrechos as $trecho) {
                    Adutora::create($trecho);
                }
                return $dados['id_afericao'];
            });

            // Se a transição não ocorrer bem, retorna o modal com erro.
            if (is_null($id_adutora)) {
                Notificacao::gerarModal('afericao.erro', 'afericao.erro_db', 'danger');
                return redirect()->route('gauging_manager');
            }
            // Se ocorrer tudo certo, retorna para status da aferição.
            else {
                return redirect()->route('gauging_status', $dados['id_afericao']);
            }
            // Caso não haja dados e clique em salvar e sair, retorna um modal solicitando ao menos o cadastro de 1 trecho.
        } else {
            Notificacao::gerarModal('afericao.erro', 'afericao.adutora_vazia', 'danger');
            $id_afericao = $dados['id_afericao'];
            return view('projetos.afericao.pivoCentral.cadastro.cadastroConjuntoMotorBomba', compact('id_afericao'));
        }
    }

    public function editAdductor($id_afericao)
    {
        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }

        //Dados específicos que são gerados pela função do cálculo da Adutora
        $cabecalho_bombeamento = CabecalhoBombeamento::where('id_afericao', $id_afericao)->first();
        $afericao = AfericaoPivoCentral::where('id', $id_afericao)->first();
        $adutora = Adutora::where('id_afericao', $id_afericao)->get();
        
        $dados_adutora = Adutora::adductor_calculate($cabecalho_bombeamento, $adutora, $afericao);
        $dados_adutora = $dados_adutora[0];
        //Somandos os desníveis da adutora
        $total_desnivel_adutora = 0;
        for($i = 0; $i < count($dados_adutora); $i++){
            $total_desnivel_adutora += $dados_adutora[$i]['desnivel'];
        }

        if (empty($adutora)) 
            return redirect()->route('gauging_status', 'id_afericao');
        else 
            return view('projetos.afericao.pivoCentral.cadastro.editarConjuntoMotorBomba', compact('id_afericao', 'adutora', 'dados_adutora','cabecalho_bombeamento'));
    }

    public function updateAdductor(Request $req)
    {
        //Requisitando os dados
        $dados = $req->all();
        
        $dados['id_usuario'] = Auth::user()->id;
        $listaTrechos = [];
        //Atribuindo a lista de 'trechos'
        if (!empty($dados['tipo_cano'])) {
            foreach ($dados['tipo_cano'] as $key => $elemento) {
                $trecho = [];
                $trecho['id_afericao'] = $dados['id_afericao'];
                $trecho['tipo_cano'] = $dados['tipo_cano'][$key];
                $trecho['diametro'] = $dados['diametro'][$key];
                $trecho['coeficiente_hw'] = $dados['coeficiente_hw'][$key];
                $trecho['numero_canos'] = $dados['numero_canos'][$key];
                $trecho['comprimento'] = $dados['comprimento'][$key];
                $trecho['desnivel'] = $dados['desnivel'][$key];
                $trecho['altitude'] = $dados['altitude'][$key];
                $trecho['latitude'] = $dados['latitude'][$key];
                $trecho['longitude'] = $dados['longitude'][$key];
                array_push($listaTrechos, $trecho);
            }

            //Atualizando os dados da adutora e os trechos
            $transaction = DB::transaction(function () use ($dados, $listaTrechos) {
                // Deletando os trechos da adutora.
                Adutora::where('id_afericao', $dados['id_afericao'])->delete();

                // Criando os trechos no DB.
                foreach ($listaTrechos as $trecho) {
                    Adutora::create($trecho);
                }
                Notificacao::gerarAlert('afericao.sucesso', 'afericao.edicaoSucesso', 'success');
                return $dados['id_afericao'];
            });

            if (is_null($transaction)) {
                Notificacao::gerarModal('afericao.erro', 'afericao.erro_db', 'danger');
                return redirect()->route('gauging_manager');
            } else {
                // edição concluida com sucesso retornar para status aferição
                return redirect()->route('gauging_status', $dados['id_afericao']);
            }
            // Caso não haja dados e clique para salvar, retorna um modal solicitando ao menos o cadastro de 1 trecho.
        } else {
            Notificacao::gerarModal('afericao.erro', 'afericao.adutora_vazia', 'danger');
            $id_afericao = $dados['id_afericao'];
            return redirect()->route('adductor_edit', $id_afericao);
            return view('projetos.afericao.pivoCentral.cadastro.editarConjuntoMotorBomba', compact('id_afericao'));
        }
    }

    public function calculateAdductor($id_adutora)
    {
        $adutora = Adutora::find($id_adutora);
        if (!empty($adutora) && $adutora['pendente'] == 0) {
            if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($adutora['id_afericao'])) {
                Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
                return redirect()->route('dashboard');
            }
            $afericao = AfericaoPivoCentral::find($adutora['id_afericao']);
            $trechos_adutora = Adutora::where('id_adutora', $adutora['id'])->get();
            $bombeamentos = Bombeamento::where('id_adutora', $adutora['id'])->get();
            $resultado = Adutora::adductor_calculate($adutora, $trechos_adutora, $afericao);
        } else {
            Notificacao::gerarAlert('afericao.erro', 'afericao.erroAdutora', 'warning');
            return redirect()->back();
        }
    } 

    public function createPumping($id_afericao)
    {
        if (!empty($id_afericao)) {
            if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
                Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
                return redirect()->route('dashboard');
            } else {
                session()->put('id_afericao', $id_afericao);
                return view('projetos.afericao.pivoCentral.cadastro.cadastrarBombeamentos');
            }
        } else {
            return redirect()->back();
        }
    }

    public function savePumping(Request $req){
        // Dados do formulário.
        $dados = $req->all();

        if (isset($dados['comprimento_succao'])) {
            $dados['id_usuario'] = Auth::user()->id;
        
            // Inserindo os dados de cabeçalho no DB.        
            $cabecalho = CabecalhoBombeamento::create($dados);
            
            $dados['id_bombeamento'] = $cabecalho['id'];
            
            $id_afericao  = $dados['id_afericao'];
            
            $bombeamentos = [];
            for ($i = 0; $i < $dados['numero_bombas']; $i++) {
                $bombeamento = [];
                
                $bombeamento['id_bombeamento'] = $dados['id_bombeamento'];
                $bombeamento['comprimento_succao'] = $dados['comprimento_succao'][$i];
                $bombeamento['diametro_succao'] = $dados['diametro_succao'][$i];
                $bombeamento['marca'] = $dados['marca'][$i];
                $bombeamento['modelo'] = $dados['modelo'][$i];
                $bombeamento['numero_rotores'] = $dados['numero_rotores'][$i];
                $bombeamento['diametro_rotor'] = $dados['diametro_rotor'][$i];
                $bombeamento['material_succao'] = $dados['material_succao'][$i];
                $bombeamento['rendimento_bomba'] = $dados['rendimento_bomba'][$i];
                $bombeamento['shutoff'] = $dados['shutoff'][$i];
                $bombeamento['rotacao'] = $dados['rotacao'][$i];
                $bombeamento['pressao_bomba'] = $dados['pressao_bomba'][$i];
                $bombeamento['tipo_motor'] = $dados['tipo_motor'][$i];
                $bombeamento['modelo_motor'] = $dados['modelo_motor'][$i];
                $bombeamento['potencia'] = $dados['potencia'][$i];
                $bombeamento['numero_motores'] = $dados['numero_motores'][$i];
                $bombeamento['chave_partida'] = $dados['chave_partida'][$i];
                $bombeamento['fator_servico'] = $dados['fator_servico'][$i];
                $bombeamento['corrente_nominal'] = $dados['corrente_nominal'][$i];
                $bombeamento['rendimento'] = $dados['rendimento'][$i];
                $bombeamento['tensao_nominal'] = $dados['tensao_nominal'][$i];
                $bombeamento['frequencia'] = $dados['frequencia'][$i];
                $bombeamento['corrente_leitura_1_fase_1'] = $dados['corrente_leitura_1_fase_1'][$i];
                $bombeamento['corrente_leitura_1_fase_2'] = $dados['corrente_leitura_1_fase_2'][$i];
                $bombeamento['corrente_leitura_1_fase_3'] = $dados['corrente_leitura_1_fase_3'][$i];
                $bombeamento['tensao_leitura_1_fase_1'] = $dados['tensao_leitura_1_fase_1'][$i];
                $bombeamento['tensao_leitura_1_fase_2'] = $dados['tensao_leitura_1_fase_2'][$i];
                $bombeamento['tensao_leitura_1_fase_3'] = $dados['tensao_leitura_1_fase_3'][$i];
                $bombeamento['corrente_leitura_2_fase_1'] = $dados['corrente_leitura_2_fase_1'][$i];
                $bombeamento['corrente_leitura_2_fase_2'] = $dados['corrente_leitura_2_fase_2'][$i];
                $bombeamento['corrente_leitura_2_fase_3'] = $dados['corrente_leitura_2_fase_3'][$i];
                $bombeamento['tensao_leitura_2_fase_1'] = $dados['tensao_leitura_2_fase_1'][$i];
                $bombeamento['tensao_leitura_2_fase_2'] = $dados['tensao_leitura_2_fase_2'][$i];
                $bombeamento['tensao_leitura_2_fase_3'] = $dados['tensao_leitura_2_fase_3'][$i];
                array_push($bombeamentos, $bombeamento);
            }
    
    
            // Inserindo os dados de bombeamento no DB.
            $transaction = false;
            $transaction = DB::transaction(function () use ($bombeamentos, $id_afericao) {
    
                foreach ($bombeamentos as $key => $bombeamento) {
                    Bombeamento::create($bombeamento);
                }            
                // Atualizando a flag de pendência na tabela de aferição
                AfericaoPivoCentral::find($id_afericao)->update(['bombeamento_pendente' => 0]);
                return true;
            });
            
            // Inserção de dados no DB OK.
            if($transaction){
                return redirect()->route('gauging_status', $dados['id_afericao']);
                Notificacao::gerarAlert('afericao.sucesso', 'afericao.edicaoSucesso', 'info');
            }
            // Problema para salvar no DB
            else{
                Notificacao::gerarAlert('afericao.erro', 'afericao.erro_processamento', 'warning');
            }
        } else {
            Notificacao::gerarAlert('afericao.erro', 'afericao.bombaInexistente', 'warning');
            return redirect()->back();
        }
    }

    public function editPumping($id_afericao)
    {
        // Identificando o bombeamento.
        $cabecalho_bombeamento = CabecalhoBombeamento::where('id_afericao', $id_afericao)->first();        
        $bombeamentos = Bombeamento::where('id_bombeamento', $cabecalho_bombeamento['id'])->get();
        // Se houver ao menos um bombeamento.
        if($bombeamentos->count() > 0){
            $completo = false;
            if($bombeamentos->count() >= $cabecalho_bombeamento['numero_bombas']){
                $completo = true;
            }
            return view('projetos.afericao.pivoCentral.cadastro.editarBombeamento', compact('cabecalho_bombeamento', 'bombeamentos', 'id_afericao', 'completo'));
        }else{
            return redirect()->back();
        }
    }

    public function updatePumping(Request $req){
        $dados = $req->all();
        $bombeamentos = [];

        // Update no cabeçalho.
        CabecalhoBombeamento::find($dados['id_bombeamento'])->update($dados);

        for ($key = 0; $key < $dados['numero_bombas']; $key++) {
            $bombeamento = [];
            if (isset($dados['id'])) { $bombeamento['id'] = $dados['id'][$key]; }
            $bombeamento['id_bombeamento'] = $dados['id_bombeamento'];
            $bombeamento['comprimento_succao'] = $dados['comprimento_succao'][$key];
            $bombeamento['diametro_succao'] = $dados['diametro_succao'][$key];
            $bombeamento['marca'] = $dados['marca'][$key];
            $bombeamento['modelo'] = $dados['modelo'][$key];
            $bombeamento['numero_rotores'] = $dados['numero_rotores'][$key];
            $bombeamento['diametro_rotor'] = $dados['diametro_rotor'][$key];
            $bombeamento['material_succao'] = $dados['material_succao'][$key];
            $bombeamento['rendimento_bomba'] = $dados['rendimento_bomba'][$key];
            $bombeamento['shutoff'] = $dados['shutoff'][$key];
            $bombeamento['rotacao'] = $dados['rotacao'][$key];
            $bombeamento['pressao_bomba'] = $dados['pressao_bomba'][$key];
            $bombeamento['tipo_motor'] = $dados['tipo_motor'][$key];
            $bombeamento['modelo_motor'] = $dados['modelo_motor'][$key];
            $bombeamento['potencia'] = $dados['potencia'][$key];
            $bombeamento['numero_motores'] = $dados['numero_motores'][$key];
            $bombeamento['chave_partida'] = $dados['chave_partida'][$key];
            $bombeamento['fator_servico'] = $dados['fator_servico'][$key];
            $bombeamento['corrente_nominal'] = $dados['corrente_nominal'][$key];
            $bombeamento['rendimento'] = $dados['rendimento'][$key];
            $bombeamento['tensao_nominal'] = $dados['tensao_nominal'][$key];
            $bombeamento['frequencia'] = $dados['frequencia'][$key];
            $bombeamento['corrente_leitura_1_fase_1'] = $dados['corrente_leitura_1_fase_1'][$key];
            $bombeamento['corrente_leitura_1_fase_2'] = $dados['corrente_leitura_1_fase_2'][$key];
            $bombeamento['corrente_leitura_1_fase_3'] = $dados['corrente_leitura_1_fase_3'][$key];
            $bombeamento['corrente_leitura_2_fase_1'] = $dados['corrente_leitura_2_fase_1'][$key];
            $bombeamento['corrente_leitura_2_fase_2'] = $dados['corrente_leitura_2_fase_2'][$key];
            $bombeamento['corrente_leitura_2_fase_3'] = $dados['corrente_leitura_2_fase_3'][$key];
            $bombeamento['tensao_leitura_1_fase_1'] = $dados['tensao_leitura_1_fase_1'][$key];
            $bombeamento['tensao_leitura_1_fase_2'] = $dados['tensao_leitura_1_fase_2'][$key];
            $bombeamento['tensao_leitura_1_fase_3'] = $dados['tensao_leitura_1_fase_3'][$key];
            $bombeamento['tensao_leitura_2_fase_1'] = $dados['tensao_leitura_2_fase_1'][$key];
            $bombeamento['tensao_leitura_2_fase_2'] = $dados['tensao_leitura_2_fase_2'][$key];
            $bombeamento['tensao_leitura_2_fase_3'] = $dados['tensao_leitura_2_fase_3'][$key];
            array_push($bombeamentos, $bombeamento);
        }
        
        $transaction = false;
        $transaction = DB::transaction(function () use ($bombeamentos, $dados) {
            // Faz update caso seja apenas edição dos campos antigos.
            if (isset($dados['id'])){
                foreach ($bombeamentos as $key => $bombeamento) {
                    Bombeamento::find($bombeamento['id'])->update($bombeamento);
                }
            }
            else{
                // Deleta os campos.
                Bombeamento::where('id_bombeamento', $dados['id_bombeamento'])->delete();
                // Cria novos campos.
                foreach ($bombeamentos as $key => $bombeamento) {
                    Bombeamento::create($bombeamento);
                }
            }
            return true;
        });

        // Verificando a transação do banco de dados.
        if($transaction){
            return redirect()->route('gauging_status', $dados['id_afericao']);
            Notificacao::gerarAlert('afericao.sucesso', 'afericao.edicaoSucesso', 'info');
        }else{
            Notificacao::gerarAlert('afericao.erro', 'afericao.erro_processamento', 'warning');
        }
    }

    public function ContinuePumpingCreate($id_adutora)
    {
        $adutora = Adutora::find($id_adutora);
        if (empty($adutora)) {
            return redirect()->back();
        }
        $qt_bombeamento = Bombeamento::where('id_Adutora', $id_adutora)->count();
        if ($qt_bombeamento >= $adutora['numero_bombas']) {
            return redirect()->back();
        }
        session()->put('id_adutora', $id_adutora);
        session()->put('numero_bombeamentos', $adutora['numero_bombas']);
        session()->put('bomba_atual', $qt_bombeamento + 1);
        return redirect()->route('pumping_create');
    }
}
