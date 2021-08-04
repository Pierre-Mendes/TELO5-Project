<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fichaTecnica extends Model
{
    protected $table = 'ficha_tecnica';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id', 'id_afericao', 'txt_observacoes', 'txt_teste_velocidade', 
        'txt_uniformidade', 'txt_conclusao', 'versoes'
    ];
}
