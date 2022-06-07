<div id="painel-principal">

		<div id="logo"></div>

		<nav>
			<ul>
				<li><a href="http://localhost/browser-game">Página inicial</a></li>
				<li><a href="?pagina=cadastrar">Cadastrar</a></li>
				<li><a href="?pagina=jogo">Jogo</a></li>
			</ul>
		</nav>

<div style="text-align: center;">
	
<?php

	// Verifica se o botão de login foi pressionado
	if(isset($_POST['login'])) {

		$email = $_POST['email'];
		$senha = $_POST['senha'];

	// Verifica se o e-mail e senha estão corretos
	$verificaLogin = mysqli_query($con, "SELECT email, senha FROM usuarios WHERE email = '$email' AND senha = '$senha'");

	// Verifica se foi encontrado algum usuário e senha corretos
	if(mysqli_num_rows($verificaLogin) >0 ) {
		echo 'Login realizado com sucesso!';
	// Define a sessão do usuário
		$_SESSION['usuario'] = $email;
	// Redireciona para a página inicial do jogo.
		header("location: http://localhost/browser-game/?pagina=jogo");
	} else {
		echo 'Usuário ou senha incorretos.';
	}
}

?>

</div>

		<!-- Formulário de Login -->
		<form action="" method="post" id="painel-login">
			<label for="email">Usuário</label>
			<input type="text" name="email" id="email" />
			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha" />
			<input type="submit" value="Login" id="botao-login" name="login" />
		</form>

	</div>