<?php
include_once 'Model/Modelo/Usuario.php';
include_once 'Model/DAO/UsuarioDAO.php';
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

		<h2>Cadastrar de Usuario</h2>

<?php
if (! empty ( $_POST )) {
	
	if (empty ($_POST ['login']) || empty ($_POST ['email']) || empty ($_POST ['senha']) || empty ($_POST ['senha_comfirma'])) { 
			?> <font size="15px" color="red"> Campos vazio não permitido! </font> <?php
		} else {
			
		$login = $_POST ['login'];
		$login = strtolower($login);
		$email = $_POST ['email'];
		$email = strtolower($email);
		$senha = $_POST ['senha'];
		$senha = strtolower($senha);
		$senha_comfirma = $_POST ['senha_comfirma'];
		$senha_comfirma = strtolower($senha_comfirma);
		
		if ($senha !== $senha_comfirma){
			?> <font size="15px" color="red"> Senhas n�o comferem, tente novamente! </font> <?php
		} else {
		
			$usuDAO = new UsuarioDAO();
			$result = $usuDAO->VerificaDadosCadastrado($login, $email);
			
			if (!empty($result['login'])){
				?> <font size="15px" color="red"> Existe um usuario com esse login, escolha outro! </font> <?php
			} else if (!empty($result['email'])){
				?> <font size="15px" color="red"> Existe um usuario com esse email, escolha outro! </font> <?php
			} else {
			
				$usuario = new Usuario();
				$usuario->login = $login;
				$usuario->email = $email;
				$usuario->senha = $senha;
				$usuario->comfirmar_senha = $senha_comfirma;
					
				$usuDAO = new UsuarioDAO();
				$res = $usuDAO->cadastrar($usuario);
					
				if ($res){
						?> <script type="text/javascript">  alert('Usuario cadastrado com sucesso!'); window.location.assign('index.php'); </script> <?php
				} else {
						?> <font size="15px" color="red"> Ocorreu erro ao cadastra o usuario, erro: <?php print_r($res); ?> </font> <?php
				}
				
			}
			
		}
		
	}
			
}
?>
			<form action="" method="post">
				<label class="cadastradoUsuarioNome"> Informe seu login </label> 
				<input type="text" name="login" class="cadastroUsuarioInput" /><br> 
				<label class="cadastradoUsuarioNome"> Informe seu email </label> 
				<input type="email" name="email"  class="cadastroUsuarioInput"/><br> 
				<label class="cadastradoUsuarioNome"> Informe sua senha </label>
				<input type="password" name="senha"  class="cadastroUsuarioInput"/><br> 
				<label class="cadastradoUsuarioNome"> Comfirme sua senha </label><br>
				<input type="password" name="senha_comfirma"  class="cadastroUsuarioInput"/><br> 
				<input type="submit" value="Cadastrar Filme" class="CadastroUsuariobtn">
			</form>
			
		<a href="index.php" class="CadastroUsuariolink">Voltar a pagina inicial</a>

	</div>
</div>
<!-- fim slogan -->

</body>
</html>