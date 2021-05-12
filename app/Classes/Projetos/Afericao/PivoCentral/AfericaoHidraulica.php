<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AfericaoHidraulica extends Model
{
    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
       'id_afericao', 'pressao_centro', 'pressao_ponta', 
       'rugosidade', 'altitude_centro'
       ,'altitude_mais_alto', 'altitude_mais_baixo', 'latitude', 'longitude'
    ];
}
