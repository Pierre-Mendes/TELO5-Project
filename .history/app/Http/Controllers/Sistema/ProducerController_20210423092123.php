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
        $producers = FabricanteBocal::select('id', 'fabricante')->paginate(30);
        return view('sistema.producers.listProducer',  compact('producers'));
    }

    public function 
}
