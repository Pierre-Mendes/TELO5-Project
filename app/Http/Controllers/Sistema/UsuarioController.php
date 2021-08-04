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

    public function managerUsuarios(Request $req)
    {
        $filtro = $req->all();
        $usar_filtro = False;
        if(isset($filtro['filtro'])){
            $usar_filtro = True;
        }

        $listaUsuarios = [];
        $listaPapeis = User::getListaDePapeis();
        $idiomas = User::getListaDeIdiomas();
        $papeis = User::getListaDePapeis();
        if(Auth::User()->tipo_usuario != 0){
            unset( $papeis[0]);
            unset( $papeis[1]);
            if($usar_filtro){
                $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
                ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at')
                ->where(function ($query) use ($filtro){
                    //Busca pelo nome
                    if(!empty($filtro['nome'])){
                        $query->where('nome', 'like', '%'.$filtro['nome'].'%');
                    }
                    //Busca pelo tipo de usuário
                    if(!empty($filtro['tipo_usuario'])){
                        $query->where('tipo_usuario', ($filtro['tipo_usuario'] - 100));
                    }
                    //Busca apenas ativos
                    if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                        $query->where('situacao', 1);
                    }
                    //Busca apenas inativos
                    if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                        $query->where('situacao',  0);
                    }
                })
                ->paginate(10);

            }else{
                $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
                ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at')->paginate(10);
            }
        }else{
            if($usar_filtro){
                $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')->orderBy('created_at')
                ->where(function ($query) use ($filtro){
                    //Busca pelo nome
                    if(!empty($filtro['nome'])){
                        $query->where('nome', 'like', '%'.$filtro['nome'].'%');
                    }
                    //Busca pelo tipo de usuário
                    if(!empty($filtro['tipo_usuario'])){
                        $query->where('tipo_usuario', ($filtro['tipo_usuario'] - 100));
                    }
                    //Busca apenas ativos
                    if(!empty($filtro['ativo']) && empty($filtro['inativo'])){
                        $query->where('situacao', 1);
                    }
                    //Busca apenas inativos
                    if(empty($filtro['ativo']) && !empty($filtro['inativo'])){
                        $query->where('situacao',  0);
                    }
                })
                ->paginate(10);
            }else{
                $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
                ->orderBy('created_at')->paginate(10);
            }
        }
        
        $cdcs = CentroDeCusto::all();
        foreach($cdcs as $cdc){
            $cdc['nome'] =( $cdc['codigo'] . " - " . $cdc['nome']);
        }
        
        // Usuários para o field de superior no cadastro/edição de usuários
        $usuarios_superiores = User::select('nome', 'id', 'tipo_usuario')
            ->where('situacao', '1')->where('tipo_usuario', '!=', '0')->where('tipo_usuario', '!=', '4')
            ->orderBy('nome', 'asc')->get();
            
        //Alterando as chaves de idioma e papel para strings
        foreach($listaUsuarios as $user){
            $user->tipo_usuario = __($listaPapeis[$user->tipo_usuario]['valor']);
            if($user->situacao == 0){
                $user->situacao = __('usuarios.inativo');
            }else{
                $user->situacao = __('usuarios.ativo');
            }
        }

        Session::put('nome_usuario', $listaUsuarios['nome']);
        // return view('sistema.usuarios.gerenciar', compact('listaUsuarios', 'idiomas', 'papeis', 'usuarios_superiores', 'cdcs', 'filtro'));
        return view('sistema.usuarios.gerenciar', compact('listaUsuarios'));
    }

    public function searchUser(Request $request) 
    {
        $listaUsuarios = [];
        $listaPapeis = User::getListaDePapeis();

        if(Auth::User()->tipo_usuario != 0) {
            $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
            ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('nome', 'like', '%'.$request['filter'].'%')
                        ->orWhere('telefone', 'like', '%'.$request['filter'].'%')
                        ->orWhere('email', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        } else {
            // dd($request['filter']);
            $listaUsuarios = User::select('id','nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')->orderBy('created_at')
            ->where(function ($query) use ($request){
                if (!empty($request['filter'])) {
                    $query->orWhere('nome', 'like', '%'.$request['filter'].'%')
                        ->orWhere('telefone', 'like', '%'.$request['filter'].'%')
                        ->orWhere('email', 'like', '%'.$request['filter'].'%');
                }
            })->paginate(10);
        }

        //Alterando as chaves de idioma e papel para strings
        foreach($listaUsuarios as $user){
            $user->tipo_usuario = __($listaPapeis[$user->tipo_usuario]['valor']);
            if($user->situacao == 0){
                $user->situacao = __('usuarios.inativo');
            }else{
                $user->situacao = __('usuarios.ativo');
            }
        }

        return view('sistema.usuarios.gerenciar', compact('listaUsuarios'));
    }

    public function UserChangeStatus($id){

        $usuarios = user::find($id);
        $situacao = ($usuarios['situacao']) ? 0 : 1;

        User::where('id', $id)->update( array('situacao' => $situacao) );

        return redirect()->back();
    }

    public function createUsuario()
    {
        //Obtendo a lista de papéis do sistema
        $papeis = User::getListaDePapeis();
        $idiomas = User::getListaDeIdiomas();
        $cdcs = CentroDeCusto::all();
        foreach ($cdcs as $cdc) {
            $cdc['nome'] = ($cdc['codigo'] . " - " . $cdc['nome']);
        }

        $listaPapeis = User::getListaDePapeis();
        $listaUsuarios = User::select('id', 'nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
            ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at');
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
        return view('sistema.usuarios.cadastrar', compact('papeis', 'idiomas', 'cdcs', 'usuarios_superiores'));
    }

    public function saveUsuario(Request $req)
    {
        $dados = $req->all();

        //Medida provisória para flag de pendência de -email
        $dados['email_verified_at'] = time();
        $verifica =  DB::table('users')->where('email', $dados['email'])->first();
        if (!empty($verifica)) {
            Notificacao::gerarAlert("notificacao.erro", "notificacao.falhaEmail", "danger");
            return redirect()->back();
        }
        $dados['password'] = bcrypt($dados['password']);

        $id_user = User::create($dados);

        if ($dados['tipo_usuario'] == 2) {
            UserSuperior::inserirSuperior($id_user['id'], $dados['superior_s']);
        } else if ($dados['tipo_usuario'] == 3) {
            UserSuperior::inserirSuperior($id_user['id'], $dados['superior_c']);
        } else if ($dados['tipo_usuario'] == 4) {
            UserSuperior::inserirSuperior($id_user['id'], $dados['superior_a']);
        }
        if ($dados['tipo_usuario'] != 0) {
            CdcUsuario::inserirRelacionamentosCdcUsuario($id_user['id'], $dados['cdcs']);
        }
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.cadastroSucesso", "success");
        return redirect()->route('usuarios_manager')->with('Notificacao');
    }

    public function editUsuarios($id)
    {
        //Obtendo a lista de papéis do sistema
        $papeis = User::getListaDePapeis();
        $idiomas = User::getListaDeIdiomas();
        $cdcs = CentroDeCusto::all();
        $usuarios = user::find($id);

        foreach ($cdcs as $cdc) {
            $cdc['nome'] = ($cdc['codigo'] . " - " . $cdc['nome']);
        }

        $listaPapeis = User::getListaDePapeis();
        $listaUsuarios = User::select('id', 'nome', 'telefone', 'pais', 'tipo_usuario', 'email', 'situacao')
            ->where('tipo_usuario', '!=', 0)->where('tipo_usuario', '!=', 1)->orderBy('created_at');
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
        return view('sistema.usuarios.editar', compact('usuarios', 'papeis', 'idiomas', 'cdcs', 'usuarios_superiores'));
    }

    public function updateUsuarios(Request $req)
    {
        $dados = $req->all();
        if (User::validaEmail($dados['email'], $dados['id'])) {
            if (!isset($dados['password']) || empty($dados['password'])) {
                unset($dados['password']);
            } else {
                $dados['password'] = bcrypt($dados['password']);
            }

            User::find($dados['id'])->update($dados);

            if ($dados['tipo_usuario'] == 2) {
                UserSuperior::inserirSuperior($dados['id'], $dados['superior_s']);
            }

            if ($dados['tipo_usuario'] == 3) {
                UserSuperior::inserirSuperior($dados['id'], $dados['superior_c']);
            }

            if ($dados['tipo_usuario'] == 4) {
                UserSuperior::inserirSuperior($dados['id'], $dados['superior_a']);
            }

            if ($dados['tipo_usuario'] != 0) {
                CdcUsuario::alterarCdcUsuario($dados['cdcs'], $dados['id']);
            }
            Notificacao::gerarAlert("notificacao.sucesso", "notificacao.edicaoSucesso", "success");
            return redirect()->route('usuarios_manager');
        } else {
            Notificacao::gerarAlert("notificacao.erro", "notificacao.falhaEmail", "danger");
            return redirect()->route('usuarios_manager');
        }
        User::find($dados['id'])->update($dados);

        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.edicaoSucesso", "success");
        return redirect()->route('usuarios_manager');
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

    public function validarEmailUsuario($id_usuario)
    {
        $usuario = User::find($id_usuario);
        if (!empty($usuario)) {
            DB::table('users')
                ->where('id', $id_usuario)
                ->update(['email_verified_at' => DB::raw('now()'), 'updated_at' => DB::raw('now()')]);
        }
        return redirect()->route('usuarios_manager');
    }

    public function delete($id)
    {
        $delete = User::find($id);
        $delete->delete();
        Notificacao::gerarAlert("notificacao.sucesso", "notificacao.remocaoSucesso", "success");
        return redirect()->route('usuarios_manager');
    }
}
