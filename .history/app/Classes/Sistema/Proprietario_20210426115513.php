<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proprietario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome', 'telefone', 'tipo_pessoa', 'documento', 'email'
    ];

    protected $dates =  ['deleted_at'];

    public function validate(Request $request)
}
