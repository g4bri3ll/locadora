<?php
session_start();

include_once 'Model/Modelo/Filme.php';
include_once 'Model/DAO/FilmeDAO.php';
include_once 'Upload/Upload_Img.php';
include_once 'Upload/Upload_Video.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
<title></title>
<style>
a, .menu-topo li a:hover, .menu-topo li.sfHover a, .caption-branco a,
	.sidctn a:hover, .coll-13 .sidctn a:hover, .breadcrumb a, .content a,
	.info-video a:hover, .comentarios a, .nome-resultado a:hover, ol.commentlist li .texto-comentario a
	{
	color: #3b9c00;
}

.custom-text {
	color: #3b9c00 !important;
}

.busca .pesquisa, .lista-filmes li
  .titulo-box, .navigation .current, .navigation a:hover, .num-top,
	.links-servidores li, .lista-filmes-relacionados li div.box .titulo-box,
	ol.commentlist li .reply-link a, .forms .cancel-comment-reply a,
	#submit, .lista-search li:hover .tipo-icon, .bg-vermelho,
	.tooltip-theme {
	background-color: #3b9c00;
}

.capa-single {
	border-color: #3b9c00 !important;
}

.menu-topo li ul li a:hover, .menu-topo li ul li.sfHover a, .menu-topo li ul li.sfHover ul li a:hover,
	.tooltip-theme, .slider .flex-prev, .slider .flex-next, .button_link.loop
	{
	background-color: #3b9c00 !important;
}

blockquote, .widgettitle span, .lista-filmes li:hover,
	.lista-filmes-relacionados li div.box:hover {
	border-color: #3b9c00 !important;
}

