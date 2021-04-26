<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use Session;
use App\Classes\Sistema\CentroDeCusto;
use App\Classes\Sistema\UserSuperior;
use App\Classes\Sistema\CdcUsuario;
use App\Classes\Constantes\Notificacao;

class ProducerController extends Controller
{
    public function getListProducer()
    {
        $producers = FabricanteBocal::select('id', 'fabricante')->paginate(30);
        return view('sistema.producers.listProducer',  compact('producers'));
    }

    public function registerProducer(){
        return view('sistema.producers.registerProducer');
    }

    public function salvarProprietario(Request $req)
    {
        // $dados = $req->all();
        Proprietario::create($req->all());
        Notificacao::gerarAlert('proprietarios.sucesso', 'proprietarios.inserido_sucesso', 'success');
        return redirect()->route('proprietarios.gerenciar');
    }
}
