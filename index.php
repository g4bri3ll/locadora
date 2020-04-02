<?php
session_start();

include_once 'Conexao/Conexao.php';
include_once 'Model/DAO/FilmeDAO.php';
include_once 'Model/DAO/UsuarioDAO.php';
?>
<html>
<head>
<title>Filmes</title>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
<!-- css adicional -->
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

.busca .pesquisa, .lista-filmes li .titulo-box, .navigation .current,
	.navigation a:hover, .num-top, .links-servidores li,
	.lista-filmes-relacionados li div.box .titulo-box, ol.commentlist li .reply-link a,
	.forms .cancel-comment-reply a, #submit, .lista-search li:hover .tipo-icon,
	.bg-vermelho, .tooltip-theme {
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
<!-- fim css adicional -->
</head>
<body>
	<script type="text/javascript" src="JS/index.js"></script>
	<!-- menu bg -->

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
					<li id="menu-item-7192"	class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-7192">
					<a title="Página Inicial" href="index.php">Início</a></li>
					<?php 
					if (!empty($_SESSION)){
						$n = $_SESSION['nivel'];
						if ($n === "1"){
						?>
						<li id="menu-item-7192"	class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-7192">
						<a href="cadastrar_filme.php">Cadastrar Filme</a></li>
						<li id="menu-item-7192"	class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-7192">
						<a href="listaFilme.php">Lista Filme</a></li>
						<?php							
						}
					} 
					?>
					<li id="menu-item-7195"	class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7195">
					<a title="Lançamentos" href="#">Lançamentos</a></li>
					<li id="menu-item-7213"	class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7213">
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


	<div class="clear"></div>

	<div class="fundo">
		<div class="margem">

			<!-- esquerda -->
			<div class="esquerda">

				<!-- titulo ultimos -->
				<span class="heading alignleft" style="margin-top: 5px;"> Filmes de
					Lançamentos </span>
				<!-- titulo ultimos -->

				<!-- busca -->
				<div class="busca">
				<?php
				if (! empty ( $_GET ['p'] )) {
					$p = $_GET ['p'];
					$p = strtolower($p);
					$filme = new FilmeDAO ();
					$array = $filme->listaTitulo ( $p );
					if (empty ( $array )) {
						?>
					<script type="text/javascript">
						alert('Filme não encontrado!');
					</script>	
					<?php
					} else {
						foreach ( $array as $lis => $listaFilme ) {
							header ( "Location: mostra_filme.php?id=" . $listaFilme ['id'] );
						}
					}
				}
				?>
					<form method="get" action="">
						<input class="pesquisa open-sans" type="text" placeholder="Pesquisar..." name="p" size="20" /> 
						<input type="hidden" name="tipo" value="video">
						<input type="submit" value="Buscar" class="button" />
					</form>
				</div>
				<!-- fim busca -->

				<div class="clear"></div>
				<div class="line" style="margin-bottom: 15px;"></div>

					<?php
					$lis = new FilmeDAO ();
					//Pega o array de genero escolhido pelo usuário na tela inicial e lista na tela
					if (! empty ( $_GET ['acao'] )) {
						$acao = $_GET ['acao'];
						$array = $lis->listaGenero ( $acao );
					}
					//Colocar no array todos os filmes com os anos digitados pelo usuário
						else if (!empty($_GET['ano_inicio'])){
							$anoInicio = $_GET['ano_inicio'];
							$anoFinal = $_GET['ano_final'];
							if ($anoInicio > $anoFinal){
								?>
									<script type="text/javascript">
										alert('O campo (ANO MENOR) não poder ser maior do que o campo de (ANO MAIOR)!');
									</script>
								<?php 
								$array = $lis->lista ();
							} else {
								$arrayAnoLancamento = $lis->listaAnoLancamento($anoInicio, $anoFinal);
								if (empty($arrayAnoLancamento)){
									?>
										<script type="text/javascript">
											alert('Esses anos digitados, não encontro nenhum resultado!');
										</script>
									<?php 
								}
								$array = $arrayAnoLancamento;
							}
					}
					//Colocar no array todos os filmes de idioma selecionado pelo usuário
						else if (!empty($_GET['idioma'])){
							$idioma = $_GET['idioma'];
							$fil = new FilmeDAO();
							$arrayIdioma = $fil->listaIdioma($idioma);
							$array = $arrayIdioma;
						}
					//Se nenhum dessas opções acima for selecionada, ele lista todos os filmes na tela inicial
					else {
						$array = $lis->lista ();
					}
						?>
						
				<!-- Partes dos filmes -->
				<ul class="lista-filmes">
						<?php
						foreach ( $array as $lis => $listaFilme ) {
						?>
    
		        <li>
						<!-- titulo box -->
						<div class="titulo-box open-sans">
							<h2 class="titulo-box-link">
								<a href="mostra_filme.php?id=<?=$listaFilme["id"]; ?>"
									title="<?=$listaFilme["titulo_filme"]; ?>"><?=$listaFilme["titulo_filme"]; ?></a>
							</h2>
						</div> <!-- fim titulo box -->

						<div class="clear"></div> <!-- capa -->
						<div class="capa">
							<a href="mostra_filme.php?id=<?=$listaFilme["id"]; ?>"
								class="absolute-capa no-text"><?=$listaFilme["titulo_filme"]; ?></a>
							<img src="IMG/filme/<?=$listaFilme["caminho_foto"]; ?>"
								alt="<?=$listaFilme["titulo_filme"]; ?>" />
						</div> <!-- fim capa -->

						<div class="clear"></div> <!-- views -->
						<div class="views">Filme do net Filmes</div> <!-- fim views -->

						<!-- balao comentario --> <!-- fim balao comentario -->

					</li>
					
    <?php
}
?>   
        </ul>
				<!-- fim lista filmes -->

			</div>

			<!-- direita -->
			<div class="direita">
				<?php 
				if (!empty($_POST['email']) || !empty($_POST['senha']) || !empty($_POST)){
					if (empty($_POST['email']) || empty($_POST['senha'])){
						?> <font size="5px" color="red"> Campos vazio não permitido! </font> <?php
					} else {
						$email = $_POST['email'];
						$email = strtolower($email);
						$senha = $_POST['senha'];
						$senha = strtolower($senha);
						
						$usuDAO = new UsuarioDAO();
						$resultLogin = $usuDAO->autenticaUsuario($email, $senha);
						
						if ($resultLogin){
							?> <script type="text/javascript"> window.location.assign('index.php'); </script> <?php
						} else {
							?> <script type="text/javascript"> alert('Usuario não encontrado!'); window.location.assign('index.php'); </script> <?php
						}
					}
				}
				?>
				<?php 
					if (!empty($_SESSION['login'])){
				?>
					<div class="tabelaLogin">
						<label class="logado">Seja bem vindo <?php echo $_SESSION['login']; ?> </label>
						<a href="sair.php" class="sairLogado"> Sair </a>
					</div>
				<?php
				} else {
				?>
				<div class="tabelaLogin">
					<h3 class="widgettitle heading open-sans">
						<span>Faça seu Login</span>
					</h3>
					<form action="" method="post">
						<label class="nomeLogin">Email:</label>
						<input type="email" name="email" class="textLogin" />
						<label class="nomeLogin"> Senha:</label>
						<input type="password" name="senha" class="textLogin" />
						<input type="submit" value="entrar" class="btnLogin" />
					</form>
					<a href="cadastrarUsuario.php" class="linkLogin">Não so cadastrado!</a>
				</div>
				
				<?php } ?>
				
				<h3 class="widgettitle heading open-sans">
					<span>Buscar Avançada</span>
				</h3>
				<script type="text/javascript">
					function Onlynumbers(e) {
						var tecla=new Number();
						if(window.event) {
							tecla = e.keyCode;
						} else if(e.which) {
							tecla = e.which;
						} else {
							return true;
						} if((tecla >= "97") && (tecla <= "122")){
							return false;
						}
					}
				</script>
				Digite o ano<br>
				<form action="" method="get">
					<div class="pesquisaAno">
						<input class="pes" type="text" name="ano_inicio" placeholder="Ano Menor" maxlength="4" onkeypress="return Onlynumbers(event)"/>Até
						<input class="pes" type="text" name="ano_final" placeholder="Ano Maior" maxlength="4" onkeypress="return Onlynumbers(event)" />
						<input class="buttonOK" type="submit" value="OK" />
					</div>	 
				</form><br>
				

					<script> function submit(){ document.forms['form1'].submit(); } </script>
					Seleção de Idioma
					<?php
					$menu1 = '
					<div class="combo">
					          <form id="form1" name="form1" action="" method="GET">
					            <select name="idioma" onchange="submit();" class="combobox">
								  <option value="#">Seleciona um idioma</option>
					              <option value="Portugues">Dublado</option>
					              <option value="Ingles">Legendado</option>
					               </select><br><br>
					          </form>
					        </div>';
					echo $menu1;
					?>

				<!--sidebar-->
				<div class="sidebar">
					<ul>
						<li id="nav_menu-2" class="widget widget_nav_menu"><h3
								class="widgettitle heading open-sans">
								<span>Categorias</span>
							</h3>
							<div class="sidctn open-sans">
								<div class="menu-menu-categorias-container">
									<ul id="menu-menu-categorias" class="menu">
										<li id="menu-item-7164"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7164"><a
											href="index.php?acao=acao">Ação</a></li>
										<li id="menu-item-7165"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7165"><a
											href="index.php?acao=animacao">Animação</a></li>
										<li id="menu-item-7166"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7166"><a
											href="index.php?acao=aventura">Aventura</a></li>
										<li id="menu-item-7190"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7190"><a
											href="index.php?acao=biografia">Biografia</a></li>
										<li id="menu-item-7115"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7115"><a
											href="index.php?acao=comedia">Comédia</a></li>
										<li id="menu-item-7214"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7214"><a
											href="index.php?acao=crime">Crime</a></li>
										<li id="menu-item-7167"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7167"><a
											href="index.php?acao=drama">Drama</a></li>
										<li id="menu-item-7168"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7168"><a
											href="index.php?acao=fantasia">Fantasia</a></li>
										<li id="menu-item-7191"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7191"><a
											href="index.php?acao=faroeste">Faroeste</a></li>
										<li id="menu-item-7169"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7169"><a
											href="index.php?acao=ficcao">Ficção</a></li>
										<li id="menu-item-7182"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7182"><a
											href="index.php?acao=guerra">Guerra</a></li>
										<li id="menu-item-7197"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7197"><a
											href="index.php?acao=musical">Musical</a></li>
										<li id="menu-item-7183"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7183"><a
											href="index.php?acao=nacional">Nacional</a></li>
										<li id="menu-item-7170"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7170"><a
											href="index.php?acao=policial">Policial</a></li>
										<li id="menu-item-7116"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7116"><a
											href="index.php?acao=romance">Romance</a></li>
										<li id="menu-item-7171"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7171"><a
											href="index.php?acao=suspense">Suspense</a></li>
										<li id="menu-item-7172"
											class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7172"><a
											href="index.php?acao=terror">Terror</a></li>
									</ul>
								</div>
							</div>
							<div class="sidft"></div></li>
						<li></li>
					</ul>
				</div>
				<!--fim sidebar-->
			</div>
			<!-- fim direita -->

		</div>
	</div>

</body>
</html>