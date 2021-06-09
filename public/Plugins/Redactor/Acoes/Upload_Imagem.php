<?php
	//////////////////////////////////
	// Inclusões básicas do sistema //
	$Base_Includes_Path = '../../../'; include ("../../../Classes/Base_Includes.php");

	// Diretório das imagens
	$diretorio = '../../../../Recursos/Imagens/editor/';

	// Recebe o arquivo enviado
	$_FILES['file']['type'] = strtolower($_FILES['file']['type']);

	// Trata as extensões
	if ($_FILES['file']['type'] == 'image/png'
	|| $_FILES['file']['type'] == 'image/jpg'
	|| $_FILES['file']['type'] == 'image/gif'
	|| $_FILES['file']['type'] == 'image/jpeg'
	|| $_FILES['file']['type'] == 'image/pjpeg')
	{
		// Salva a imagem
		$Foto = new Fotos("file");
		$Foto->Save($diretorio, $Foto->GetNome());
		$Foto->Save_Thumbnails($diretorio, array('thumb_100_100'));
	
		// Prepara o retorno
		$array = array('filelink' => $URL_BASE.'Recursos/Imagens/editor/'.$Foto->GetNome());
	
		// Retorna as imagens salvas
		echo stripslashes(json_encode($array));
	}

	/////////////////////////
	//   Fecha a Conexão   //
	$conexao->desconectar ();
?>