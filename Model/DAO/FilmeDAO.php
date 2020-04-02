<?php

include_once 'Conexao/Conexao.php';

class FilmeDAO {

	private $conn = null;
	
	public function cadastrar(Filme $filme) {
	
			try {
				
				//titulo_filme, formato, idioma, legenda, genero, tamanho, qualidade_audio, qualidade_video, ano_lancamento, duracao, sinopse, caminho_foto, caminho_video
				
				$sql = "INSERT INTO filme (titulo_filme, formato, idioma, legenda, genero, tamanho, qualidade_audio, qualidade_video, 
						ano_lancamento, duracao, sinopse, caminho_foto, caminho_video) 
				VALUES ('" . $filme->titulo_filme . "', '" . $filme->formato. "', '" . $filme->idioma. "', '" . $filme->legenda. "', '" . $filme->genero. "', 
						'" . $filme->tamanho. "','" . $filme->qualidade_audio. "','" . $filme->qualidade_video. "',	'" . $filme->ano_lancamento. "',
						'" . $filme->duracao. "', '" . $filme->sinopse. "', '" . $filme->caminho_foto. "', '" . $filme->caminho_video. "')";
				
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

		$sql = "DELETE FROM filme WHERE id = '" . $id . "'";
		
		$conn = new Conexao ();
		$conn->openConnect ();
		
		mysqli_select_db ( $conn->getCon (), $conn->getBD() );
		$resultado = mysqli_query ( $conn->getCon (), $sql );
		
		$conn->closeConnect ();
		
		return true;
		
	}
	
	//Lista todos os filmes
	public function lista(){
		
		$sql = sprintf("SELECT id, titulo_filme, caminho_foto FROM filme");

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
	
	//Lista todos os filmes para o listaFilme.php
	public function listaTudo(){
		
		$sql = sprintf("SELECT * FROM filme ORDER BY id DESC");

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
	
	//Lista pelo id
	public function listaId($id){
		
		$sql = sprintf("SELECT * FROM filme WHERE id = '".$id."'");

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

	//Lista pelo genero
	public function listaGenero($acao){
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), 
				"SELECT id, titulo_filme, caminho_foto FROM filme WHERE genero LIKE '%".$acao."%'");

		$arrayUsuarios = array();
		
		while ($row = mysqli_fetch_assoc($resultado)) {
			$arrayUsuarios[]=$row;
		}
		
		$conn->closeConnect ();
		return $arrayUsuarios;
		
	}

	//Lista pelo titulo e joga no mostra_filme.php
	public function listaTitulo($p){
		
		$sql = sprintf("SELECT * FROM filme WHERE titulo_filme LIKE '".$p."'");
		
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

	//Lista ano de lançamento
	public function listaAnoLancamento($anoInicio, $anoFinal){
		
		$sql = sprintf("SELECT  id, titulo_filme, caminho_foto FROM filme WHERE 
				ano_lancamento >= '".$anoInicio."' AND ano_lancamento <= '".$anoFinal."'");
		
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
	
	//Lista pelo idioma selecionado
	public function listaIdioma($idioma){
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), 
				"SELECT id, titulo_filme, caminho_foto FROM filme WHERE idioma LIKE '%".$idioma."%'");

		$arrayUsuarios = array();
		
		while ($row = mysqli_fetch_assoc($resultado)) {
			$arrayUsuarios[]=$row;
		}

		$conn->closeConnect ();
		return $arrayUsuarios;
		
	}

	//Lista pelo idioma selecionado
	public function listaProcuraTitulo($titulo){
		
		$sql = "SELECT titulo_filme FROM filme WHERE titulo_filme LIKE '".$titulo."'";
		
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

}
?>