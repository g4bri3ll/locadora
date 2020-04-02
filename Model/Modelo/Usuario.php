<?php

class Usuario {
	
	private $id;
	private $login;
	private $senha;
	private $comfirmar_senha;
	private $email;
	private $nivel_log;
	
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