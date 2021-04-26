<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\Proprietario;
use App\Classes\Constantes\Notificacao;

class ProprietarioController extends Controller
{
    public function listarProprietarios(Request $req)
    {
        $filtro = $req->all();
        $proprietarios = array();
        $proprietarios = Proprietario::select('id', 'nome', 'tipo_pessoa', 'documento', 'telefone', 'email')->paginate(30);
        foreach ($proprietarios as $proprietario) {
            if ($proprietario['tipo_pessoa'] == 'fisica') {
                $proprietario['tipo_pessoa'] = __('proprietarios.pessoa_fisica');
            } else {
                $proprietario['tipo_pessoa'] = __('proprietarios.pessoa_juridica');
            }
        }
        return view('sistema.proprietarios.gerenciar', compact('proprietarios', 'filtro'));
    }

    public function cadastrarProprietario()
    {
        return view('sistema.proprietarios.cadastrar');
    }

    public function salvarProprietario(Request $req)
    {
        // $dados = $req->all();
        Proprietario::create($req->all());
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.inserido_sucesso', 'success');
        return redirect()->route('proprietarios.gerenciar');
    }

    public function editarProprietario($id){
        $proprietarios = Proprietario::find($id);
        return view('sistema.proprietarios.editar', compact('proprietarios'));
    }

    public function editaProprietario(Request $req){
        $dados = $req->all();
        Proprietario::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.editado_sucesso', 'info');
        return redirect()->route('proprietarios.gerenciar');
    }

    public function removerProprietario($id)
    {
        //Validar Fazendas
        Proprietario::find($id)->delete();
        //Notificacao::gerarAlert('proprietarios.falha', 'proprietarios.remocao_falha', 'danger');
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.remocao_sucesso', 'info');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $delete = Proprietario::find($id);
        $delete->delete();
        return redirect()->route('proprietarios.gerenciar')->with('Sucesso', 'Foi deletado');
    }

    public function create(){
        
    }

}
