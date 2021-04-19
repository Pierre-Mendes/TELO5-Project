<?php

namespace App\Classes\Sistema;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pivo extends Model
{
    protected $table = 'pivos';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'fabricante' , 'nome', 'espacamento', 'saida_1_inicial', 'saida_2_inicial', 'saida_3_inicial', 'saida_1_intermediario', 'saida_2_intermediario', 'saida_3_intermediario'
    ];
}
