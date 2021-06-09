<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\FabricanteBocal;
use App\Classes\Sistema\Bocal;
use App\Classes\Constantes\Notificacao;

class BocalController extends Controller
{
    //APRESENTAÇÃO DA VIEW NA TELA DE BOCAIS
    public function manageNozzles()
    {
        // $fabricantes = FabricanteBocal::select('id', 'fabricante', 'modelo')->paginate(10);
        $fabricante = bocal::select('id', 'fabricante', 'modelo', 'nome', 'tipo')->paginate(10);

        return view('sistema.bocais.gerenciarBocais',  compact('fabricante'));
    }

    public function createNozzle()
    {
        return view('sistema.bocais.cadastrarBocais');
    }


    public function saveNozzle(Request $req)
    {
        $dados = $req->all();
        $token = $dados['_token'];
        $fabricante = $dados['fabricante'];


        for ($i = 0; $i < count($dados['modelo']); $i++) {
            $item = array(
                '_token' => $token,
                'id_fabricante' => 1,
                'fabricante' => $fabricante,
                'modelo' => $dados['modelo'][$i],
                'nome' => $dados['nome'][$i],
                'vazao_10_psi' => $dados['vazao_10_psi'][$i],
                'vazao' => 1,
                'plug' => $dados['plug'][$i],
                'tipo' => $dados['tipo'][$i],
                'intervalo_trabalho' => $dados['intervalo_trabalho'][$i]
            );
            Bocal::create($item);
            unset($item);
        }

        Notificacao::gerarAlert('Bocais.sucesso', 'bocais.inserido_sucesso', 'success');
        return redirect()->route('manager_nozzles');
    }

    public function editNozzle($id){
        $bocal = Bocal::find($id);
        return view('sistema.bocais.editarBocais', compact('bocal'));
    }


    public function updateNozzle(Request $req)
    {
        $dados = $req->all();
        Bocal::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.editado_sucesso', 'info');
        return redirect()->route('manager_nozzles');
    }

    public function delete($id)
    {
        //Validar Fazendas
        Bocal::find($id)->delete();
        //Notificacao::gerarAlert('proprietarios.falha', 'proprietarios.remocao_falha', 'danger');
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.remocao_sucesso', 'info');
        return redirect()->back();
    }
}
