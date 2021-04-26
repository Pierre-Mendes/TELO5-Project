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
use App\Classes\Sistema\FabricanteBocal;

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

    public function saveProducer(Request $req)
    {
        $dados = $req->all();
        $check =  DB::table('fabricante_bocal')->where('fabricante', $dados['fabricante'])->first();

        if (!empty($check))
        {
            Notificacao::gerarAlert("notificacao.erro", "danger");
            return redirect()->back();
        }
        Notificacao::gerarAlert('fabricante.sucesso', 'fabricante.inserido_sucesso', 'success');
        return redirect()->route('producer.list');
    }
}
