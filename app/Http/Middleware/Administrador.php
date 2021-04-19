<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Classes\Constantes\Notificacao;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Verifica se o usuário é administrador
         */
        if(Auth::user()->tipo_usuario == 0){
            return $next($request);
        }
        Notificacao::gerarAlert('503', 'comum.permissao_negada', 'danger');
        return redirect()->back();
    }
}
