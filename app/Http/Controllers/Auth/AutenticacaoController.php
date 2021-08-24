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
use App\Http\Controllers\Sistema\FazendaController;


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
            Session::put('locale',  Auth::user()->preferencia_idioma);
            //Adicionando a lista de idiomas a sessão
            Session::put('idiomas', $idiomas);
            
            // Coloca a lista de fazendas no menu
            $fazendas = FazendaController::selectFarms();
            Session::put('Lista_Fazendas', $fazendas);
            
            return redirect()->route('dashboard');
        } else {
            redirect()->back()->with('error', __('login.dados_invalidos'), 'danger');
            return redirect()->route('login');
        }
    }

    public function LanguageUpdate($locale){
        //buscar id do usuario logado
        $id_usuario = Auth::user()->id;

        //update na tabela usuario
        User::where('id', $id_usuario)->update( array('preferencia_idioma' => $locale) );
        Session::put('locale', $locale);
        return redirect()->back();
    }
    
    public function sair()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
