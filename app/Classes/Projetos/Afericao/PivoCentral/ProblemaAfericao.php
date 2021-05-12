<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProblemaAfericao extends Model
{

    protected $table = 'problemas_afericoes';

    use SoftDeletes;

    protected $dates =  ['deleted_at'];
    protected $fillable = [
        
        'id_afericao', 'problema_torre_central', 'problema_valvula_psi', 'problema_parte_aerea', 'problema_canhao_final', 'problema_casa_bomba',
        'problema_adutora', 'problema_chave_partida', 'problema_succao', 'problema_motor_principal', 'problema_bomba_principal',
        'problema_motor_auxiliar', 'problema_bomba_auxiliar'
    ];
}
