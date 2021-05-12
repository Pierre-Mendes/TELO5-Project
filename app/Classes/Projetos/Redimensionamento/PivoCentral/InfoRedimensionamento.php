<?php

namespace App\Classes\Projetos\Redimensionamento\PivoCentral;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


use Auth;
use DB;
use Session;
use App\Classes\Constantes\Notificacao;
use App\Classes\Sistema\Fazenda;
use App\Classes\Sistema\Pivo;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\CanhaoFinal;
use App\Classes\Projetos\Afericao\PivoCentral\PivoConjugado;
use App\Classes\Projetos\Afericao\PivoCentral\ProblemaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\TrechoAdutora;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\Adutora;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoHidraulica;
use App\Classes\Sistema\VelocidadeAfericao_100;
use App\Classes\Sistema\VelocidadePercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;

class InfoRedimensionamento extends Model
{
    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_afericao_original', 'id_afericao_redimensionamento', 'vazao_total', 
        'num_lances_c_plug','num_emissores_c_plug_inicio', 'espacamento_maximo_plug'
    ];




    public static function duplicarInformacoesAfericao($id_afericao){
        $novoId = 0;
        /**
         * Esta função duplica as informações da aferição para criar o redimensionamento
         * 
         */

        $mapa_original_afericao = MapaOriginal::gerarMapaOriginal($id_afericao, true);
        if(empty($mapa_original_afericao)){
            return 0;
        }
        $infos_redimensionamento = [];
        $infos_redimensionamento['id_afericao_original'] = $id_afericao;
        $infos_redimensionamento['vazao_total'] = $mapa_original_afericao[0]['somatorio_vazao_ok'];
        $infos_redimensionamento['num_lances_c_plug'] = 2;
        $infos_redimensionamento['num_emissores_c_plug_inicio'] = 3;
        $infos_redimensionamento['espacamento_maximo_plug'] = 3;


         /* Buscando os dados para duplicar */
        $redimensionamento = AfericaoPivoCentral::find($id_afericao);
        //dd($redimensionamento->attributes);
        $redimensionamento['tipo_projeto'] = 'R';
        $redimensionamento['data_afericao'] = date('Y-m-d');
        $redimensionamento['id_usuario'] = Auth::user()->id;
        $afericao_hidraulica_redimensionamento = AfericaoHidraulica::where('id_afericao', $id_afericao)->first();
        $canhao_final_redimensionamento = CanhaoFinal::where('id_afericao', $id_afericao)->first();
        $lances_redimensionamento = Lance::where('id_afericao', $id_afericao)->orderby('numero_lance', 'asc')->get();
        
        $emissores_redimensionamento = Emissor::select('emissores.*')
            ->join('lances as L', 'L.id', 'emissores.id_lance')
            ->where('L.id_afericao', $id_afericao)
            ->orderby('L.numero_lance', 'asc')
            ->orderby('emissores.numero', 'asc')
            ->get();
        $adutora_redimensionamento = Adutora::where('id_afericao', $id_afericao)->first();
        $pivo_conjugado_redimensionamento = PivoConjugado::where('id_afericao', $id_afericao)->first();
        $problema_redimensionamento = ProblemaAfericao::where('id_afericao', $id_afericao)->first();
        //dd(TrechoAdutora::where('id_adutora',  $adutora_redimensionamento['id']));
        //$trechos_adutora_redimensionamento = TrechoAdutora::where('id_adutora',  $adutora_redimensionamento['id'])->get();
        $bombeamentos_redimensionamento = Bombeamento::where('id_adutora', $adutora_redimensionamento['id'])->get();
        $velocidade_redimensionamento = VelocidadeAfericao_100::where('id_afericao', $id_afericao)->first();
        $velocidade_percentimetro_redimensionamento = VelocidadePercentimetro::where('id_afericao', $id_afericao)->first();


        $novoId = DB::transaction(function () 
        use (
                $redimensionamento,
                $afericao_hidraulica_redimensionamento, 
                $canhao_final_redimensionamento, 
                $lances_redimensionamento, 
                $pivo_conjugado_redimensionamento,
                $problema_redimensionamento,

                $bombeamentos_redimensionamento,
                $adutora_redimensionamento,
                $emissores_redimensionamento,
                $infos_redimensionamento, 
                $velocidade_redimensionamento, 
                $velocidade_percentimetro_redimensionamento
            ) 
        {
            $red_db = AfericaoPivoCentral::create($redimensionamento->attributes);
            $red_db = $red_db['id'];
            
            $afericao_hidraulica_redimensionamento['id_afericao'] = $red_db;
            AfericaoHidraulica::create($afericao_hidraulica_redimensionamento->attributes);
            
            $problema_redimensionamento['id_afericao'] = $red_db;
            ProblemaAfericao::create($problema_redimensionamento->attributes);
            
            $velocidade_redimensionamento['id_afericao']= $red_db;
            VelocidadeAfericao_100::create($velocidade_redimensionamento->attributes);

            $velocidade_percentimetro_redimensionamento['id_afericao'] = $red_db;
            VelocidadePercentimetro::create($velocidade_percentimetro_redimensionamento->attributes);

            if(!empty($canhao_final_redimensionamento)){
                $canhao_final_redimensionamento['id_afericao'] = $red_db;
                CanhaoFinal::create($canhao_final_redimensionamento->attributes);
            }
            
            if(!empty($pivo_conjugado_redimensionamento)){
                $pivo_conjugado_redimensionamento['id_afericao'] = $red_db;
                PivoConjugado::create($pivo_conjugado_redimensionamento->attributes);
            }

            $adutora_redimensionamento['id_afericao'] = $red_db;
            $adutora = Adutora::create($adutora_redimensionamento->attributes);
            $id_adutora = $adutora['id'];
            
            foreach ($bombeamentos_redimensionamento as $key => $bombeamento) {
                $bombeamento['id_adutora'] = $id_adutora;
                Bombeamento::create($bombeamento->attributes);
            }

            /*foreach ($trechos_adutora_redimensionamento as $key => $trecho) {
                $trecho['id_adutora'] = $id_adutora;
                TrechoAdutora::create($trecho->attributes);
            }*/

            foreach ($lances_redimensionamento as $key => $lance) {
                $lance['id_afericao'] = $red_db;
                $novoLance = Lance::create($lance->attributes);
                foreach ($emissores_redimensionamento as $key => $emissor) {
                    if($emissor['id_lance'] == $lance['id']){
                        $emissor['id_lance'] = $novoLance['id'];
                        Emissor::create($emissor->attributes);
                    }
                }
            }
            $infos_redimensionamento['id_afericao_redimensionamento'] = $red_db;
            InfoRedimensionamento::create($infos_redimensionamento);

            return $red_db;
        });

        return $novoId;
    }
}
