<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\Pivo;
use App\Classes\Constantes\Notificacao;

class PivoController extends Controller
{
    public function managerPivot(Request $req){
        $filtro = $req->all();
        $pivos = array();
        // Busca distinta dos fabricantes.
        $fabricantes = Pivo::select('fabricante')->distinct('fabricante')->get();
        
        if(empty($filtro['filtro'])){
            $pivos = Pivo::select('id','fabricante', 'nome', 'espacamento')->paginate(10);
        }else{
            $pivos = Pivo::select('id','fabricante', 'nome', 'espacamento')
            ->where(function ($query) use ($filtro){
               
                //Busca pelo fabricante
                if(!empty($filtro['fabricante'])){
                    $query->where('fabricante', 'like', '%'.($filtro['fabricante']).'%');
                }
                /*
                //Busca pela vazão
                if(!empty($filtro['vazao_min'])){
                    $query->where('vazao', '>=' ,($filtro['vazao_min']));
                }

                if(!empty($filtro['vazao_max'])){
                    $query->where('vazao', '<=', ($filtro['vazao_max']));
                }*/
            })
            ->paginate(10);
        }

        foreach($pivos as $Pivo){
            $Pivo['espacamento'] = number_format($Pivo['espacamento'],2,",",".");
            
        }
        return view('sistema.pivos.gerenciar', compact('pivos', 'filtro', 'fabricantes'));
    }    

    public function createPivot()
    {
        return view('sistema.pivos.cadastrar');
    }

    public function savePivot(Request $req){
        Pivo::create($req->all());
        Notificacao::gerarAlert('pivos.sucesso', 'pivos.inserido_sucesso', 'success');
        return redirect()->route('manager_pivot');
    }
    public function editPivot($id){
        $pivos = Pivo::find($id);
        return view('sistema.pivos.editar', compact('pivos'));
    }

    public function updatePivot(Request $req){
        $dados = $req->all();
        Pivo::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('pivos.sucesso', 'pivos.editado_sucesso', 'info');
        return redirect()->route('manager_pivot');
    }

    // public function removerPivo($id){
    //     //Validar Fazendas
    //     Pivo::find($id)->delete();
    //     //Notificacao::gerarAlert('proprietarios.falha', 'proprietarios.remocao_falha', 'danger');
    //     Notificacao::gerarAlert('pivos.sucesso', 'pivos.remocao_sucesso', 'info');
    //     return redirect()->back();
    // }

    public function destroy($id)
    {
        $delete = Pivo::find($id);
        $delete->delete();
        return redirect()->route('manager_pivot')->with('Sucesso', 'Foi deletado');
    }

    public function ajaxAtualizaSaidas(){
        $fabricante = $_GET['valor'];
        
        //Buscando valores de saidas do fabricante.
        $saidas = Pivo::select('saida_1_inicial','saida_2_inicial', 'saida_3_inicial', 'saida_1_intermediario', 'saida_2_intermediario', 'saida_3_intermediario')
        ->where('fabricante', 'like', '%'.$fabricante.'%')
        ->where('saida_1_inicial', '!=', 0)
        ->where('saida_2_inicial', '!=', 0)
        ->where('saida_3_inicial', '!=', 0)
        ->where('saida_1_intermediario', '!=', 0)
        ->where('saida_2_intermediario', '!=', 0)
        ->where('saida_3_intermediario', '!=', 0)
        ->first();
        
        return view('sistema.pivos.ajaxBuscaSaidas', compact('saidas'));
    }
}
