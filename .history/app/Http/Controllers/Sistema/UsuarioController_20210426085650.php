<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use Session;
use App\Classes\Sistema\CentroDeCusto;
use App\Classes\Sistema\UserSuperior;
use App\Classes\Sistema\CdcUsuario;
use App\Classes\Constantes\Notificacao;


class UsuarioController extends Controller
{
    /**
     * This functions is deprecated
     * @deprecated
     */
    public function cadastrarUsuario()
    {
        return view('sistema.usuarios.cadastrar');
    }

    public function salvarUsuario(Request $req)
    {
        $dados = $req->all();
        $dados['email_verified_at'] = time();
        $verifica =  DB::table('users')->where('email', $dados['email'])->first();
        if (!empty($verifica)) {
            Notificacao::gerarAlert("notificacao.erro", "notificacao.falhaEmail", "danger");
            return redirect()->back();
        }
        $dados['password'] = bcrypt($dados['password']);
        // dd($dados);
        // die();
        $id_user = User::create($dados);
        // if ($dados['tipo_usuario'] == 2) {
        //     UserSuperior::inserirSuperior($id_user['id'], $dados['superior_s']);
        // } else if ($dados['tipo_usuario'] == 3) {
        //     UserSuperior::inserirSuperior($id_user['id'], $dados['superior_c']);
        // } else if ($dados['tipo_usuario'] == 4) {
        //     UserSuperior::inserirSuperior($id_user['id'], $dados['superior_a']);
        // }
        // if ($dados['tipo_usuario'] != 0) {
        //     CdcUsuario::inserirRelacionamentosCdcUsuario($id_user['id'], $dados['cdcs']);
        // }
       
        return redirect()->route('usuarios.listar');
    }

    public function listarUsuarios(Request $req)
    {
        $filtro = $req->all();
        $usar_filtro = False;
        // if(isset($filtro['filtro'])){
        //     $usar_filtro = True;
        // }

        $listaUsuarios = [];
        $listaPapeis = User::getListaDePapeis();
        $idiomas = User::getListaDeIdiomas();
        $papeis = User::getListaDePapeis();
        // if(Auth::User()->tipo_usuario != 0){
        //     unset( $papeis[0]);
        //     unset( $papeis[1]);
        //     if($usar_filtro){
        //         $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
        //         ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at')
        //         ->where(function ($query) use ($filtro){
        //             //Busca pelo nome
        //             if(!empty($filtro['nome'])){
        //                 $query->where('nome', 'like', '%'.$filtro['nome'].'%');
        //             }
        //             //Busca pelo tipo de usuário
        //             if(!empty($filtro['tipo_usuario'])){
        //                 $query->where('tipo_usuario', ($filtro['tipo_usuario'] - 100));
        //             }
        //             //Busca apenas ativos
        //             if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
        //                 $query->where('situacao', 1);
        //             }
        //             //Busca apenas inativos
        //             if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
        //                 $query->where('situacao',  0);
        //             }
        //         })
        //         ->paginate(30);

        //     }else{
        //         $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
        //         ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at')->paginate(30);
        //     }
        // }else{
        //     if($usar_filtro){
        //         $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')->orderBy('created_at')
        //         ->where(function ($query) use ($filtro){
        //             //Busca pelo nome
        //             if(!empty($filtro['nome'])){
        //                 $query->where('nome', 'like', '%'.$filtro['nome'].'%');
        //             }
        //             //Busca pelo tipo de usuário
        //             if(!empty($filtro['tipo_usuario'])){
        //                 $query->where('tipo_usuario', ($filtro['tipo_usuario'] - 100));
        //             }
        //             //Busca apenas ativos
        //             if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
        //                 $query->where('situacao', 1);
        //             }
        //             //Busca apenas inativos
        //             if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
        //                 $query->where('situacao',  0);
        //             }
        //         })
        //         ->paginate(30);
        //     }else{
        //         $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')->orderBy('created_at')->paginate(30);
        //     }
        // }
        $listaUsuarios = User::select('id', 'nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')->orderBy('created_at')->paginate(10);
        $cdcs = CentroDeCusto::all();
        foreach ($cdcs as $cdc) {
            $cdc['nome'] = ($cdc['codigo'] . " - " . $cdc['nome']);
        }

        // Usuários para o field de superior no cadastro/edição de usuários
        $usuarios_superiores = User::select('nome', 'id', 'tipo_usuario')
            ->where('situacao', '1')->where('tipo_usuario', '!=', '0')->where('tipo_usuario', '!=', '4')
            ->orderBy('nome', 'asc')->get();

        //Alterando as chaves de idioma e papel para strings
        foreach ($listaUsuarios as $user) {
            $user->tipo_usuario = __($listaPapeis[$user->tipo_usuario]['valor']);
            if ($user->situacao == 0) {
                $user->situacao = __('usuarios.inativo');
            } else {
                $user->situacao = __('usuarios.ativo');
            }
        }
        return view('sistema.usuarios.gerenciar', compact('listaUsuarios', 'idiomas', 'papeis', 'usuarios_superiores', 'cdcs', 'filtro'));
    }


