<?php
session_start();

include_once 'Conexao/Conexao.php';
include_once 'Model/DAO/FilmeDAO.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
<title>Mostrar o filme</title>
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
if (!empty($_SESSION)){
	if (!empty($_SESSION)){
		$lis = new FilmeDAO ();
		$array = $lis->listaTudo();
?>
<!-- slogan -->
<div class="siteListaFilmeTable">
	<h1 class="h1"> Lista de todos os filme cadastrado! </h1><br>
	
	<table class="tabelaLista">
	<tr align="center">
	<td><label class="listaNomeFilme"> titulo de filme </label></td>
	<td><label class="listaNomeFilme"> Formato do filme </label></td>
	<td><label class="listaNomeFilme"> Idioma do filme </label></td>
	<td><label class="listaNomeFilme"> Legenda do filme </label></td>
	<td><label class="listaNomeFilme"> Genero do filme </label></td>
	<td><label class="listaNomeFilme"> Tamanho do filme </label></td>
	<td><label class="listaNomeFilme"> Quali audio</label></td>
	<td><label class="listaNomeFilme"> Quali video </label></td>
	<td><label class="listaNomeFilme"> Ano do filme </label></td>
	<td><label class="listaNomeFilme"> Duração do filme </label></td>
	<td><label class="listaNomeFilme"> Ação </label></td>
	</tr>
	
<?php foreach ( $array as $lis => $listaFilme ) { ?>
	
	<tr align="center">
	<td><label class="listaValorFilme"> <?php echo $listaFilme['titulo_filme']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['formato']; ?> </label> </td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['idioma']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['legenda']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['genero']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['tamanho']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['qualidade_audio']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['qualidade_video']; ?> </label></td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['ano_lancamento']; ?> </label> </td>
	<td><label class="listaValorFilme"> <?php echo $listaFilme['duracao']; ?> </label> </td>
	<td>
	<a href="#"> <label class="listaValorFilme"> Remover | </label> </a>
	<a href="#"> <label class="listaValorFilme"> Altera </label> </a>
	</td>
	</tr>

<?php } ?>

	</table>

<br> <a href="index.php">Volta ao site</a>

</div>
<!-- fim slogan -->

<?php
}//Verifica se o nivel do usuario que esta logado
	else {
	?> <script type="text/javascript"> window.location.assign('index.php'); </script><?php 
	} 
}//Verifica se tem alguem na session
else {
?> <script type="text/javascript"> window.location.assign('index.php'); </script> 
<?php } ?>
</body>
</html>