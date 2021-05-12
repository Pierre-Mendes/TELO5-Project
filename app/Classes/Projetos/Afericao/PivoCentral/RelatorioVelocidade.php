<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Sistema\Bocal;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\CanhaoFinal;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Constantes\Notificacao;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;

use Auth;
use DB;




class RelatorioVelocidade extends Model
{

    protected $fillable = [
        'id_afericao' , 'id_emissor', 'id_usuario', 'posicao_emissor', 'vazao_aspersor',
        'vazao_liberada', 'pressao_entrada', 'lamina_media', 'lamina_aplicada',


        'area_aspersor', 'area_acumulada', 'vazao_spray_requerida', 'q_bocal_1', 'q_bocal_2',
        'comprimento', 'q_max_valvula', 'vazao_sprays_teorica', 'vazao_sprays_real', 'velocidade', 'perda_carga_teorica',
        'perda_carga_real', 'perda_pressao_acumulada_real', 'pressao_saida', 'aai', 'si', 'li', 'li_si',
        'desvios', 'si_desvios'
    ];

    public static function geraRelatorioVelocidade($id_afericao)
    {
        $dados = MapaOriginal::gerarMapaOriginal($id_afericao);
        return $dados[0];
    }
}
