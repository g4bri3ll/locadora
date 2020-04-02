<?php

include_once 'Conexao/Conexao.php';

class UsuarioDAO {

	private $conn = null;
	
	public function cadastrar(Usuario $usuario) {
	
		try {
				
			$senha = md5 ( $usuario->senha );
			$comfirmar_senha = md5 ( $usuario->comfirmar_senha );
				
			$sql = "INSERT INTO usuario (login, senha, comfirmar_senha, email) VALUES 
					('" . $usuario->login . "', '" . $senha . "', '" . $comfirmar_senha . "', '" . $usuario->email . "')";
				
			$conn = new Conexao ();
			$conn->openConnect ();
			
			$mydb = mysqli_select_db ( $conn->getCon (), $conn->getBD() );
			$resultado = mysqli_query ( $conn->getCon (), $sql );
				
			$conn->closeConnect ();
			
			return true;
				
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
		
	}

	//deleta pelo id selecionado
	public function deleteId($id) {

		$sql = "DELETE FROM usuario WHERE id = '" . $id . "'";
		
		$conn = new Conexao ();
		$conn->openConnect ();
		
		mysqli_select_db ( $conn->getCon (), $conn->getBD() );
		$resultado = mysqli_query ( $conn->getCon (), $sql );
		
		$conn->closeConnect ();
		
		return true;
		
	}
	
	//Retorna a lista como todos os usuarios menos a senha e a comfirmar de senha
	public function listaUsuario(){
		
		$sql = sprintf("SELECT login, email, nivel_log FROM usuario");

		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);

		$arrayUsuarios = array();
		
		while ($row = mysqli_fetch_assoc($resultado)) {
			$arrayUsuarios[]=$row;
		}
		
		$conn->closeConnect ();
		return $arrayUsuarios;
		
	}
	

	//Retorna a lista de cpf, email, e o id para cadastrar
	public function VerificaDadosCadastrado($login, $email){
	
		$sqlLogin = "SELECT login FROM usuario WHERE login LIKE '".$login."'";
		$sqlEmail = "SELECT email FROM usuario WHERE email LIKE '".$email."'";
	
		$conn = new Conexao();
		$conn->openConnect();
	
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resLogin = mysqli_query($conn->getCon(), $sqlLogin);
		$resEmail = mysqli_query($conn->getCon(), $sqlEmail);
		
		$conn->closeConnect ();
		
		$arrayLogin = array();
		while ($row = mysqli_fetch_assoc($resLogin)) {
			$arrayLogin[]=$row;
		}
		
		$arrayEmail = array();
		while ($row = mysqli_fetch_assoc($resEmail)) {
			$arrayEmail[]=$row;
		}
		
		if (empty($arrayEmail) || empty($arrayLogin)){
			$array = array();
			$array = [
					"login" => $arrayLogin,
					"email" => $arrayEmail
			];
			return $array;
		} else {
			
			return "0";
			
		}
		
	}
	
	//Autentica usuário
	public function autenticaUsuario($email, $senha){
	
		$senha = md5($senha);
	
		$sql = sprintf("SELECT nivel_log, id, login FROM usuario WHERE email LIKE '".$email."' AND senha LIKE '".$senha."'");
		
		$conn = new Conexao();
		$conn->openConnect();
	
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
	
		$conn->closeConnect ();
	
		if (!empty($resultado)) {
			// transforma os dados em um array
			$linha = mysqli_fetch_assoc($resultado);
			// calcula quantos dados retornaram
			$total = mysqli_num_rows($resultado);
	
			if ($total > 0){
				$_SESSION['id'] = $linha['id'];
				$_SESSION['nivel'] = $linha['nivel_log'];
				$_SESSION['login'] = $linha['login'];
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	
	}
	
	
}
?>