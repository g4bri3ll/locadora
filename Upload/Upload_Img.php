<?php

	function img($foto){
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
		
		// Largura m�xima em pixels
		$largura = 1950;
		// Altura m�xima em pixels
		$altura = 1980;
		// Tamanho m�ximo do arquivo em bytes
		$tamanho = 800000;
 
    	// Verifica se o arquivo � uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso n�o � uma imagem.";
   	 	} 
	
		// Pega as dimens�es da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
	
		// Verifica se a largura da imagem � maior que a largura permitida
		if($dimensoes[0] > $largura) {
			$error[2] = "A largura da imagem n�o deve ultrapassar ".$largura." pixels";
		}
 
		// Verifica se a altura da imagem � maior que a altura permitida
		if($dimensoes[1] > $altura) {
			$error[3] = "Altura da imagem n�o deve ultrapassar ".$altura." pixels";
		}
		
		// Verifica se o tamanho da imagem � maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
   		 	$error[4] = "A imagem deve ter no m�ximo ".$tamanho." bytes";
		}
 
		// Se n�o houver nenhum erro
		if (empty($error)) {
		
			// Pega extens�o da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
        	// Gera um nome �nico para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficar� a imagem
        	$caminho_imagem = "C://xampp//htdocs//Locadora//IMG//filme//" . $nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
			//Inicia o array com o nome da foto
			$arrayNomeFoto = array();
			
			$arrayNomeFoto = [
					"nome_foto" => $nome_imagem
			];
			
			// Insere os dados no banco
			return $arrayNomeFoto;
		
		} else {
			return $error;
		}
	}
}
?>