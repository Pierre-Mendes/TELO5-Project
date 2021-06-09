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
    public function createCostCenter()
    {
        return view('sistema.centroDeCustos.cadastrar');
    }

    public function saveCostCenter(Request $req)
    {
        $validacao = CentroDeCusto::where("codigo", $req->all()['codigo'])->count();
        if($validacao > 0){
            Notificacao::gerarAlert("notificacao.erro", "cdc.erroCodigoCdc", "danger");
            return redirect()->back();
        }
        CentroDeCusto::create($req->all());
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.cadastroSucesso", "success");
        return redirect()->route('manage_cost_center');
    }

    public function manageCostCenter()
    {
        $nopage = null;
        $cdcs = CentroDeCusto::select('id', 'nome', 'codigo')->paginate(10);
        return view('sistema.centroDeCustos.gerenciar', compact('cdcs'));
    }

    public function editCostCenter($id)
    {
        $centroCusto = CentroDeCusto::find($id);
        return view('sistema.centroDeCustos.editar', compact('centroCusto'));
    }

    public function updateCostCenter(Request $req)
    {
        $dados = $req->all();
        CentroDeCusto::find($dados['id'])->update($dados);
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.edicaoSucesso", "success");
        return redirect()->route('manage_cost_center');
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
        return redirect()->route('manage_cost_center');
    }

    public function delete($id)
    {
        $delete = CentroDeCusto::find($id);
        $delete->delete();
        return redirect()->route('manage_cost_center')->with('Sucesso', 'Foi deletado');
    }
}
