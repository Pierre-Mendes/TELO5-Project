<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use DB;
use Auth;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Sistema\Pivo;
use App\Classes\Constantes\Notificacao;
use Redirect, Response;

class MapaOriginalController extends Controller
{
    public function createOriginalMap($id_afericao)
    {
        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $mapa_array = MapaOriginal::gerarMapaOriginal($id_afericao);

        $mapa = $mapa_array[1];
        if (!empty($mapa)) {

            $result = false;
            $result = DB::transaction(function () use ($mapa) {
                MapaOriginal::where('id_afericao', $mapa[0]['id_afericao'])->delete();
                foreach ($mapa as $linha_mapa) {
                    MapaOriginal::create($linha_mapa);
                }
                return true;
            });
            return redirect()->route('originalMap_manager', $mapa[0]['id_afericao']);
        } else {
            return redirect()->route('gauging_manager');
        }
    }

    public function managerOriginalMap($id_afericao)
    {

        if (!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)) {
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }

        /* Verificando se a aferição esta pendente */
        if (AfericaoPivoCentral::verificarSeMapaOriginalEstaPendente($id_afericao)) {
            Notificacao::gerarModal('afericao.aviso', 'afericao.naoCompleta', 'warning');
            return redirect()->route('gauging_manager');
        }

        $mapa = MapaOriginal::join('emissores as E', 'E.id', 'mapa_originals.id_emissor')
            ->join('lances as L', 'L.id', 'E.id_lance')
            ->where('mapa_originals.id_afericao', $id_afericao)
            ->whereNull('E.deleted_at')
            ->whereNull('L.deleted_at')
            ->orderby('L.numero_lance', 'asc')
            ->orderby('E.numero', 'asc')
            ->paginate(100);
        if ($mapa->count() > 0) {
            
            $afericao = AfericaoPivoCentral::select('tem_balanco', 'numero_lances', 'tipo_projeto')->where('id', $id_afericao)->first();
            $laminas_medias = array();
            $laminas = array();
            $emissores = array();
            foreach ($mapa as $index => $linha) {
                array_push($laminas, $linha['lamina_aplicada']);
                array_push($laminas_medias, $linha['lamina_media']);
                array_push($emissores, ($index + 1));
            }
            $laminas = json_encode($laminas);
            $laminas_medias = json_encode($laminas_medias);
            $emissores = json_encode($emissores);

            return view("projetos.afericao.pivoCentral.relatorio.mapaOriginal.mostrarMapaOriginal", compact('mapa', 'lances', 'laminas_medias', 'laminas', 'emissores', 'id_afericao', 'afericao'));
        } else {
            return redirect()->route('originalMap_create', $id_afericao);
        }
    }

    public function originalMapEdit(Request $req)
    {
        $emissores = $req->all();
        // dd($emissores);
        for ($i = 1; $i <= $emissores['numero_lances']; $i++) {
            $id_emissor = $emissores['id_emissores_' . $i];
            $emissor = array(
                "_token" => $emissores['_token'],
                'saida_1' => $emissores['bocal_1_' . $i],
                'saida_2' => $emissores['bocal_2_' . $i],
                'espacamento' => $emissores['espacamento_' . $i],
                'psi' => $emissores['valvula_reguladora_' . $i],
                'tipo_valvula' => $emissores['tipo_valvula_' . $i],
                'emissor' => $emissores['fabricante_' . $i]
            );
            Emissor::find($id_emissor)->update($emissor);

            unset($emissor);
        }
        // $ret = Notificacao::gerarAlert('afericao.sucesso', 'afericao.edicao_sucesso', 'success');
        return response()->json();
    }

    public function createNewSpan($id_afericao)
    {
        $lances = Lance::select('id', 'numero_lance')
            ->where('id_afericao', $id_afericao)
            ->orderby('numero_lance')
            ->get();

        return view("projetos.afericao.pivoCentral.relatorio.mapaOriginal.cadastrarNovoLance", compact('id_afericao', 'lances'));
    }

    public function saveNewSpan(Request $req)
    {

        $lance = $req->all();
        $id_afericao = $lance['id_afericao'];
        $inicio = $lance['lance_relativo'] + $lance['posicao_relativa'];

        $ultima_pos = Lance::where('id_afericao', $lance['id_afericao'])
                            ->max('numero_lance');

        while ($ultima_pos >= $inicio) {
            Lance::where('numero_lance', $ultima_pos)
                ->where('id_afericao', $lance['id_afericao'])
                ->update(['numero_lance' => ($ultima_pos + 1)]);
            $ultima_pos = $ultima_pos - 1;
        }
        $lance['numero_lance'] =  $inicio;
        $lance_criado = Lance::create($lance);
        $id_lance = $lance_criado['id'];
        $emissores = $lance_criado['numero_emissores'];
        return view("projetos.afericao.pivoCentral.relatorio.mapaOriginal.cadastrarNovoEmissor", compact('id_lance', 'emissores', 'id_afericao'));
    }

    public function saveNewIssuer(Request $req)
    {
        $dados = $req->all();
        $id_afericao = $dados['id_afericao'];
        $id_lance['comprimento'] = $dados['comprimento'];
        $dados['emissores'];
        $lanceDB = Lance::find($dados['id_lance']);
        $emissores = Emissor::where('id_lance', $dados['id_lance'])->orderBy('numero', 'asc')->get();
        if ($emissores->count() == 0) {
            //Cadastrar emissor
            for ($i = 0; $i < count($dados['emissores']); $i++) {
                $emissor = [];
                $emissor['numero'] = $dados['numero_emissores'][$i];
                $emissor['saida_1'] = $dados['bocal_1'][$i];
                if (empty($dados['bocal_2'][$i])) {
                    $emissor['saida_2'] = 0;
                } else {
                    $emissor['saida_2'] = $dados['bocal_2'][$i];
                }
                $emissor['espacamento'] = $dados['espacamento'][$i];
                $emissor['diametro'] = $lanceDB['diametro'];
                $emissor['emissor'] = $dados['emissor'][$i];
                $emissor['tipo_valvula'] = $dados['tipo_valvula'][$i];
                $emissor['psi'] = $dados['valvula_reguladora'][$i];
                $emissor['id_lance'] = $lanceDB['id'];
                Emissor::create($emissor);
            }
        }
        return redirect()->route('originalMap_manager', $id_afericao);
    }
}
