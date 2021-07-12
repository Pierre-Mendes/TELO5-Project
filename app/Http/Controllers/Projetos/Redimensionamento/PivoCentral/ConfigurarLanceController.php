<?php

namespace App\Http\Controllers\Projetos\Redimensionamento\PivoCentral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use App\Classes\Projetos\Afericao\PivoCentral\Lance;
use App\Classes\Projetos\Afericao\PivoCentral\Emissor;
use App\Classes\Projetos\Afericao\PivoCentral\MapaOriginal;
use App\Classes\Constantes\Notificacao;
use DB;

class ConfigurarLanceController extends Controller
{
    
    public function carregarTelaConfigurarPivo($id_redimensionamento){
        if(!AfericaoPivoCentral::verificarSeAfericaoPertenceFazendaSelecionada($id_redimensionamento)){
            Notificacao::gerarAlert('afericao.aviso', 'redimensionamento.selecioneFazendaAfericao', 'warning');
            return redirect()->route('dashboard');
        }
        $dados_afericao = AfericaoPivoCentral::select(
            'afericoes_pivos_centrais.tem_balanco', 'afericoes_pivos_centrais.numero_lances', 
            'P.espacamento', 'afericoes_pivos_centrais.marca_modelo_emissores as emissor', 'afericoes_pivos_centrais.tipo_projeto')
            ->join('pivos as P', 'afericoes_pivos_centrais.marca_modelo_pivo', 'P.id' )
            ->where('afericoes_pivos_centrais.id', $id_redimensionamento)
            ->first();
        $lances = Lance::where('id_afericao', $id_redimensionamento)->orderby('numero_lance')->get();
        $tem_balanco = $dados_afericao['tem_balanco'];
        $numero_lances = $dados_afericao['numero_lances'];
        $espacamento = $dados_afericao['espacamento'];
        $tipo_projeto = $dados_afericao['tipo_projeto'];
        $emissor = $dados_afericao['emissor'];
        return view('projetos.redimensionamento.configuracaoPivo.configurarLances', compact('lances', 'tem_balanco', 'numero_lances', 'id_redimensionamento', 'espacamento', 'emissor', 'tipo_projeto'));
    }

    public function adicionarLance(Request $req){
        $dados = $req->all();
        $comprimentoNovoLance = 0;
        $emissores = [];

        $dados['lance_anterior'] = $dados['lance_relativo'];
        if($dados['posicao_relativa'] == 0){
            $dados['lance_anterior']-=1;
        }
        
        for($i = 0; $i < $dados['numero_emissores']; $i++){
            $comprimentoNovoLance+=$dados['espacamento'][$i];
            $emissor = [
                'numero' => $dados['numero_emissor'][$i],
                'saida_1' => $dados['bocal_1'][$i],
                'saida_2' => (isset($dados['bocal_2'][$i]) ? $dados['bocal_2'][$i] : 0.0 ),
                'espacamento' => $dados['espacamento'][$i],
                'diametro' => $dados['diametro'],
                'emissor' => $dados['emissor'][$i],
                'tipo_valvula' => $dados['tipo_valvula'][$i],
                'psi' => $dados['valvula_reguladora'][$i],
            ];
            array_push($emissores, $emissor);
        }


        $lance = [
            'id_afericao' => $dados['id_afericao'],
            'numero_lance' => $dados['lance_anterior'] + 1,
            'numero_tubos' => $dados['numero_tubos'],
            'diametro' => $dados['diametro'],
            'valvula_reguladora' => $dados['valvula_reguladora_lance'],
            'numero_emissores' => $dados['numero_emissores'],
            'motorredutor' => $dados['motorredutor'],
            'comprimento' => number_format($comprimentoNovoLance, 2),
        ];

        $status_transacao = false;
        $status_transacao = DB::transaction(function () use ($dados, $lance, $emissores){
            
            //Adicionando +1 no número dos lances seguintes
            Lance::
                where('id_afericao', $dados['id_afericao'])->
                where('numero_lance', '>', $dados['lance_anterior'])->
                increment('numero_lance', 1);

            //Criando o novo lance
            $lance = Lance::create($lance);
            
            //Criando os emissores
            foreach($emissores as $emissor){
                $emissor['id_lance'] = $lance['id'];
                Emissor::create($emissor);
            }

            //Adicionando +1 no número de lances registrado na afericao
            AfericaoPivoCentral::find($dados['id_afericao'])->increment('numero_lances', 1);

            //Removendo o mapa original cadastrado
            MapaOriginal::where('id_afericao', $dados['id_afericao'])->delete();

            return true;
        });

        if($status_transacao){
            Notificacao::gerarAlert('afericao.sucesso', 'redimensionamento.adicionadoSucesso', 'success');
        }else{
            Notificacao::gerarAlert('redimensionamento.falha', 'redimensionamento.falhaInsercao', 'danger');
        }
        return redirect()->back();
    }

