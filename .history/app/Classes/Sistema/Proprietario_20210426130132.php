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
    {
        $rules = [
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'tipo_pessoa' => 'required',
            'documento' => 'required'
        ];

        $messages = [
            'nome.required' => 'Preencha este Campo!',
            'email.required' => 'Preencha este Campo!',
            'telefone.required' => 

        ];
    }
}
