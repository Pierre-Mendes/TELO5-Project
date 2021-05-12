<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class PivoConjugado extends Model
{

    protected $table = 'pivos_conjugados';

    use SoftDeletes;

    protected $dates =  ['deleted_at'];



    protected $fillable = [
        'id_afericao', 'area_pivo_01', 'area_pivo_02', 'area_pivo_03', 'area_pivo_04', 
        'vazao_pivo_01', 'vazao_pivo_02', 'vazao_pivo_03', 'vazao_pivo_04', 
    ];
}
