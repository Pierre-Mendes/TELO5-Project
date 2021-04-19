<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use DB;
use Auth;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Constantes\Notificacao;

class MapaOriginalController extends Controller
{
    public function criarMapaOriginal($id_afericao){
        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $mapa_array = MapaOriginal::gerarMapaOriginal($id_afericao);

        $mapa = $mapa_array[1];

        if(!empty($mapa)){

            $result = false;
            $result = DB::transaction(function () use ($mapa) {
                MapaOriginal::where('id_afericao', $mapa[0]['id_afericao'])->delete();
                foreach($mapa as $linha_mapa){
                    MapaOriginal::create($linha_mapa);
                }
                return true;
            });
            return redirect()->route('visualizar_mapa_original', $mapa[0]['id_afericao']);
        }else{
            return redirect()->route('afericoes.pivo.central');
        }
    }


    public function getMapaOriginal($id_afericao){

        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }

        /* Verificando se a aferição esta pendente */
        if(AfericaoPivoCentral::verificarSeMapaOriginalEstaPendente($id_afericao)){
            Notificacao::gerarModal('afericao.aviso', 'afericao.naoCompleta', 'warning');
            return redirect()->route('afericoes.pivo.central');
        }

        $mapa = MapaOriginal::join('emissores as E', 'E.id', 'mapa_originals.id_emissor')
            ->join('lances as L', 'L.id', 'E.id_lance')
            ->where('mapa_originals.id_afericao', $id_afericao)
            ->whereNull('E.deleted_at')
            ->whereNull('L.deleted_at')
            ->orderby('L.numero_lance', 'asc')
            ->orderby('E.numero', 'asc')
            ->get();
        if($mapa->count() > 0){
            $afericao = AfericaoPivoCentral::select('tem_balanco', 'numero_lances', 'tipo_projeto')->where('id', $id_afericao)->first();
            $laminas_medias = array();
            $laminas = array();
            $emissores = array();
            foreach($mapa as $index => $linha){
                array_push($laminas, $linha['lamina_aplicada']);
                array_push($laminas_medias, $linha['lamina_media']);
                array_push($emissores, ($index + 1));
            }
            $laminas = json_encode($laminas);
            $laminas_medias = json_encode($laminas_medias);
            $emissores = json_encode($emissores);

            return view("projetos.afericao.pivoCentral.relatorio.mapaOriginal.mostrarMapaOriginal", compact('mapa', 'laminas_medias', 'laminas', 'emissores', 'id_afericao', 'afericao'));
        }else{
            return redirect()->route('calcular_mapa_original', $id_afericao);
        }
    }

    public function editareMapaOriginal(Request $req){
        $emissor = $req->all();
        Emissor::find($emissor['id_emissor'])->update($emissor);
        return redirect()->route('calcular_mapa_original', $emissor['id_afericao']);
    }

}
