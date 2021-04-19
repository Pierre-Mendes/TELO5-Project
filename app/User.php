<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'cidade', 'estado', 'pais', 'rua', 'cep', 'telefone', 'configuracao_idioma', 'tipo_usuario', 'email', 'password', 'situacao', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates =  ['deleted_at'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getListaDePapeis(){
        $papeis = [
            ['chave'=>'0','valor'=>'usuarios.administrador'],
            ['chave'=>'1','valor'=>'usuarios.gerente'],
            ['chave'=>'2','valor'=>'usuarios.supervisor'],
            ['chave'=>'3','valor'=>'usuarios.consultor'],
            ['chave'=>'4','valor'=>'usuarios.assistente'],
        ];
        return $papeis;
    }

    public static function getListaDeIdiomas(){
        $idiomas = [
            ['chave'=>'0','valor'=>'pt-br'],
            ['chave'=>'1','valor'=>'en'],
            ['chave'=>'2','valor'=>'es'],
            /*
            ['chave'=>'3','valor'=>'ru'],
            ['chave'=>'4','valor'=>'ar'],
            ['chave'=>'4','valor'=>'tr']
            */
        ];
        return $idiomas;
    }

    public static function validaEmail($email, $id = null){
        $user = User::select('id')->where('email', $email)->first();
        if(empty($user)){
            return true;
        }else if($id != null && $user['id'] == $id){
            return true;
        }else{
            return false;
        }
    }

    public static function verificarUserAtivo($email){
        $user = User::select('situacao')->where('email', $email)->first();
        if(empty($user) || $user['situacao'] == 0 ){
            return false;
        }else{
            return true;
        }
    }
    

}
