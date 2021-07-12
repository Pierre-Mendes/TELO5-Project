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
use App\Classes\Sistema\cad_bocais;

class ProducerController extends Controller
{
    public function getListProducer()
    {
        $producers = cad_bocais::select('id', 'fabricante')->paginate(10);
        return view('sistema.producers.listProducer',  compact('producers'));
    }

    public function registerProducer()
    {
        return view('sistema.producers.registerProducer');
    }

    public function saveProducer(Request $req)
    {
        $dados = $req->all();
        $check = cad_bocais::where('fabricante', $dados['fabricante'])->count();
        if ($check == 0) {
            cad_bocais::create($dados);
            Notificacao::gerarAlert('fabricante.sucesso', 'fabricante.inserido_sucesso', 'success');
            return redirect()->route('producer.list');
        } else {
            Notificacao::gerarAlert('Fabricantes.aviso', 'Fabricante_ja_cadastrado', 'warning');
        }
    }
}
