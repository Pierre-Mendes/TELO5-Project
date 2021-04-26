<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Sistema\FabricanteBocal;
use App\Classes\Sistema\Bocal;
use App\Classes\Constantes\Notificacao;

class ProducerController extends Controller
{
    public function getListProducer()
    {
        $fabricantes = FabricanteBocal::select('id', 'fabricante', 'modelo')->paginate(30);
        return view('sistema.fabricantes.gerenciarBocais',  compact('fabricantes'));
    }
}
