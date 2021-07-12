<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\Proprietario;
use App\Classes\Constantes\Notificacao;

class ProprietarioController extends Controller
{
    public function managerOwners(Request $req)
    {
        $filtro = $req->all();
        $proprietarios = array();
        $proprietarios = Proprietario::select('id', 'nome', 'tipo_pessoa', 'documento', 'telefone', 'email')->paginate(10);
        foreach ($proprietarios as $proprietario) {
            if ($proprietario['tipo_pessoa'] == 'fisica') {
                $proprietario['tipo_pessoa'] = __('proprietarios.pessoa_fisica');
            } else {
                $proprietario['tipo_pessoa'] = __('proprietarios.pessoa_juridica');
            }
        }
        return view('sistema.proprietarios.gerenciar', compact('proprietarios', 'filtro'));
    }

    public function createOwner()
    {
        return view('sistema.proprietarios.cadastrar');
    }

    public function saveOwner(Request $req)
    {
        // $dados = $req->all();
        Proprietario::create($req->all());
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.inserido_sucesso', 'success');
        return redirect()->route('owner_manager');
    }

    public function editOwner($id){
        $proprietarios = Proprietario::find($id);
        return view('sistema.proprietarios.editar', compact('proprietarios'));
    }

    public function updateOwner(Request $req){
        $dados = $req->all();
        Proprietario::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.editado_sucesso', 'info');
        return redirect()->route('owner_manager');
    }

    public function removerProprietario($id)
    {
        //Validar Fazendas
        Proprietario::find($id)->delete();
        //Notificacao::gerarAlert('proprietarios.falha', 'proprietarios.remocao_falha', 'danger');
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.remocao_sucesso', 'info');
        return redirect()->back();
    }

    public function delete($id)
    {
        $delete = Proprietario::find($id);
        $delete->delete();
        return redirect()->route('owner_manager')->with('Sucesso', 'Foi deletado');
    }

}
