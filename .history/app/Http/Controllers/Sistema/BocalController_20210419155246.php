<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\FabricanteBocal;
use App\Classes\Sistema\Bocal;
use App\Classes\Constantes\Notificacao;

class BocalController extends Controller
{
    //********************************************************************************************************/
    public function getListaDeFabricantes()
    {

        $fabricantes = FabricanteBocal::select('id', 'fabricante', 'modelo')->paginate(30);

        return view('sistema.bocais.gerenciarBocais',  compact('fabricantes'));
    }

    public function cadastraFabricante(Request $req)
    {
        $dados= $req->all();
        FabricanteBocal::create($dados);
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.fabricante_inserido_sucesso', 'success');
        return redirect()->back();
    }

    public function editaFabricante(Request $req)
    {
        $dados = $req->all();
        $id= $dados['id'];
        FabricanteBocal::find($id)->update($dados);
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.editado_sucesso', 'info');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $delete = FabricanteBocal::find($id);
        $delete->delete();
        return redirect()->route('fabricantes.gerenciar')->with('Sucesso', 'Foi deletado');
    }

    //********************************************************************************************************/

    public function cadastrarBocal(){
        return view('sistema.bocais.cadastrarBocais');
    }

    public function getListaDeBocais(Request $req){
        $filtro = $req->all();
        $bocais = array();
        $fabricantes = Bocal::select('fabricante', 'id_fabricante')->distinct('fabricante')->get();

        if(empty($filtro['filtro']))
        {
            $bocais = Bocal::select('id','fabricante', 'tipo', 'nome', 'vazao','vazao_10_psi', 'intervalo_trabalho', 'plug')->paginate(30);

            foreach($bocais as $bocal)
            {
                if ($bocal['tipo'] == 0){ $bocal['tipo'] = \Lang::get('bocais.estatico');}
                else{$bocal['tipo'] = \Lang::get('bocais.rotativo');}
            }
        }
        else{
            $bocais = Bocal::select('id','fabricante', 'nome', 'vazao','vazao_10_psi',  'intervalo_trabalho')
            ->where(function ($query) use ($filtro){

                //Busca pelo fabricante
                if(!empty($filtro['fabricante'])){
                    $query->where('fabricante', 'like', '%'.($filtro['fabricante']).'%');
                }

                //Busca pela vazão
                if(!empty($filtro['vazao_min'])){
                    $query->where('vazao', '>=' ,($filtro['vazao_min']));
                }

                if(!empty($filtro['vazao_max'])){
                    $query->where('vazao', '<=', ($filtro['vazao_max']));
                }
            })
            ->paginate(30);
        }

        foreach($bocais as $bocal){
            $bocal['nome'] = ($bocal['nome']);
            $bocal['vazao'] = number_format($bocal['vazao'],6,",",".");
            $bocal['vazao_10_psi'] = number_format($bocal['vazao_10_psi'],6,",",".");
            $bocal['intervalo_trabalho'] = number_format($bocal['intervalo_trabalho'],6,",",".");
        }
        return view('sistema.bocais.gerenciarBocais', compact('bocais', 'filtro', 'fabricantes'));
    }

    public function getInfosBocal($id){
        $bocal = Bocal::find($id);
        return $bocal;
    }

    public function cadastraBocal(Request $req){
        $dados= $req->all();
        Bocal::create($dados);
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.inserido_sucesso', 'success');
        return redirect()->back();
    }

    public function editaBocal(Request $req){
        $dados = $req->all();
        $id= $dados['id'];
        Bocal::find($id)->update($dados);
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.editado_sucesso', 'info');
        return redirect()->back();
    }

    public function removerBocal($id){
        //Validar Fazendas
        Bocal::find($id)->delete();
        //Notificacao::gerarAlert('proprietarios.falha', 'proprietarios.remocao_falha', 'danger');
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.remocao_sucesso', 'info');
        return redirect()->back();
    }
}
