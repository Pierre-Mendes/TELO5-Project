<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\CentroDeCusto;
use App\Classes\Sistema\CdcUsuario;
use App\Classes\Constantes\Notificacao;
use DB;

class CentroCustosController extends Controller
{
    public function cadastrarCentroCustos()
    {
        return view('sistema.centroDeCustos.cadastrar');
    }

    public function salvarCentroCustos(Request $req)
    {
        dd($req->all());
        CentroDeCusto::create($req->all());
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.cadastroSucesso", "success");
        return redirect()->route('centrocusto.gerenciar');
    }

    public function listarCentroCustos()
    {
        $nopage = null;
        $cdcs = CentroDeCusto::select('id', 'nome', 'codigo')->paginate($nopage);
        return view('sistema.centroDeCustos.gerenciar', compact('cdcs'));
    }

    public function editarCentroCustos($id)
    {
        $centroCusto = CentroDeCusto::find($id);
        return view('sistema.centroDeCustos.editar', compact('centroCusto'));
    }

    public function editaCentroCustos(Request $req)
    {
        $dados = $req->all();
        CentroDeCusto::find($dados['id'])->update($dados);
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.edicaoSucesso", "success");
        return redirect()->route('centrocusto.gerenciar');
    }

    public function removerCentroCustos($id)
    {
        $validacao = CdcUsuario::where('id_centro_custo', $id)->count();
        if ($validacao > 0) {
            //Notifica
            Notificacao::gerarAlert("notificacao.erro", "cdc.erroUsuariosCentroCusto", "danger");
        } else {
            CentroDeCusto::find($id)->delete();
            Notificacao::gerarAlert("notificacao.sucesso", "notificacao.remocaoSucesso", "success");
        }
        return redirect()->route('centrocusto.gerenciar');
    }

    public function destroy($id)
    {
        $delete = CentroDeCusto::find($id);
        $delete->delete();
        return redirect()->route('centrocusto.gerenciar')->with('Sucesso', 'Foi deletado');
    }
}
