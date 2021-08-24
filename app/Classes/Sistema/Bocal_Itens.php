<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bocal_Itens extends Model
{
    protected $table = 'bocal_itens';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id_bocal', 'id', 'nome', 'vazao', 'intervalo_trabalho'
    ];

}
