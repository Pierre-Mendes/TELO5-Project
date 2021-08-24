<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Constantes\Notificacao;
use Illuminate\Support\Facades\DB;
use App\Classes\Sistema\Revendas;

class RevendasController extends Controller
{
    public function managerResales()
    {
        $manager_revenda = Revendas::select('id', 'nome', 'telefone', 'email')
            ->orderby('nome', 'ASC')
            ->paginate(10);
        return view('sistema.revendas.gerenciar_revendas', compact('manager_revenda'));
    }

    public function searchResales(Request $request) 
    {
        $revendas = [];
        
        if(empty($request['filter'])) {
            $revendas = Revendas::select('id', 'nome', 'codigo')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('nome', 'like', '%'.$request['filter'].'%')
                        ->orWhere('telefone', 'like', '%'.$request['filter'].'%')
                        ->orWhere('email', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        } else {
            $revendas = Revendas::select('id', 'nome', 'codigo')->orderBy('created_at')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('nome', 'like', '%'.$request['filter'].'%')
                        ->orWhere('telefone', 'like', '%'.$request['filter'].'%')
                        ->orWhere('email', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        }
        return view('sistema.centroDeCustos.gerenciar', compact('cdcs'));
    }

    public function createResales()
    {
        return view('sistema.revendas.create_revendas');
    }

    public function saveResales(Request $req)
    {
        Revendas::create($req->all());
        Notificacao::gerarAlert('', 'revendas.cadastro_revenda_sucesso', 'success');
        return redirect()->route('manager_resales');
    }

    public function editResales($id)
    {
        $revendas = Revendas::find($id);
        return view('sistema.revendas.edit_revendas', compact('revendas'));
    }

    public function updateResales(Request $req)
    {
        $dados = $req->all();
        Revendas::find($dados['id'])->update($dados);
        Notificacao::gerarAlert('', 'revendas.editar_revenda_sucesso', 'success');
        return redirect()->route('manager_resales');
    }

    public function delete($id)
    {
        $delete = Revendas::find($id);
        $delete->delete();
        return redirect()->route('manager_resales')->with('Sucesso', 'Foi deletado');
    }
}
