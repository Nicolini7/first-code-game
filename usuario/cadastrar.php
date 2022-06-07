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

		// Conecta ao banco de dados
	$con = mysqli_connect("localhost", "root", "", "browser_game");
    
		// Se o botão de cadastrar for clicado
		if(isset($_POST['cadastrar'])) {

			$email = $_POST['email'];
			$senha = $_POST['senha'];
		
			if($email == '') {
				echo 'Digite um usuário.';
			} else if($senha == '') {
				echo 'Digite uma senha.';
			} else {

				// Verifica se o e-mail já foi cadastrado
			$sql = mysqli_query($con, "SELECT * FROM usuarios WHERE email = '{$email}'") or print mysql_error();

				// Verifica se foi encontrado algum e-mail
				if(mysqli_num_rows($sql)>0) {
					echo 'O usuário <b>' . $email . '</b> já foi cadastrado, escolha outro!';
				} else {

					// Insere o usuário
				$inserirUsuario = mysqli_query($con, "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')");
				
				// Verifica se o usuário foi inserido com sucesso
				if($inserirUsuario) {
					echo 'Cadastro realizado com sucesso!';
				} else {
					echo 'Ocorreu um erro no cadastro.';
				}			
			}
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
			<input type="submit" value="Cadastrar" id="botao-cadastrar" name="cadastrar" />
		</form>

	</div>