    public function removerLance(Request $req){
        $dados = $req->all();
        $statusTransacao = false;
        $status_transacao = DB::transaction(function () use ($dados){
            $lanceRemovido = Lance::find($dados['id_lance']);
            $numeroLanceRemovido = $lanceRemovido['numero_lance'];
            
            //Removendo o lance
            $lanceRemovido->delete();

            //Removendo os emissores do lance
            Emissor::where('id_lance', $dados['id_lance'])->delete();

            //Atualizando o número dos lances seguintes
            Lance::
                where('id_afericao', $dados['id_afericao'])->
                where('numero_lance', '>', $numeroLanceRemovido)->
                decrement('numero_lance', 1);
            
            //Atualizando os dados da aferição
            AfericaoPivoCentral::find($dados['id_afericao'])->decrement('numero_lances', 1);

            //Removendo o mapa original cadastrado
            MapaOriginal::where('id_afericao', $dados['id_afericao'])->delete();

            return true;
        });
        if($status_transacao){
            Notificacao::gerarAlert('afericao.sucesso', 'redimensionamento.removidoSucesso', 'success');
        }else{
            Notificacao::gerarAlert('redimensionamento.falha', 'redimensionamento.falhaRemocao', 'danger');
        }
        return redirect()->back();
    }

    public function getInformacoesLance(Request $req){
        $dados = $req->all();
        $lance = Lance::find($dados['id_lance']);
        $emissores= Emissor::where('id_lance', $dados['id_lance'])->orderby('numero')->get();
        //dd($lance);
        return view('projetos.redimensionamento.configuracaoPivo.editarLance', compact('dados', 'emissores', 'lance'));
    }

    public function atualizarLance(Request $req){
        //dd($req->all());
        $dados = $req->all();
        $id_afericao = $dados['id_afericao'];
        $listaEmissoresParaEditar = [];
        $listaEmissoresParaCriar = [];
        $id_lance = $dados['id_lance'];
        $diferenca = $dados['numero_original_emissores'] - $dados['numero_emissores'];
        $novoNumeroEmissores = $dados['numero_emissores'];
        $comprimento = 0;
        $lance = [];

        //Cria os objetos para atualizar os atuais e cria os novos
        for ($i=0; $i < $dados['numero_emissores']; $i++) { 
            $comprimento += floatval($dados['espacamento'][$i]);
            $emissor = [];
            $emissor['numero'] = $dados['numero_emissor'][$i];
            $emissor['espacamento'] = $dados['espacamento'][$i];
            $emissor['diametro'] = $dados['diametro'];
            $emissor['saida_1'] = $dados['bocal_1'][$i];
            $emissor['saida_2'] = (empty($dados['bocal_2'][$i])) ? 0 : $dados['bocal_2'][$i];
            $emissor['emissor'] = $dados['emissor'][$i];
            $emissor['tipo_valvula'] = $dados['tipo_valvula'][$i];
            $emissor['psi'] = $dados['valvula_reguladora'][$i];
            $emissor['id_lance'] = $dados['id_lance'];
            if($i < $dados['numero_original_emissores']){
                $emissor['id'] = $dados['id_emissor'][$i];
                array_push($listaEmissoresParaEditar, $emissor);
            }else{
                array_push($listaEmissoresParaCriar, $emissor);
            }
        }

        //Setando as informações do lance
        $lance['numero_tubos'] = $dados['numero_tubos'];
        $lance['numero_emissores'] = $dados['numero_emissores'];
        $lance['diametro'] = $dados['diametro'];
        $lance['valvula_reguladora_lance'] = $dados['valvula_reguladora'];
        $lance['comprimento'] = $comprimento;
        $lance['motorredutor'] = $dados['motorredutor'];

        $transacao = false;
        $transacao = DB::transaction(function () use($listaEmissoresParaCriar, $listaEmissoresParaEditar, $id_lance, $diferenca, $lance, $id_afericao) {

            foreach($listaEmissoresParaEditar as $emissor){
                Emissor::find($emissor['id'])->update($emissor);
            }
            foreach($listaEmissoresParaCriar as $emissor){
                Emissor::create($emissor);
            }
            if($diferenca > 0){
                Emissor::where('id_lance', $id_lance)->orderby('numero', 'desc')->limit($diferenca)->delete();
            }
            Lance::find($id_lance)->update($lance);
            //Removendo o mapa original cadastrado
            MapaOriginal::where('id_afericao', $id_afericao)->delete();
            
            return true;
        });
        //dump($transacao, $id_lance);
        if($transacao){
            Notificacao::gerarAlert('afericao.sucesso', 'redimensionamento.atualizacaoSucesso', 'success');
        }else{
            Notificacao::gerarAlert('redimensionamento.falha', 'redimensionamento.falhaAtualizacao', 'danger');
        }
        return redirect()->route('configurarPivoRedimensionamento', $dados['id_afericao']);
    }
}
