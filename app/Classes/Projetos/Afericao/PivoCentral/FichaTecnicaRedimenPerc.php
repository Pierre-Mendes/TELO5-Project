<?php

namespace App\Classes\Projetos\Afericao\PivoCentral;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FichaTecnicaRedimenPerc extends Model
{
    protected $table = 'ficha_tecnica_redimen_perc';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'percentimetro', 'id_ficha_tecnica', 'projeto', 'medida', 
        'variacao'
    ];
}
