<?php

	function video($video){
	
	// Se a foto estiver sido selecionada
	if (!empty($video["name"])) {
		
		// Tamanho m�ximo do arquivo em bytes
		$tamanho = 300000000;
 
    	// Verifica se o arquivo � uma imagem
    	if(!preg_match("/^video\/(mp4|flv|3gp|rmvb|avi|mov|mkv)$/", $video["type"])){
     	   $error[1] = "Formatos validos mp4|flv|3gp|rmvb|avi|mov|mkv";
   	 	} 
	
		// Pega as dimens�es do video
		$dimensoes = getimagesize($video["tmp_name"]);
	
		// Verifica se o tamanho da imagem � maior que o tamanho permitido
		if($video["size"] > $tamanho) {
   		 	$error[2] = "O video deve ter no m�ximo ".$tamanho." bytes";
		}
 
		// Se n�o houver nenhum erro
		if (empty($error)) {
		
			// Pega extens�o do filme
			preg_match("/\.(mp4|flv|3gp|rmvb|avi|mov|mkv){1}$/i", $video["name"], $ext);
 
        	// Gera um nome �nico para o filme
        	$nome_video = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficar� o video
        	$caminho_imagem = "C://xampp//htdocs//Locadora//FILMES//" . $nome_video;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($video["tmp_name"], $caminho_imagem);
		
			//Inicia o array com o nome da foto
			$arrayNomeFoto = array();
			
			$arrayNomeFoto = [
					"nome_video" => $nome_video
			];
			
			// Insere os dados no banco
			return $arrayNomeFoto;
		
		} else {
			return $error;
		}
	} else {
		return "N�o houve video cadastrado";
	}
}
?>