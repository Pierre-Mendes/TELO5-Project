<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Constantes\Notificacao;
use App\Classes\Projetos\Afericao\PivoCentral\RelatorioVelocidade;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\RedimensionamentoPercentimetro;
use App\Classes\Projetos\Afericao\PivoCentral\Bombeamento;
use App\Classes\Projetos\Afericao\PivoCentral\CustoLaminaAfericao;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use DB;
use Auth;


class RelatorioVelocidadeController extends Controller
{
    public function getRelatorioVelocidade($id_afericao){
        $velocidade_afericao = RedimensionamentoPercentimetro::geraRedimensionamentoPercentimetro($id_afericao);
        //Arrays para o gráfico
        $projetada = [];
        $aferida   = [];
        foreach($velocidade_afericao['tabela_resultante'] as $key => $dado){            
            if (substr($key, 0, 7) == 'projeto') array_push($projetada, $dado);
            if (substr($key, 0, 6) == 'medido') array_push($aferida, $dado);
        }
        sort($projetada);
        //rsort($aferida);
        sort($aferida);
        $projetada = json_encode($projetada);
        $aferida   = json_encode($aferida);

        $afericao_pivo_central = AfericaoPivoCentral::where('id', $id_afericao)->first();
        $bombeamento = Bombeamento::join('cabecalho_bombeamentos AS CB', 'CB.id','bombeamentos.id_bombeamento')->where('CB.id_afericao', $id_afericao)->first();        
        $mapa_original = MapaOriginal::gerarMapaOriginal($id_afericao, 2);
        $mapa_original = $mapa_original[0];
        
        //Recebendo os dados para funcionamento do pivô
        $dados_custo_lamina = CustoLaminaAfericao::calculaCustoLamina($id_afericao);
        $velocidade_pivo = [];

        //Função de truncar
        function truncar($val, $f="0")
        {
            if(($p = strpos($val, '.')) !== false) {
                $val = floatval(substr($val, 0, $p + 1 + $f));
            }
            return $val;
        }

        //calculos para a ultima tabela
        for ($i = 100; $i>=5; $i=$i-5){
            $velocidade_pivo[$i]['volta'] = truncar(($mapa_original['tempo_a_100'] * 100 / $i)) + ((($mapa_original['tempo_a_100'] * 100 / $i) - (truncar($mapa_original['tempo_a_100'] * 100 / $i))) * 60 / 100);
            $velocidade_pivo[$i]['volta_1_2'] = truncar((($mapa_original['tempo_a_100'] * 100 / $i)) / 2) + (((($mapa_original['tempo_a_100'] * 100 / $i) / 2) - (truncar((($mapa_original['tempo_a_100'] * 100 / $i) / 2)))) * 60 / 100);
            $velocidade_pivo[$i]['volta_1_4'] = truncar((($mapa_original['tempo_a_100'] * 100 / $i)) / 4) + (((($mapa_original['tempo_a_100'] * 100 / $i) / 4) - (truncar((($mapa_original['tempo_a_100'] * 100 / $i) / 4)))) * 60 / 100);
            $velocidade_pivo[$i]['lamina_mm'] = $mapa_original['tempo_irri_ponto_min'] * 100 / $i;
            $velocidade_pivo[$i]['estimativa_custo_eletrico'] = $dados_custo_lamina['eletrico']['custo_mm_ha'] * $velocidade_pivo[$i]['lamina_mm'];
            if (array_key_exists('diesel', $velocidade_pivo[$i]))
            $velocidade_pivo[$i]['estimativa_custo_diesel'] = $dados_custo_lamina['diesel']['custo_anual_mm_ha'] * $velocidade_pivo[$i]['lamina_mm'];
        }

        //Retornando a view com os dados necessários
        return view('projetos.afericao.pivoCentral.relatorio.relatorioVelocidade.gerenciarRelatorio', compact('velocidade_afericao', 'projetada', 'aferida', 'mapa_original', 'dados_custo_lamina', 'velocidade_pivo'));
    }
}