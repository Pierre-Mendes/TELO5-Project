<?php

namespace App\Classes\Constantes;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{

    /**
     * @args: 
     * titulo: Chave de idioma com o Título da notificação
     * mensagem: Chave de idioma com a mensagem da notificação
     * tipo: Classe do boostrap de personalização (success, danger, primaty, etc)
     * link: Nome da rota no web.php
     * desclink: Chave de idioma do texto do botão
     * 
     * Caso não queira utilizar o botão, é só não passá-lo por párâmetro.
     * 
     */
    public static function gerarAlert(String $titulo, String $mensagem, String $tipo = "info", String $link = null, String $descLink = null){
        if(!($tipo == "success" || $tipo == "danger" || $tipo == "warning" || $tipo == "primary" || $tipo == "info" ||$tipo == "secondary" || $tipo == "light" || $tipo == "dark")){
            $tipo = "info";
        }
        $alert['titulo'] = $titulo;
        $alert['mensagem'] = $mensagem;
        $alert['tipo'] = $tipo;
        if(isset($link) && $link != ''){
           $alert['link'] = $link;
           $alert['descLink'] = $descLink;
        }
        session(['alert' =>$alert]);
    }

    public static function gerarModal(String $titulo, String $mensagem, String $tipo = "info", String $link = null, String $descLink = null){
        if(!($tipo == "success" || $tipo == "danger" || $tipo == "warning" || $tipo == "primary" || $tipo == "info" ||$tipo == "secondary" || $tipo == "light" || $tipo == "dark")){
            $tipo = "info";
        }
        $modal['titulo'] = $titulo;
        $modal['mensagem'] = $mensagem;
        $modal['tipo'] = $tipo;
        if(isset($link) && $link != ''){
           $modal['link'] = $link;
           $modal['descLink'] = $descLink;
        }
        session(['modal' =>$modal]);
    }

}
