<?php

// Inicia a sessão no site
session_start();

// Conecta ao banco de dados
	$con = mysqli_connect("localhost", "root", "", "browser_game");
	
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Browser Game</title>

	<!-- Importações de arquivos CSS -->
	<link rel="stylesheet" type="text/css" href="visual/css/reset.css">
	<link rel="stylesheet" type="text/css" href="visual/css/style.css">
	<!-- Importações de arquivos JavaScript -->
	<!-- script src="CAMINHO_ARQUIVO_JAVASCRIPT"></script> -->

</head>
<body>

<?php

//Verifica se o parâmetro página está sendo passado na url
if(isset($_GET['pagina'])) {
	
	$pagina = $_GET['pagina'];

	//Se estiver sendo passado algum valor da página
	if($pagina != '') {

		//Se página for igual a cadastrar, inclui a página cadastrar.php
		if($pagina == 'cadastrar') {
			include 'usuario/cadastrar.php';
		//Se página for igual a jogo, inclui a página jogo.php
		} else if($pagina == 'jogo') {
			include 'usuario/jogo.php';
		//Se página for igual a oponente, inclui página oponente.php
		} else if($pagina == 'oponente') {
			include 'usuario/oponente.php';
		//Se não, inclui pagina-inicial.php
		} else {
		// Verifica se a sessão de usuário foi iniciada.
			if(isset($_SESSION['usuario'])) {
				include 'usuario/jogo.php';
			} else {
				include 'usuario/pagina-inicial.php';
			}
		}

	// Inclui a página inicial
	} else {
		// Verifica se a sessão de usuário foi iniciada.
			if(isset($_SESSION['usuario'])) {
				include 'usuario/jogo.php';
			} else {
				include 'usuario/pagina-inicial.php';
			}
}

// Se não, inclui pagina-inicial.php
} else {
// Verifica se a sessão de usuário foi iniciada.
			if(isset($_SESSION['usuario'])) {
				include 'usuario/jogo.php';
			} else {
				include 'usuario/pagina-inicial.php';
			}

}

?>

</body>
</html>