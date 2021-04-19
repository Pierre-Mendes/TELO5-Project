<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserSuperior extends Model
{
    protected $fillable = [
       'id_usuario', 'id_superior'
    ];

    protected $table = 'usuario_superiores';

    public static function inserirSuperior($id_usuario, $id_superior){
        
        $count = UserSuperior::where('id_usuario', $id_usuario)->count();
        $usuario_sup = array();
        $usuario_sup['id_usuario'] = $id_usuario;
        $usuario_sup['id_superior'] = $id_superior;
        if($count == 0){
            UserSuperior::create($usuario_sup);
        }else{
            UserSuperior::where('id_usuario', $id_usuario)->update($usuario_sup);
        }
    }

    public static function getAssistentesDoUsuario($id_superior){
        $assistentes = User::select('users.nome', 'users.id')
            ->join('usuario_superiores as US', 'US.id_usuario', 'users.id')
            ->where('US.id_superior', $id_superior)->where('users.tipo_usuario', 4)->get();
        return $assistentes;
    }
}
