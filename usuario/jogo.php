<?php
	// Busca os dados do personagem
	$buscaPersonagem = mysqli_query($con, "SELECT * FROM personagens WHERE personagemid = 1");
	// Armazena os dados do personagem em uma array.
	$dadosPersonagem = mysqli_fetch_array($buscaPersonagem);

?>

	<div id="painel-principal">

		<div id="logo"></div>

		<nav>
			<ul>
				<li><a href="http://localhost/browser-game">Página inicial</a></li>
				<li><a href="http://localhost/browser-game/usuario/sair.php">Sair</a></li>
			</ul>
		</nav>

		<div id="painel-personagem">

			<div class="avatar"></div>

			<?php
			// Armazena a vida atual do personagem.
			$vidaAtual = $dadosPersonagem['vida'];
			// Armazena a vida total do personagem.
			$vidaTotal = $dadosPersonagem['vida_maxima'];
			// Porcentagem de  vida do personagem.
			$porcentagemVida = ($vidaAtual/$vidaTotal)*100;
			// Verifica se a vida do personagem está menor que 0.
			if($porcentagemVida <= 0) {
			// Define a vida como 0.
				$porcentagemVida = 0;
			}
			?>

			<div class="barra" id="vida">
				<div id="vida-atual" style="width:<?php echo $porcentagemVida; ?>%"></div>
			</div>
			<div class="barra" id="experiencia">
				<div id="experiencia-atual" style="width: 0%"></div>
			</div>

		</div>

		<div id="painel-batalha">

			<a href="?pagina=oponente&id=1">
			<span class="oponente-avatar">Oponente 1</span>
			</a>
			<div class="oponente-avatar"></div>
			<div class="oponente-avatar"></div>

		</div>

	</div>
