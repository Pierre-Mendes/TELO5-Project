<?php

namespace App\Classes\Sistema;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class VelocidadeAfericao_100 extends Model
{
    protected $table = 'velocidade_afericao_100';
    use softDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_afericao', 'minuto01', 'segundo01', 'distancia01', 'minuto02', 'segundo02', 'distancia02',
        'minuto03', 'segundo03', 'distancia03', 'minuto04', 'segundo04', 'distancia04', 'nao_aferiu'
    ];

}
