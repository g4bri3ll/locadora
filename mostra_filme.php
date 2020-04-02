<?php
session_start();

include_once 'Conexao/Conexao.php';
include_once 'Model/DAO/FilmeDAO.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
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
?>
	<br><br>
	<!-- Aqui e a parte do cabeçalho -->
	<div class="menu-bg">
		<!-- margem -->
		<div class="margem">
			<!-- logo -->
			<h1 style="margin: 0; padding: 0;">
				<a href="index.php" class="logo-link" title="">
				<img src="IMG/logo.png" alt=""></a>
			</h1>
			<!-- fim logo -->

			<!-- menu topo -->
			<nav>
				<ul class="menu-topo sf-menu">
					<li id="menu-item-7192" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-7192">
					<a title="Página Inicial" href="index.php">Início</a></li>
					<?php 
					if (!empty($_SESSION)){
						$n = $_SESSION['nivel'];
						if ($n === "1"){
						?>
						<li id="menu-item-7192"	class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-7192">
						<a href="cadastrar_filme.php">Cadastrar filme</a></li>
						<?php							
						}
					} 
					?>
					<li id="menu-item-7195" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7195">
					<a title="Lançamentos" href="#">Lançamentos</a></li>
					<li id="menu-item-7213" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7213">
					<a href="#">Séries</a></li>
				</ul>
			</nav>
			<!-- fim menu topo -->
		</div>
		<!-- fim margem -->
	</div>
	<br>
	<br>
	<!-- fim menu bg -->




<?php
$id = $_GET ['id'];
$lis = new FilmeDAO ();
$array = $lis->listaId ( $id );
foreach ( $array as $lis => $listaFilme ) {
	?>

  <!-- slogan -->
	<div class="margem">
		<div class="slogan">

			<h1 class="big title-single">
				<strong><?=$listaFilme["titulo_filme"]; ?></strong>
			</h1>

	<div class="doble-dote" style="margin: 0 0 20px 0;"></div>

		<article>
			<!-- videos servidores -->
			<div class="tabs">
				<!-- embed videos -->
				<div class="embeds-servidores"></div>
				<!-- fim embed videos -->

			</div>
			<!-- fim videos servidores -->

			<div class="clear"></div>
			<div class="doble-dote" style="margin: 0 0 15px 0;"></div>



			<!-- infos video -->
			<span class="info-video open-sans tempo-video"> <strong>Título:</strong><?=$listaFilme["titulo_filme"]; ?>    </span>

			<span class="info-video open-sans lancamento-video"> <strong>Lançamento:</strong> <?=$listaFilme["ano_lancamento"]; ?>    </span>

			<span class="info-video open-sans audio-video"> <strong>Áudio:</strong> <?=$listaFilme["idioma"]; ?> </span>

			<span class="info-video open-sans visitas-video"> </span>
			<!-- infos video -->

			<div class="clear"></div>
			<div class="doble-dote" style="margin: 10px 0 15px 0;"></div>

			<!-- capa single -->
			<div class="capa-single">
				<img src="IMG/filme/<?=$listaFilme["caminho_foto"]; ?> " alt="<?=$listaFilme["titulo_filme"]; ?>" width="400px" height="450px"/>
			</div>
			<!-- fim capa single -->

			<!-- content single -->
			<div class="content content-single"><br>
				<p><?=$listaFilme["sinopse"]; ?><br /> <span
						class="imdbRatingPlugin" data-user="ur65588565"
						data-title="tt4824302" data-style="p2"></span></p>
				
				<br>
				<p style="text-align: center;">
					<strong> <?=$listaFilme["formato"]; ?> | <?=$listaFilme["duracao"]; ?> | <?=$listaFilme["idioma"]; ?></strong>
				</p>
				<br>
			</div>
			<!-- fim content single -->
		</article>

			<video src="FILMES/<?=$listaFilme["caminho_video"]; ?>" width="720px" height="540px" controls></video> 

		</div>
	</div>
	<!-- fim slogan -->
<?php } ?>

<?php
}//Verifica se tem alguem na session
else {
?>
<script type="text/javascript">
if (confirm("Se você não e cadastrado, faça seu cadastro para acessar os filmes gratuitos!")){
	window.location.assign('cadastrarUsuario.php');
} else {
	window.location.assign('index.php');
}
</script>
<?php } ?>
</body>
</html>