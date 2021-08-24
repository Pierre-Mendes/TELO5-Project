<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\Bocal_Itens;
use App\Classes\Sistema\Bocal;
use App\Classes\Constantes\Notificacao;
use Illuminate\Support\Facades\DB;

class BocalController extends Controller
{
    public function searchNozzle(Request $request)
    {
        $bocal = [];

        if (empty($request['filter'])) {
            $bocal = Bocal::select('id', 'marca', 'modelo', 'tipo', 'plug', DB::raw('count(*) as qt'))
                ->groupBy('marca', 'modelo')
                ->orderBy('marca', 'ASC')
                ->orderBy('modelo', 'ASC')
                ->where(function ($query) use ($request) {
                    if (!empty($request['filter'])) {
                        $query->orWhere('marca', 'like', '%' . $request['filter'] . '%')
                            ->orWhere('modelo', 'like', '%' . $request['filter'] . '%')
                            ->orWhere('tipo', 'like', '%' . $request['filter'] . '%');
                    }
                })->paginate(10);
        } else {
            $bocal = Bocal::select('id', 'marca', 'modelo', 'tipo', 'plug', DB::raw('count(*) as qt'))
                ->groupBy('marca', 'modelo')
                ->orderBy('marca', 'ASC')
                ->orderBy('modelo', 'ASC')
                ->where(function ($query) use ($request) {
                    if (!empty($request['filter'])) {
                        $query->orWhere('marca', 'like', '%' . $request['filter'] . '%')
                            ->orWhere('modelo', 'like', '%' . $request['filter'] . '%')
                            ->orWhere('tipo', 'like', '%' . $request['filter'] . '%');
                    }
                })->paginate(10);
        }
        return view('sistema.bocais.manageBocais', compact('bocal'));
    }

    public function manageNozzles()
    {
        $bocal = Bocal::select('id', 'marca', 'modelo', 'plug', 'tipo', 'pressao_psi')
            ->orderBy('marca', 'ASC')
            ->orderBy('modelo', 'ASC')
            ->paginate(10);

        $index = 0;

        foreach ($bocal as $item) {
            $bocal_itens = Bocal_Itens::select(DB::raw('count(*) as qt'))->where('id_bocal', $item->id)->get();

            $bocal[$index]['qt'] = $bocal_itens[0]['qt'];
        }
        return view('sistema.bocais.manageBocais', compact('bocal'));
    }

    public function createNozzle()
    {
        return view('sistema.bocais.createBocais');
    }

    public function saveNozzle(Request $request)
    {
        $bocal = $request->all();

        $bocal['marca'] = $request->get('marca');
        $bocal['modelo'] = $request->get('modelo');
        $bocal['plug'] = $request->get('plug');
        $bocal['tipo'] = $request->get('tipo');
        $bocal['pressao_psi'] = $request->get('pressao_psi');
        $bocal_criado = Bocal::create($bocal);

        $id_bocal = $bocal_criado['id'];
        $bocal['nome'];
        $bocal['vazao'];
        $bocal['intervalo_trabalho'];

        for ($i = 0; $i < count($bocal['vazao']); $i++) {
            $createBocalItem = array(
                'id_bocal' => $id_bocal,
                'nome' => $bocal['nome'][$i],
                'vazao' => $bocal['vazao'][$i],
                'intervalo_trabalho' => $bocal['intervalo_trabalho'][$i]
            );
            Bocal_Itens::create($createBocalItem);
            unset($createBocalItem);
        }
        Notificacao::gerarAlert('', 'bocais.cadastro_bocal_sucesso', 'success');
        return redirect()->route('manage_nozzles');
    }

    public function editNozzle($id)
    {
        $bocal = Bocal::find($id);
        $bocais = Bocal::where('marca', $bocal['marca'])->where('modelo', $bocal['modelo'])->get();
        $bocais_itens = Bocal_Itens::select('id', 'nome', 'vazao', 'intervalo_trabalho')->where('id_bocal', $bocal['id'])->get();
        return view('sistema.bocais.editBocais', compact('bocais', 'bocais_itens'));
    }

    public function updateNozzle(Request $request)
    {
        $bocal = $request->all();

        $bocalArray = [
            'marca' => $bocal['marca'],
            'modelo' => $bocal['modelo'],
            'plug' => $bocal['plug'],
            'tipo' => $bocal['tipo'],
            'pressao_psi' => $bocal['pressao_psi']
        ];
        Bocal::where('id', $bocal['id_bocal'])->update($bocalArray);

        for ($i = 0; $i < count($bocal['vazao']); $i++) {
            $BocalItem = array(
                'id_bocal' => $bocal['id_bocal'],
                'nome' => $bocal['nome'][$i],
                'vazao' => $bocal['vazao'][$i],
                'intervalo_trabalho' => $bocal['intervalo_trabalho'][$i]
            );

            if ($bocal['id_bocaisItens'][$i] == 0) {
                Bocal_Itens::create($BocalItem);
            } else {
                Bocal_Itens::find($bocal['id_bocaisItens'][$i])->update($BocalItem);
            }
            unset($BocalItem);
        }
        Notificacao::gerarAlert('', 'bocais.editar_bocal_sucesso', 'success');
        return redirect()->route('manage_nozzles');
    }

    public function delete($id)
    {
        Bocal::find($id)->delete();
        Bocal_Itens::where('id_bocal', $id)->delete();
        Notificacao::gerarAlert('bocais.sucesso', 'bocais.remocao_sucesso', 'info');
        return redirect()->route('manage_nozzles')->with('Sucesso', 'Foi deletado');
    }
}
