<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bocal extends Model
{
    protected $table = 'bocais';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_fabricante', 'fabricante', 'modelo',  'nome', 'vazao', 'intervalo_trabalho', 'vazao_10_psi', 'plug', 'tipo'
    ];
}
