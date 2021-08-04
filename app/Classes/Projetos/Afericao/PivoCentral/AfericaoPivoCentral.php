<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AfericaoPivoCentral extends Model
{
    protected $table = 'afericoes_pivos_centrais';

    use SoftDeletes;

    protected $dates =  ['deleted_at'];

    protected $fillable = [
        
        'id_fazenda', 'data_afericao',
        'tempo_funcionamento', 'horimetro', 'marca_modelo_pivo', 
        'ano_montagem', 'giro_equipamento', 
        'tipo_painel', 'lamina_anual', 'custo_medio', 'marca_modelo_emissores', 'rodado', 
        'revestimento', 'pendural',
        'custo_medio', 'modelo_equipamento', 'defletor', 'altura_pivo', 'valv_reguladoras', 
        'altura_emissores',  'numero_lances', 'nome_pivo', 'id_usuario', 'mapa_bocais_pendente', 
        'adutora_pendente', 'bombeamento_pendente', 'velocidade_pendente', 'tem_balanco', 
        'ativa', 'tipo_projeto', 'versoes'
    ];

    /**
     * Retorna null se o usuário não possui aferições pendentes
     * Retona a data e o nome da última aferição pendente do usuário
     */
    public static function verificarExistenciaAfericoesPendentes($id_user){
        $pendente = AfericaoPivoCentral::select('afericoes_pivos_centrais.id', 'afericoes_pivos_centrais.data_afericao as data', 'F.nome as nome_fazenda', 'F.id as fazenda_id')
            ->join('fazendas as F', 'F.id', 'afericoes_pivos_centrais.id_fazenda')
            ->where('afericoes_pivos_centrais.id_usuario', $id_user)
            ->where('afericoes_pivos_centrais.ativa', 1)
            ->where('afericoes_pivos_centrais.tipo_projeto', 'A')
            ->where(function($query) {
                $query->orwhere( 'afericoes_pivos_centrais.mapa_bocais_pendente', 1);
                $query->orwhere( 'afericoes_pivos_centrais.adutora_pendente', 1);
                $query->orwhere( 'afericoes_pivos_centrais.bombeamento_pendente', 1);
                $query->orwhere( 'afericoes_pivos_centrais.velocidade_pendente', 1);
            })
            ->first();
        if(empty($pendente) || $pendente->count() == 0){
            return null;
        }else{
            return $pendente;
        }
    }

    public static function verificarSeMapaOriginalEstaPendente($id_afericao){
        $afericao = AfericaoPivoCentral::find($id_afericao);
        if(isset($afericao) && $afericao['mapa_bocais_pendente'] == 0){
            return false;
        }else{
            return true;
        }
    }


    public static function verificarSeAfericaoPertenceFazendaSelecionada($id_afericao){
        $afericao = AfericaoPivoCentral::find($id_afericao);
        if(!empty($afericao['id_fazenda']) && session()->has('fazenda') && $afericao['id_fazenda'] == session()->get('fazenda')['id']){
            return true;
        }
        return false;
    }
}
