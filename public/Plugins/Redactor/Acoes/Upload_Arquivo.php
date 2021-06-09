<?php
	//////////////////////////////////
	// Inclusões básicas do sistema //
	$Base_Includes_Path = '../../../'; include ("../../../Classes/Base_Includes.php");

	// Diretório das imagens
	$diretorio = '../../../../Recursos/Arquivos/editor';

	// Salva o arquivo
	$Arquivo = new Arquivos();
	$Arquivo->Upload('file', $diretorio);
	
	// Obtem as informações do arquivo
	$arquivo = $Arquivo->GetArquivo();
	$arquivo_nome = $_FILES['file']['name'];

	// Prepara o retorno
	$array = array('filelink' => $URL_BASE.'Recursos/Arquivos/editor/'.$arquivo, 'filename' => $arquivo_nome);
	
	// Retorna os arquivos salvos
	echo stripslashes(json_encode($array));

	/////////////////////////
	//   Fecha a Conexão   //
	$conexao->desconectar ();
?>