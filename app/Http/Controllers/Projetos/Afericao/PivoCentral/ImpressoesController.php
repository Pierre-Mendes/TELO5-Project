<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Classes\Projetos\Afericao\PivoCentral\TrechoAdutora;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use App\Classes\Projetos\Afericao\PivoCentral\RelatorioVelocidade;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\CabecalhoBombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\CustoLaminaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Constantes\Notificacao;

class ImpressoesController extends Controller
{
    public function geranciaImpressoes($id_afericao){
        //return view('projetos.afericao.pivoCentral.relatorio.mapaBocais.mapaBocais');
    }

    public function geranciaImpressaoMapaBocal($id_afericao){
        return view('projetos.afericao.pivoCentral.relatorio.mapaBocais.mapaBocais');
    }

    public function geranciaImpressaoFuncionamentoPivo($id_afericao){
        return view('projetos.afericao.pivoCentral.relatorio.funcionamentoPivo.funcionamentoPivo');
    }

}