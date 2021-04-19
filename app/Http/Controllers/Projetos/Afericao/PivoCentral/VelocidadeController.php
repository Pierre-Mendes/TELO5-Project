<?php

namespace App\Http\Controllers\Projetos\Afericao\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Classes\Constantes\Notificacao;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Sistema\VelocidadeAfericao_100;
use App\Classes\Sistema\VelocidadePercentimetro;

class VelocidadeController extends Controller
{
    public function carregarTelaCadastroVelocidadeAfe($id_afericao){
        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        return view('projetos.afericao.pivoCentral.cadastro.cadastrarVelocidadeAfericao', compact('id_afericao'));        
    }

    public function cadastraVelocidadeAfe(Request $req){
        $velocidade = $req->all();
        $retorno = false;
        $retorno = DB::transaction(function () use ($velocidade){
            if (empty($velocidade['nao_aferiu']) && !isset($velocidade['nao_aferiu'])) {
                $velocidade['nao_aferiu'] = "0";
                VelocidadePercentimetro::create($velocidade);
            }
            AfericaoPivoCentral::find($velocidade['id_afericao'])->update(['velocidade_pendente' => 0]);
            VelocidadeAfericao_100::create($velocidade);
            return true;
        });
        if(!$retorno){
            Notificacao::gerarAlert('afericao.erro', 'afericao.erro_db', 'danger');
        }
        return redirect()->route('status_afericao', $velocidade['id_afericao']);
    }

    public function carregarTelaEditarVelocidadeAfe($id_afericao){
        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_afericao)){
            Notificacao::gerarAlert('afericao.aviso', 'afericao.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $velocidade = VelocidadeAfericao_100::select('velocidade_afericao_100.minuto01', 'velocidade_afericao_100.segundo01', 'velocidade_afericao_100.distancia01',
        'velocidade_afericao_100.minuto02', 'velocidade_afericao_100.segundo02', 'velocidade_afericao_100.distancia02', 
        'velocidade_afericao_100.minuto03', 'velocidade_afericao_100.segundo03', 'velocidade_afericao_100.distancia03',
        'velocidade_afericao_100.minuto04', 'velocidade_afericao_100.segundo04', 'velocidade_afericao_100.distancia04', 'velocidade_afericao_100.nao_aferiu',
        'AP.tipo_movimento',
        'AP.minuto_perc_01', 'AP.segundo_perc_01', 'AP.distancia_perc_01', 'AP.minuto_perc_02', 'AP.segundo_perc_02', 'AP.distancia_perc_02',
        'AP.minuto_perc_03', 'AP.segundo_perc_03', 'AP.distancia_perc_03', 'AP.minuto_perc_04', 'AP.segundo_perc_04', 'AP.distancia_perc_04',
        'AP.minuto_movi_01', 'AP.segundo_movi_01', 'AP.minuto_parado_01', 'AP.segundo_parado_01', 'AP.minuto_movi_02', 'AP.segundo_movi_02', 'AP.minuto_parado_02', 'AP.segundo_parado_02',
        'AP.minuto_movi_03', 'AP.segundo_movi_03', 'AP.minuto_parado_03', 'AP.segundo_parado_03', 'AP.minuto_movi_04', 'AP.segundo_movi_04', 'AP.minuto_parado_04', 'AP.segundo_parado_04')
        ->leftjoin('velocidade_afericao_percentimetro as AP', 'velocidade_afericao_100.id_afericao', 'AP.id_afericao')
        ->where('velocidade_afericao_100.id_afericao', $id_afericao)
        ->first();
        return view('projetos.afericao.pivoCentral.cadastro.editarVelocidadeAfericao', compact('id_afericao', 'velocidade'));        
    }

    public function editaVelocidadeAfe(Request $req){
        $velocidade = $req->all();
        // Verificando se já existe os dados com o id desta aferição
        if (VelocidadePercentimetro::find($velocidade['id_afericao']) != null) {
            // Verificando se o checkbox não foi clicado
            if (empty($velocidade['nao_aferiu'])){
                VelocidadePercentimetro::find($velocidade['id_afericao'])->update($velocidade);
                $velocidade['nao_aferiu'] = 0;
            // Caso foi clicado, setar os dados que existem na tabela desta aferição como NULL
            }else{
                $dados = [];
                $dados['tipo_movimento'] = $velocidade['tipo_movimento'];
                $dados['minuto_perc_01'] = $dados['segundo_perc_01'] = $dados['distancia_perc_01'] = $dados['segundo_perc_02'] = $dados['distancia_perc_02'] = $dados['minuto_perc_03'] = 
                $dados['segundo_perc_03'] = $dados['distancia_perc_03'] = $dados['minuto_perc_04'] = $dados['segundo_perc_04'] = $dados['distancia_perc_04'] = $dados['minuto_movi_01'] = 
                $dados['segundo_movi_01'] = $dados['minuto_parado_01'] = $dados['segundo_parado_01'] = $dados['minuto_movi_02'] = $dados['segundo_movi_02'] = $dados['minuto_parado_02'] = 
                $dados['segundo_parado_02'] = $dados['minuto_movi_03'] = $dados['segundo_movi_03'] = $dados['minuto_parado_03'] = $dados['segundo_parado_03'] = $dados['minuto_movi_04'] = 
                $dados['segundo_movi_04'] = $dados['minuto_parado_04'] = $dados['segundo_parado_04'] = null;
                VelocidadePercentimetro::find($velocidade['id_afericao'])->update($dados);
            }
        }else {
            // Verificando se o checkbox está desmarcado, para criar os dados
            if (empty($velocidade['nao_aferiu'])){ 
                VelocidadePercentimetro::create($velocidade);
                $velocidade['nao_aferiu'] = 0;
            }
        }
        VelocidadeAfericao_100::where("id_afericao", $velocidade['id_afericao'])->first()->update($velocidade);

        if($velocidade['botao'] == "sair"){
            return redirect()->route('status_afericao', $velocidade['id_afericao']);
        }else{
            return redirect()->back();
        }
    }
}
