<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Classes\Projetos\Afericao\PivoCentral\AfericaoPivoCentral;
use Auth;


class Fazenda extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'nome', 'cidade' ,'estado', 'pais', 'latitude', 'longitude', 'altitude', 'id_proprietario', 'id_consultor','ativa'
    ];

    protected $dates =  ['deleted_at'];


    public static function getFazendasUsuario($nopage = 0){
        //Tipo de usuario
        $tipo_usuario = (Auth::user()->tipo_usuario);
        $fazendas = array();
        $id_usuario = Auth::user()->id;
        if ($nopage == 0){
            switch($tipo_usuario){
                case 0:{ //Admin
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id');
                    break;
                }case 1:{ //Gerente
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                        join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->
                        where('US.id_superior', $id_usuario);
                    break;
                }case 2:{ //Supervisor
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                        join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->
                        where('US.id_superior', $id_usuario);
                    break;
                }case 3:{ //Consultor
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                        where('fazendas.id_consultor', $id_usuario);
                    break;
                }case 4:{ //Assistente
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    join('usuarios_fazendas as UF', 'fazendas.id', 'UF.id_fazenda')->
                    where('UF.id_usuario', $id_usuario);
                    break;
                }default: {
                    break;
                }
            }
        } else {
            switch($tipo_usuario){
                case 0:{ //Admin
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->paginate($nopage);
                    break;
                }case 1:{ //Gerente
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                        join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->
                        where('US.id_superior', $id_usuario)
                        ->paginate($nopage);
                    break;
                }case 2:{ //Supervisor
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                        join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->
                        where('US.id_superior', $id_usuario)
                        ->paginate($nopage);
                    break;
                }case 3:{ //Consultor
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                        join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                        where('fazendas.id_consultor', $id_usuario)
                        ->paginate($nopage);
                    break;
                }case 4:{ //Assistente
                    $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    join('usuarios_fazendas as UF', 'fazendas.id', 'UF.id_fazenda')->
                    where('UF.id_usuario', $id_usuario)
                    ->paginate($nopage);
                    break;
                }default: {
                    break;
                }
            }
        }


        return $fazendas;
    }

    public static function getFazendasUsuarioComFiltro($filtro){
        //Tipo de usuario
        $tipo_usuario = (Auth::user()->tipo_usuario);
        $fazendas = array();
        $id_usuario = Auth::user()->id;
        switch($tipo_usuario){
            case 0:{ //Admin
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')
                    ->where(function ($query) use ($filtro){
                        //Busca pelo nome
                        if(!empty($filtro['nome'])){
                            $query->where('fazendas.nome', 'like', '%'.$filtro['nome'].'%');
                        }
                        //Busca pelo tipo de usuário
                        if(!empty($filtro['proprietario'])){
                            $query->where('P.nome', 'like', '%'.($filtro['proprietario']).'%');
                        }
                        //Busca apenas ativos
                        if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                            $query->where('fazendas.ativa', 1);
                        }
                        //Busca apenas inativos
                        if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                            $query->where('fazendas.ativa',  0);
                        }
                    })
                    ->paginate(30);
                break;
            }case 1:{ //Gerente
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->
                    where('US.id_superior', $id_usuario)
                    ->where(function ($query) use ($filtro){
                        //Busca pelo nome
                        if(!empty($filtro['nome'])){
                            $query->where('fazendas.nome', 'like', '%'.$filtro['nome'].'%');
                        }
                        //Busca pelo tipo de usuário
                        if(!empty($filtro['proprietario'])){
                            $query->where('P.nome', 'like', '%'.($filtro['proprietario']).'%');
                        }
                        //Busca apenas ativos
                        if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                            $query->where('fazendas.ativa', 1);
                        }
                        //Busca apenas inativos
                        if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                            $query->where('fazendas.ativa',  0);
                        }
                    })
                    ->paginate(30);
                break;
            }case 2:{ //Supervisor
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->
                    where('US.id_superior', $id_usuario)
                    ->where(function ($query) use ($filtro){
                        //Busca pelo nome
                        if(!empty($filtro['nome'])){
                            $query->where('fazendas.nome', 'like', '%'.$filtro['nome'].'%');
                        }
                        //Busca pelo tipo de usuário
                        if(!empty($filtro['proprietario'])){
                            $query->where('P.nome', 'like', '%'.($filtro['proprietario']).'%');
                        }
                        //Busca apenas ativos
                        if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                            $query->where('fazendas.ativa', 1);
                        }
                        //Busca apenas inativos
                        if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                            $query->where('fazendas.ativa',  0);
                        }
                    })
                    ->paginate(30);
                break;
            }case 3:{ //Consultor
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    where('fazendas.id_consultor', $id_usuario)
                    ->where(function ($query) use ($filtro){
                        //Busca pelo nome
                        if(!empty($filtro['nome'])){
                            $query->where('fazendas.nome', 'like', '%'.$filtro['nome'].'%');
                        }
                        //Busca pelo tipo de usuário
                        if(!empty($filtro['proprietario'])){
                            $query->where('P.nome', 'like', '%'.($filtro['proprietario']).'%');
                        }
                        //Busca apenas ativos
                        if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                            $query->where('fazendas.ativa', 1);
                        }
                        //Busca apenas inativos
                        if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                            $query->where('fazendas.ativa',  0);
                        }
                    })
                    ->paginate(30);
                break;
            }case 4:{ //Assistente
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                join('usuarios_fazendas as UF', 'fazendas.id', 'UF.id_fazenda')->
                where('UF.id_usuario', $id_usuario)
                ->where(function ($query) use ($filtro){
                    //Busca pelo nome
                    if(!empty($filtro['nome'])){
                        $query->where('fazendas.nome', 'like', '%'.$filtro['nome'].'%');
                    }
                    //Busca pelo tipo de usuário
                    if(!empty($filtro['proprietario'])){
                        $query->where('P.nome', 'like', '%'.($filtro['proprietario']).'%');
                    }
                    //Busca apenas ativos
                    if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                        $query->where('fazendas.ativa', 1);
                    }
                    //Busca apenas inativos
                    if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                        $query->where('fazendas.ativa',  0);
                    }
                })
                ->paginate(30);
                break;
            }default: {

                break;
            }
        }
        return $fazendas;
    }

    public static function getFazendasAtivasUsuario(){
        //Tipo de usuario
        $tipo_usuario = (Auth::user()->tipo_usuario);
        $fazendas = array();
        $id_usuario = Auth::user()->id;
        switch($tipo_usuario){
            case 0:{ //Admin
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->where('fazendas.ativa', 1)->paginate(30);
                break;
            }case 1:{ //Gerente
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->where('fazendas.ativa', 1)->
                    where('US.id_superior', $id_usuario)
                    ->paginate(30);
                break;
            }case 2:{ //Supervisor
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                    join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')->where('fazendas.ativa', 1)->
                    where('US.id_superior', $id_usuario)
                    ->paginate(30);
                break;
            }case 3:{ //Consultor
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                    join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->where('fazendas.ativa', 1)->
                    where('fazendas.id_consultor', $id_usuario)
                    ->paginate(30);
                break;
            }case 4:{ //Assistente
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'cidade', 'estado', 'pais', 'P.nome as nome_prop', 'ativa')->
                join('proprietarios as P', 'fazendas.id_proprietario', '=', 'P.id')->
                join('usuarios_fazendas as UF', 'fazendas.id', 'UF.id_fazenda')->
                where('UF.id_usuario', $id_usuario)->where('fazendas.ativa', 1)
                ->paginate(30);
                break;
            }default: {

                break;
            }
        }
        return $fazendas;
    }

    public static function getResumoFazendasAtivasUsuario(){
        //Tipo de usuario
        $tipo_usuario = (Auth::user()->tipo_usuario);
        $fazendas = array();
        $id_usuario = Auth::user()->id;
        switch($tipo_usuario){
            case 0:{ //Admin
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'P.nome as proprietario')
                    ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                    ->where('fazendas.ativa', 1)->orderby('P.nome')->get();
                break;
            }case 1:{ //Gerente
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'P.nome as proprietario')
                    ->join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')
                    ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                    ->where('fazendas.ativa', 1)
                    ->where('US.id_superior', $id_usuario)->get();
                break;
            }case 2:{ //Supervisor
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'P.nome as proprietario')
                    ->join('usuario_superiores as US', 'fazendas.id_consultor', 'US.id_usuario')
                    ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                    ->where('fazendas.ativa', 1)
                    ->where('US.id_superior', $id_usuario)->get();
                break;
            }case 3:{ //Consultor
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'P.nome as proprietario')
                    ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                    ->where('fazendas.ativa', 1)->where('fazendas.id_consultor', $id_usuario)->get();
                break;
            }case 4:{ //Assistente
                $fazendas = Fazenda::select('fazendas.id','fazendas.nome', 'P.nome as proprietario')
                    ->join('usuarios_fazendas as UF', 'fazendas.id', 'UF.id_fazenda')
                    ->join('proprietarios as P', 'P.id', 'fazendas.id_proprietario')
                    ->where('UF.id_usuario', $id_usuario)->where('fazendas.ativa', 1)->get();
                break;
            }default: {

                break;
            }
        }
        return $fazendas;
    }

    public static function getAssistentesDaFazenda(Int $id_fazenda)
    {
        $assistentes = User::select('users.id', 'users.nome')
        ->join('usuarios_fazendas as UF', 'users.id', 'UF.id_usuario')
        ->join('fazendas as F', 'F.id', 'UF.id_fazenda')
        ->where('F.id', $id_fazenda)
        ->get();
        return $assistentes;
    }
}
