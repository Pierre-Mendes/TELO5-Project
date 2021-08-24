<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\Bocal;
use App\Classes\Constantes\Notificacao;
use Illuminate\Support\Facades\DB;

class BocalController extends Controller
{
    //APRESENTAÇÃO DA VIEW NA TELA DE BOCAIS
    public function manageNozzles()
    {
        $infoBocais = Bocal::select('id', 'fabricante', 'modelo', 'tipo', 'plug', DB::raw('count(*) as qt'))
            ->groupBy('fabricante', 'modelo')
            ->orderBy('fabricante', 'ASC')
            ->orderBy('modelo', 'ASC')
            ->paginate(10);

        return view('sistema.bocais.gerenciarBocais', compact('infoBocais'));
    }

    public function searchNozzle(Request $request)
    {
        $infoBocais = [];

        if(empty($request['filter'])) {
            $infoBocais = Bocal::select('id', 'fabricante', 'modelo', 'tipo', 'plug', DB::raw('count(*) as qt'))
            ->groupBy('fabricante', 'modelo')
            ->orderBy('fabricante', 'ASC')
            ->orderBy('modelo', 'ASC')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('fabricante', 'like', '%'.$request['filter'].'%')
                        ->orWhere('modelo', 'like', '%'.$request['filter'].'%')
                        ->orWhere('tipo', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        } else {
            $infoBocais = Bocal::select('id', 'fabricante', 'modelo', 'tipo', 'plug', DB::raw('count(*) as qt'))
            ->groupBy('fabricante', 'modelo')
            ->orderBy('fabricante', 'ASC')
            ->orderBy('modelo', 'ASC')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('fabricante', 'like', '%'.$request['filter'].'%')
                        ->orWhere('modelo', 'like', '%'.$request['filter'].'%')
                        ->orWhere('tipo', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        }
        return view('sistema.bocais.gerenciarBocais', compact('infoBocais'));
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
        $modelo = $dados['modelo'];
        $plug = $dados['plug'];
        $tipo = $dados['tipo'];
        $vazao10Psi = $dados['vazao_10_psi'];

        for ($i = 0; $i < count($dados['nome']); $i++) {
            $createItem = array(
                '_token' => $token,
                'id_fabricante' => 1,
                'fabricante' => $fabricante,
                'modelo' => $modelo,
                'nome' => $dados['nome'][$i],
                'vazao_10_psi' => $vazao10Psi,
                'vazao' => $dados['vazao'][$i],
                'plug' => $plug,
                'tipo' => $tipo,
                'intervalo_trabalho' => $dados['intervalo_trabalho'][$i]
            );
            Bocal::create($createItem);
            unset($createItem);
        }
        Notificacao::gerarAlert('', 'bocais.cadastro_bocal_sucesso', 'success');
        return redirect()->route('manager_nozzles');
    }

    public function editNozzle($id)
    {
        $bocal = Bocal::find($id);
        $bocais = Bocal::where('fabricante', $bocal['fabricante'])->where('modelo', $bocal['modelo'])->get();
        return view('sistema.bocais.editarBocais', compact('bocais'));
    }


    public function updateNozzle(Request $req)
    {
        $dados = $req->all();
        $token = $dados['_token'];
        $fabricante = $dados['fabricante'];
        $modelo = $dados['modelo'];
        $plug = $dados['plug'];
        $tipo = $dados['tipo'];
        $vazao10Psi = $dados['vazao_10_psi'];

        for ($i = 0; $i < count($dados['nome']); $i++) {
            $updateItem = array(
                '_token' => $token,
                'id_fabricante' => 1,
                'fabricante' => $fabricante,
                'modelo' => $modelo,
                'nome' => $dados['nome'][$i],
                'vazao_10_psi' => $vazao10Psi,
                'vazao' => $dados['vazao'][$i],
                'plug' => $plug,
                'tipo' => $tipo,
                'intervalo_trabalho' => $dados['intervalo_trabalho'][$i]
            );
            Bocal::find($dados['id'][$i])->update($updateItem);
            unset($updateItem);
        }
        Notificacao::gerarAlert('', 'bocais.editar_bocal_sucesso', 'success');
        return redirect()->route('manager_nozzles');
    }

    public function delete($id)
    {
        Bocal::find($id)->delete();
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.remocao_sucesso', 'info');
        return redirect()->route('manager_nozzles')->with('Sucesso', 'Foi deletado');
    }
}
