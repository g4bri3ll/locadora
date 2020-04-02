<?php

class Filme {

	private $id;
	private $titulo_filme;
	private $formato;
	private $idioma;
	private $legenda;
	private $genero;
	private $tamanho;
	private $qualidade_audio;
	private $qualidade_video;
	private $ano_lancamento;
	private $duracao;
	private $sinopse;
	private $caminho_foto;
	private $caminho_video;

	//Atribuir o set a todos os atributos
	public function __set($atrib, $value){
		$this->$atrib = $value;
	}

	//Atribuir o get a todos os atributos
	public function __get($atrib){
		return $this->$atrib;
	}

}

?>