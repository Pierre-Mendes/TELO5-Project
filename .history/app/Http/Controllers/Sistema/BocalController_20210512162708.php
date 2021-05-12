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
    //APRESENTAÇÃO DA VIEW NA TELA DE BOCAIS
    public function getListaDeFabricantes()
    {
        // $fabricantes = FabricanteBocal::select('id', 'fabricante', 'modelo')->paginate(30);
        $fabricante = bocal::select('id', 'fabricante', 'modelo', 'nome')->paginate(10);

        return view('sistema.bocais.gerenciarBocais',  compact('fabricante'));
    }
    //********************************************************************************************************/

    public function cadastrarBocal()
    {
        return view('sistema.bocais.cadastrarBocais');
    }


    public function cadastraBocal(Request $req)
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

        /*
        for ($i = 0; $i < count($dados['nome']); $i++) {
            $item = array(
                '_token' => $token,
                'id_fabricante' => $dados['id'][$i],
                'fabricante' => $dados['nome'][$i],
                'nome' => $dados['nome'][$i],
                'vazao_10_psi' => $dados['vazao_10_psi'][$i],
                'vazao' => 1,
                'plug' => 1,
                'tipo' => 1,
                'intervalo_trabalho' => $dados['intervalo_trabalho'][$i]
            );
            //dd($item);
            //dump($item);
            Bocal::create($item);
            unset($item);
            //die();
            //dump($item);
        }*/

        Notificacao::gerarAlert('Bocais.sucesso', 'bocais.inserido_sucesso', 'success');
        return redirect()->route('fabricantes.gerenciar');
    }

    /*public function getListaDeBocais(Request $req)
    {
        $filtro = $req->all();
        $bocais = array();
        $fabricantes = Bocal::select('fabricante', 'id_fabricante')->distinct('fabricante')->get();

        if (empty($filtro['filtro'])) {
            $bocais = Bocal::select('id', 'fabricante', 'tipo', 'nome', 'vazao', 'vazao_10_psi', 'intervalo_trabalho', 'plug')->paginate(30);

            foreach ($bocais as $bocal) {
                if ($bocal['tipo'] == 0) {
                    $bocal['tipo'] = \Lang::get('bocais.estatico');
                } else {
                    $bocal['tipo'] = \Lang::get('bocais.rotativo');
                }
            }
        } else {
            $bocais = Bocal::select('id', 'fabricante', 'nome', 'vazao', 'vazao_10_psi', 'intervalo_trabalho')
                ->where(function ($query) use ($filtro) {
                    //Busca pelo fabricante
                    if (!empty($filtro['fabricante'])) {
                        $query->where('fabricante', 'like', '%' . ($filtro['fabricante']) . '%');
                    }

                    //Busca pela vazão
                    if (!empty($filtro['vazao_min'])) {
                        $query->where('vazao', '>=', ($filtro['vazao_min']));
                    }

                    if (!empty($filtro['vazao_max'])) {
                        $query->where('vazao', '<=', ($filtro['vazao_max']));
                    }
                })
                ->paginate(30);
        }

        foreach ($bocais as $bocal) {
            $bocal['nome'] = ($bocal['nome']);
            $bocal['vazao'] = number_format($bocal['vazao'], 6, ",", ".");
            $bocal['vazao_10_psi'] = number_format($bocal['vazao_10_psi'], 6, ",", ".");
            $bocal['intervalo_trabalho'] = number_format($bocal['intervalo_trabalho'], 6, ",", ".");
        }
        return view('sistema.bocais.editarBocais', compact('bocais', 'filtro', 'fabricantes'));
    }*/

    /*public function getInfosBocal($id)
    {
        $bocal = Bocal::find($id);
        return view('sistema.bocais.editarBocais', compact('bocal'));
    }*/

    public function getListaDeBocais($id)
    {
        $bocal = Bocal::find($id);
        return view('sistema.bocais.editarBocais', compact('bocal'));
    }


    public function editaBocal(Request $req)
    {
        $dados = $req->all();
        Bocal::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.editado_sucesso', 'info');
        return redirect()->route('fabricantes.gerenciar');
    }

    public function destroy($id)
    {
        //Validar Fazendas
        Bocal::find($id)->delete();
        //Notificacao::gerarAlert('proprietarios.falha', 'proprietarios.remocao_falha', 'danger');
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.remocao_sucesso', 'info');
        return redirect()->back();
    }
}
