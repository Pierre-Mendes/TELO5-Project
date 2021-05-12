<?php
	//////////////////////////////////
	// Inclusões básicas do sistema //
	$Base_Includes_Path = '../../../'; include ("../../../Classes/Base_Includes.php");
	
	// Array de imagens
	$imagens = array();

	// Diretório das imagens
	$diretorio = '../../../../Recursos/Imagens/editor';

	// Localiza as imagens existentes no diretório do editor
	$ponteiroDir  = opendir($diretorio);
	while ($arquivo = readdir($ponteiroDir))
	{
		if($arquivo != "." && $arquivo != "..")
		{
			// Descarta imagens sem o thumbnail
			if (!is_file($diretorio."/thumb/".$arquivo)) continue;
			
			// Armazena a imagem
			$imagens[] = '{ "thumb": "'.$URL_BASE."Recursos/Imagens/editor/thumb/".$arquivo.'", "image": "'.$URL_BASE."Recursos/Imagens/editor/".$arquivo.'" }';
		}
	}
?>
[
	<?php echo implode(",", $imagens); ?>
]
<?php

	/////////////////////////
	//   Fecha a Conexão   //
	$conexao->desconectar ();
?>