    public function getUsuario($id)
    {
        $user = User::find($id);
        $id_sup = UserSuperior::select('id_superior')->where('id_usuario', $id)->first();
        $user['id_superior'] = $id_sup['id_superior'];
        $user['cdc_user'] = CdcUsuario::select('id_centro_custo')->where('id_usuario', $id)->get();
        $cdc_user = [];
        foreach ($user['cdc_user'] as $cdc) {
            array_push($cdc_user, $cdc['id_centro_custo']);
        }
        $user['cdc_user'] = $cdc_user;
        return $user;
    }

    public function editarUsuarios($id)
    {
        $usuarios = user::find($id);
        return view('sistema.usuarios.editar', compact('usuarios'));
    }

    public function editaUsuarios(Request $req)
    {
        $dados = $req->all();
        User::find($dados['id'])->update($dados);
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.edicaoSucesso", "success");
        return redirect()->route('usuarios.listar');
    }
    // public function editaUsuario(Request $req)
    // {

    //     $dados  = $req->all();
    //     if (User::validaEmail($dados['email'], $dados['id'])) {
    //         if (!isset($dados['password']) || empty($dados['password'])) {
    //             unset($dados['password']);
    //         } else {
    //             $dados['password'] = bcrypt($dados['password']);
    //         }

    //         User::find($dados['id'])->update($dados);

    //         if ($dados['tipo_usuario'] == 2) {
    //             UserSuperior::inserirSuperior($dados['id'], $dados['superior_s']);
    //         }

    //         if ($dados['tipo_usuario'] == 3) {
    //             UserSuperior::inserirSuperior($dados['id'], $dados['superior_c']);
    //         }

    //         if ($dados['tipo_usuario'] == 4) {
    //             UserSuperior::inserirSuperior($dados['id'], $dados['superior_a']);
    //         }

    //         if ($dados['tipo_usuario'] != 0) {
    //             CdcUsuario::alterarCdcUsuario($dados['cdcs'], $dados['id']);
    //         }
    //         Notificacao::gerarAlert("notificacao.sucesso", "notificacao.edicaoSucesso", "success");
    //         return redirect()->back();
    //     } else {
    //         Notificacao::gerarAlert("notificacao.erro", "notificacao.falhaEmail", "danger");
    //         return redirect()->back();
    //     }
    // }

    public function removerUsuario($id)
    {
        $cont = UserSuperior::where('id_superior', $id)->count();
        if ($cont > 0) {
            Notificacao::gerarAlert("notificacao.erro", "usuarios.falha_remocao", "danger");
            return redirect()->back();
        }
        UserSuperior::where('id_usuario', $id)->delete();
        User::find($id)->delete();
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.remocaoSucesso", "success");
        return redirect()->back();
    }


    public function validarEmailUsuario($id_usuario)
    {
        $usuario = User::find($id_usuario);
        if (!empty($usuario)) {
            DB::table('users')
                ->where('id', $id_usuario)
                ->update(['email_verified_at' => DB::raw('now()'), 'updated_at' => DB::raw('now()')]);
        }
        return redirect()->route('usuarios.listar');
    }

    public function destroy($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return redirect()->route('usuarios.listar')->with('Sucesso', 'Foi deletado');
    }
}
