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
use DB;

class FazendaController extends Controller
{

    public function manageFarms(Request $req)
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
    
    public function searchFarm(Request $request) 
    {
        $fazendas = Fazenda::getFazendasUsuario(10);
        foreach ($fazendas as $fazenda) {
            if ($fazenda['ativa'] == 1) {
                $fazenda['ativa'] = __('fazendas.ativa');
            } else {
                $fazenda['ativa'] = __('fazendas.inativa');
            }
        }
        if(Auth::User()->tipo_usuario != 0) {
            $fazendas = Fazenda::select('id', 'nome', 'cidade' ,'estado', 'pais', 'latitude', 'longitude', 'altitude', 'id_proprietario', 'id_consultor','ativa')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('nome', 'like', '%'.$request['filter'].'%')
                    ->orWhere('cidade', 'like', '%'.$request['filter'].'%')
                    ->orWhere('id_proprietario', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        } else {
            $fazendas = Fazenda::select('id', 'nome', 'cidade' ,'estado', 'pais', 'latitude', 'longitude', 'altitude', 'id_proprietario', 'id_consultor','ativa')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('nome', 'like', '%'.$request['filter'].'%')
                        ->orWhere('cidade', 'like', '%'.$request['filter'].'%')
                        ->orWhere('id_proprietario', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        }
        
        $proprietarios = Proprietario::select('nome', 'id')->get();
        return view('sistema.fazendas.gerenciar', compact('fazendas', 'proprietarios'));
    }
    
    public function createFarm()
    {
        $proprietarios = Proprietario::select('nome', 'id')->get();
        $consultores = User::where('tipo_usuario', 3)->where('situacao', 1)->select('id', 'nome')->get();
        return view('sistema.fazendas.cadastrar', compact('proprietarios', 'consultores'));
    }

    public function saveFarm(Request $req)
    {
        // dd($req->all());
        Fazenda::create($req->all());
        Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.cadastro_sucesso');
        return redirect()->route('farms_manager');
    }


    public function selectFarms()
    {
        // $fazendas = Fazenda::getFazendasUsuario()->pluck('id', 'nome');
        // dd($fazendas);

        $tipo_usuario = (Auth::user()->tipo_usuario);
        $fazendas = array();
        $id_usuario = Auth::user()->id;

        switch ($tipo_usuario) {
            case 0: { //Admin
                    $fazendas = Fazenda::select('fazendas.id', 'fazendas.nome')->join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->where('fazendas.ativa', 1)->get();
                    break;
                }
            case 1: { //Gerente
                    $fazendas = Fazenda::select('fazendas.id', 'fazendas.nome')->join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->where('US.id_superior', $id_usuario)->where('fazendas.ativa', 1);
                    break;
                }
            case 2: { //Supervisor
                    $fazendas = Fazenda::select('fazendas.id', 'fazendas.nome')->join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->where('US.id_superior', $id_usuario)->where('fazendas.ativa', 1);
                    break;
                }
            case 3: { //Consultor
                    $fazendas = Fazenda::select('fazendas.id', 'fazendas.nome')->join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->where('fazendas.id_consultor', $id_usuario)->where('fazendas.ativa', 1);
                    break;
                }
            case 4: { //Assistente
                    $fazendas = Fazenda::select('fazendas.id', 'fazendas.nome')->join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->join('usuarios_fazendas as UF', 'fazendas.id', 'UF.id_fazenda')->where('UF.id_usuario', $id_usuario)->where('fazendas.ativa', 1);
                    break;
                }
            default: {
                    break;
                }
        }
        $fazendas = $fazendas->pluck('id', 'nome');
        return json_encode($fazendas);
    }

    public function setFarm(Request $req)
    {
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

    public function editFarm($id)
    {
        $fazenda = Fazenda::find($id);
        $proprietarios = Proprietario::select('nome', 'id')->get();
        $consultores = User::where('tipo_usuario', 3)->where('situacao', 1)->select('id', 'nome')->get();
        return view('sistema.fazendas.editar', compact('fazenda', 'proprietarios', 'consultores'));
    }

    public function updateFarm(Request $req)
    {
        $dados = $req->all();
        Fazenda::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.atualizada_sucesso');
        return redirect()->route('farms_manager');
    }

    public function deleteFarm($id)
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

    public function userAssist()
    {
        $assistentes = [];
        $assistentes['assistentes'] = UserSuperior::userAssist(Auth::user()->id);
        return $assistentes;
    }

    public function createAssist(Request $req)
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

    public function deleteAssist($id_assistente)
    {
        if (session()->has('fazenda')) {
            UsuariosFazendas::where('id_usuario', $id_assistente)->where('id_fazenda', Session::get('fazenda')['id'])->delete();
            Notificacao::gerarAlert('fazendas.sucesso', 'fazendas.assistente_removido_sucesso', 'primary');
        } else {
            Notificacao::gerarAlert('fazendas.erro', 'fazendas.fazenda_nao_encontrada', 'warning');
        }
        return redirect()->back();
    }
}
