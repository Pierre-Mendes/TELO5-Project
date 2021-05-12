<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\Fazenda;
use App\Classes\Sistema\Proprietario;
use App\Classes\Sistema\UserSuperior;
use App\Classes\Sistema\UsuariosFazendas;
use App\Classes\Constantes\Notificacao;
use App\User;
use Auth;
use Illuminate\Foundation\Console\Presets\React;
use Session;
use URL;

class FazendaController extends Controller
{
    public function cadastrarFazenda()
    {
        $proprietarios = Proprietario::select('nome', 'id')->get();
        $consultores = User::where('tipo_usuario', 3)->where('situacao', 1)->select('id', 'nome')->get();
        return view('sistema.fazendas.cadastrar', compact('proprietarios', 'consultores'));
    }

    public function salvarFazenda(Request $req)
    {
        Fazenda::create($req->all());
        Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.cadastro_sucesso');
        return redirect()->route('fazendas.gerenciar');
    }

    public function listarFazendas(Request $req)
    {

        $fazendas = Fazenda::getFazendasUsuario(10);
        foreach ($fazendas as $fazenda) {
            if ($fazenda['ativa'] == 1) {
                $fazenda['ativa'] = __('fazendas.ativa');
            } else {
                $fazenda['ativa'] = __('fazendas.inativa');
            }
        }
        $proprietarios = Proprietario::select('nome', 'id')->get();
        $consultores = User::where('tipo_usuario', 3)->where('situacao', 1)->select('id', 'nome')->get();
        return view('sistema.fazendas.gerenciar', compact('fazendas', 'proprietarios', 'consultores'));
    }

    public function listFazendas(){
        $fazendas = Fazenda::getFazendasUsuario()->pluck('id', 'nome');
        return json_encode($fazendas);
    }

    public function setFazenda(Request $req){
        $dados = $req->all();
        $fazenda = Fazenda::find($dados['id']);

        if (session()->has('fazenda')) {
            Session::forget('fazenda');
        }

        $fazenda_sessao = [];
        $fazenda_sessao['nome'] = $fazenda['nome'];
        $fazenda_sessao['id'] = $fazenda['id'];
        session(['fazenda' => $fazenda_sessao]);

        return json_encode($fazenda_sessao);
    }

    public function selecionarFazenda(Request $request)
    {
        $fazendas = Fazenda::all();
        return view('sistema.fazendas.gerenciar', compact('fazendas', 'proprietarios', 'consultores', 'filtro'));
    }

    public function editarFazenda($id)
    {
        $fazenda = Fazenda::find($id);
        $proprietarios = Proprietario::select('nome', 'id')->get();
        $consultores = User::where('tipo_usuario', 3)->where('situacao', 1)->select('id', 'nome')->get();
        return view('sistema.fazendas.editar', compact('fazenda', 'proprietarios', 'consultores'));
    }

    public function editaFazenda(Request $req)
    {
        $dados = $req->all();
        Fazenda::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.atualizada_sucesso');
        return redirect()->route('fazendas.gerenciar');
    }

    public function removerFazenda($id)
    {
        //Verificar usos da fazenda

        Fazenda::find($id)->delete();
        Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.removida_sucesso');
        return redirect()->back();
    }

    public function getFazendasParaSelecionar()
    {
        $lista = [];
        $lista = Fazenda::getResumoFazendasAtivasUsuario();
        return json_encode($lista);
    }

    public function alterarFazendaSessao(Request $req)
    {
        $fazenda = $req->all()['fazenda'];
        if (!empty($fazenda)) {
            $nome_fazenda = Fazenda::find($fazenda)['nome'];
            $fazenda_sessao = [];
            $fazenda_sessao['nome'] = $nome_fazenda;
            $fazenda_sessao['id'] = $fazenda;
            session(['fazenda' => $fazenda_sessao]);
        } else {
            Session::forget('fazenda');
        }
        return redirect()->back();
    }



    public function detalheFazenda()
    {
        if (session()->has('fazenda')) {
            $id_fazenda = Session::get('fazenda')['id'];
            $fazenda = Fazenda::select('fazendas.*', 'P.nome as nome_proprietario', 'U.nome as nome_consultor')
                ->where('fazendas.id', $id_fazenda)
                ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                ->join('users as U', 'U.id', 'fazendas.id_consultor')
                ->first();
            $assistentes = Fazenda::getAssistentesDaFazenda($id_fazenda);
            return view('sistema.fazendas.fazenda', compact('fazenda', 'assistentes'));
        } else {
            Notificacao::gerarModal('fazendas.aviso', 'fazendas.selecione_fazenda', 'info');
            return redirect()->back();
        }
    }

    public function getAssistentesDoUsuario()
    {
        $assistentes = [];
        $assistentes['assistentes'] = UserSuperior::getAssistentesDoUsuario(Auth::user()->id);
        return $assistentes;
    }
    public function adicionarAssistente(Request $req)
    {
        if (session()->has('fazenda')) {

            $assistente['id_usuario'] = $req->all()['id_assistente'];
            $assistente['id_fazenda'] = Session::get('fazenda')['id'];
            $count = UsuariosFazendas::where('id_fazenda', $assistente['id_fazenda'])->where('id_usuario', $assistente['id_usuario'])->count();
            if ($count < 1) {
                UsuariosFazendas::create($assistente);
                Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.assistente_inserido_com_sucesso', 'info');
            } else {
                Notificacao::gerarAlert('fazendas.aviso', 'fazendas.assistente_ja_cadastrado_fazenda', 'warning');
            }

            return redirect()->back();
        } else {
            Notificacao::gerarAlert('fazendas.erro', 'fazenda.fazenda_nao_encontrada', 'info');
            return redirect()->back();
        }
    }

    public function removerAssistente($id_assistente)
    {
        if (session()->has('fazenda')) {
            UsuariosFazendas::where('id_usuario', $id_assistente)->where('id_fazenda', Session::get('fazenda')['id'])->delete();
            Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.assistente_removido_sucesso', 'primary');
        } else {
            Notificacao::gerarAlert('fazendas.erro', 'fazendas.fazenda_nao_encontrada', 'warning');
        }
        return redirect()->back();
    }

    public function teste()
    {
        dd(URL::previous());
    }
}
