<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use Illuminate\Validation\Rule;
use App\Classes\Constantes\Notificacao;



class AutenticacaoController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('sistema.usuarios.login');
    }

    public function Signin(Request $req)
    {
        $dados = $req->all();
        if (isset($dados['rememberPassword'])) {
            $remeber = true;
        } else {
            $remeber = false;
        }

        if (User::verificarUserAtivo($dados['email']) && Auth::attempt(['email' => $dados['email'], 'password' => $dados['password']],  $remeber)) {
            Session::put('name', Auth::user()->all());

            Session::put('user_logged', Auth::user());
            $usuario = Session::get('user_logged');

            //Alterando o idioma da página

            $idiomas =  User::getListaDeIdiomas();
            $index = Auth::user()->configuracao_idioma;
            Session::put('locale',  $idiomas[$index]['valor']);
            //Adicionando a lista de idiomas a sessão
            Session::put('idiomas', $idiomas);

            return redirect()->route('dashboard');
        } else {
            Notificacao::gerarModal("notificacao.erro", "auth.failed", "danger");
            return redirect()->route('login');
        }
    }

    public function sair()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
