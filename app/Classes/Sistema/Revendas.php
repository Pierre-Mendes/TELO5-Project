<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revendas extends Model
{
    protected $table = 'revendas';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id', 'nome', 'telefone', 'email'
    ];
}
