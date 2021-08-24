<?php

namespace App\Http\Controllers\EntregaTecnica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Constantes\Notificacao;
use Illuminate\Support\Facades\DB;
use App\Classes\Sistema\Revendas;
use App\Classes\Sistema\Proprietario;
use App\Classes\Sistema\Fazenda;
use App\Classes\EntregaTecnica\EntregaTecnica;
use App\User;

class EntregaTecnicaController extends Controller
{
    public function manageTechnicalDelivery() 
    {
        return view('entregaTecnica.gerenciarEntregaTecnica');
    }

    public function createTechnicalDelivery() 
    {
        $proprietarios = Proprietario::select('nome', 'id')->orderBy('nome')->get();
        $revendas = Revendas::select('id', 'nome')->get();
        $consultores = User::where('tipo_usuario', 3)->where('situacao', 1)->select('id', 'nome')->get();
        return view('entregaTecnica.createEntregaTecnica', compact('proprietarios', 'fazendas', 'consultores', 'revendas'));
    }

    public function saveTechnicalDelivery(Request $Req) 
    {
        EntregaTecnica::create($Req->all());

        Notificacao::gerarAlert('', 'fazendas.cadastro_fazenda_sucesso', 'success');
        return redirect()->route('manage_technical_delivery');
    }

    public function findFarms(Request $request)
    {
        $fazendas = Fazenda::select('id', 'nome')->where('id_proprietario', $request->get('id') )->get();
        $lista_fazenda = [];
        foreach( $fazendas as $fazenda )
        {
            $lista_fazenda[$fazenda->id] = $fazenda->nome;
        }
        
        return $lista_fazenda;
    }
}