.relacionados-icon, .comentario-icon {
	background-color: #3b9c00 !important;
}
</style>
</head>
<body>
<?php 
if (empty($_SESSION)){
	?> <script type="text/javascript"> alert('Faça seu login');	window.location.assign('index.php'); </script> <?php
} else {
	$nivel = $_SESSION['nivel'];
	if ($nivel === "1"){
?>
	<br>
	<br>
	<!-- Aqui e a parte do cabeçalho -->
	<div class="menu-bg">
		<!-- margem -->
		<div class="margem">
			<!-- logo -->
			<h1 style="margin: 0; padding: 0;">
				<a href="index.php" class="logo-link" title=""><img
					src="IMG/logo.png" alt=""></a>
			</h1>
			<!-- fim logo -->

			<!-- menu topo -->
			<nav>
				<ul class="menu-topo sf-menu">
					<li id="menu-item-7192"
						class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-7192"><a
						title="Página Inicial" href="index.php">Início</a></li>
					<li id="menu-item-7195"
						class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7195"><a
						title="Lançamentos" href="#">Lançamentos</a></li>
					<li id="menu-item-7213"
						class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7213"><a
						href="#">Séries</a></li>
				</ul>
			</nav>
			<!-- fim menu topo -->
		</div>
		<!-- fim margem -->
	</div>
	<br>
	<br>
	<!-- fim menu bg -->


<!-- slogan -->
<div class="margem">
	<div class="slogan">

		<h2>Cadastrar Filme</h2>

<?php
if (! empty ( $_POST )) {
	
	echo $path_parts['caminho_video'] . "<br />";
	/*
	if (empty ($_POST ['titulo_filme']) || empty ($_POST ['formato']) || empty ($_POST ['idioma']) || empty ($_POST ['legenda']) || 
		empty ($_POST ['genero']) || empty ($_POST ['tamanho']) || empty ($_POST ['qualidade_audio']) || empty ($_POST ['qualidade_video']) || 
		empty ($_POST ['ano_lancamento']) || empty ($_POST ['duracao']) || empty ($_FILES ['caminho_foto']) || empty ($_FILES ['caminho_video']) || 
		empty ($_POST ['sinopse'])) { 
			
			?> <font size="15px" color="red"> Campos vazio não permitido! </font> <?php
			
		} else {
	
		$titulo = $_POST ['titulo_filme'];
		$titulo = strtolower($titulo);
		$formato = $_POST ['formato'];
		$idioma = $_POST ['idioma'];
		$legenda = $_POST ['legenda'];
		$genero = $_POST ['genero'];
		$tamanho = $_POST ['tamanho'];
		$qualidade_audio = $_POST ['qualidade_audio'];
		$qualidade_video = $_POST ['qualidade_video'];
		$ano = $_POST ['ano_lancamento'];
		$duracao = $_POST ['duracao'];
		$foto = $_FILES ['caminho_foto'];
		$video = $_FILES ['caminho_video'];
		$sinopse = $_POST ['sinopse'];
		
		$filDAO = new FilmeDAO ();
		$result = $filDAO->listaProcuraTitulo($titulo);
		
		if (!empty($result)){
			?> <font size="15px" color="red"> Existe um filme com esse titulo, escolha outro nome para o titulo! </font> <?php
		} else {
			//Validações da fotos, ve se esta tudo ok
			$novafoto = img ( $foto );
			if (empty($novafoto['nome_foto'])){
				foreach ($novafoto as $erro){
					?> <font size="10px" color="red"> Ocorreu ao cadastrar a foto: <?php print_r($erro); ?> </font> <?php
				}
			} else {
			
				//Validações do filmes para ve se esta tudo ok
				//$novoVideo = video($video);
				
				//pegando o caminho, de onde o arquivo se encontra
				echo $path_parts['caminho_video'] . "<br />";
				
				if (empty($novoVideo['nome_video'])){
					?> <font size="10px" color="red"> Ocorreu ao cadastra o video: <?php print_r($novoVideo); ?> </font> <?php
				} else {
					
					$filme = new Filme ();
					$filme->titulo_filme = $titulo;
					$filme->formato = $formato;
					$filme->idioma = $idioma;
					$filme->legenda = $legenda;
					$filme->genero = $genero;
					$filme->tamanho = $tamanho;
					$filme->qualidade_audio = $qualidade_audio;
					$filme->qualidade_video = $qualidade_video;
					$filme->ano_lancamento = $ano;
					$filme->duracao = $duracao;
					$filme->sinopse = $sinopse;
					$filme->caminho_foto = $novafoto['nome_foto'];
					$filme->caminho_video = $novoVideo['nome_video'];
					
					$filDAO = new FilmeDAO ();
					$res = $filDAO->cadastrar ( $filme );
					
					if ($res){
						?> <script type="text/javascript">  alert('Filme cadastrado com sucesso!'); window.location.assign('index.php'); </script> <?php
					} else {
						?> <font size="15px" color="red"> Ocorreu ao cadastra o filme: <?php print_r($res); ?> </font> <?php
					}
					
				}
				
			}
			
		}
		
	}
	
*/

}
?>
	<div id="container">
			<form action="" method="post" enctype="multipart/form-data" >
				<label class="cadastradoFilmeNome"> titulo de filme </label> 
				<input type="text" name="titulo_filme" class="cadastroFilmeInput" /><br> 
				<label class="cadastradoFilmeNome"> Formato do filme </label> 
				<input type="text" name="formato"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Idioma do filme </label>
				<input type="text" name="idioma"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Legenda do filme </label>
				<input type="text" name="legenda"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Genero do filme </label>
				<input type="text" name="genero"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Tamanho do filme </label>
				<input type="text" name="tamanho"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Qualidade do audio
				</label> <input type="text" name="qualidade_audio"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Qualidade do video </label> 
				<input type="text" name="qualidade_video"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Ano do filme </label> 
				<input type="text" name="ano_lancamento"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Duração do filme </label>
				<input type="text" name="duracao"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Foto do filme </label>
				<input type="file" name="caminho_foto"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome"> Video do filme </label> 
				<input type="file" name="caminho_video"  class="cadastroFilmeInput"/><br> 
				<label class="cadastradoFilmeNome">	Sinopse do filme </label>
				<textarea rows="" cols="" name="sinopse" class="cadastroFilmeTextArea"></textarea>
			<br> <input type="submit" value="Cadastrar Filme" class="btn" >
			</form>
						
		<a href="index.php" class="link">Voltar a pagina inicial</a>

	</div>
</div>
<!-- fim slogan -->

<?php 
	} else {
		?> <script type="text/javascript"> alert('Usuario sem permissão para acessar essa parte do site!');	window.location.assign('index.php'); </script> <?php
	}
}//fecha o else que esta verificando se a session esta vazia ou não
?>

</body>
</html>