	<div id="painel-principal">

		<div id="logo"></div>

		<nav>
			<ul>
				<li><a href="http://localhost/browser-game">Página inicial</a></li>
				<li><a href="http://localhost/browser-game/usuario/sair.php">Sair</a></li>
			</ul>
		</nav>

		<div id="painel-personagem">

			<?php
			// Busca os dados do personagem
			$buscaPersonagem = mysqli_query($con, "SELECT * FROM personagens WHERE personagemid = 1");
			// Armazena os dados do personagem em uma array.
			$dadosPersonagem = mysqli_fetch_array($buscaPersonagem);

			// Armazena a vida atual do personagem.
			$vidaAtual = $dadosPersonagem['vida'];
			// Armazena a vida total do personagem.
			$vidaTotal = $dadosPersonagem['vida_maxima'];
			// Porcentagem de vida do personagem.
			$porcentagemVida = ($vidaAtual/$vidaTotal)*100;
			// Verifica se a vida do personagem está menor que 0.
			if($porcentagemVida <= 0) {
			// Define a vida como 0.
				$porcentagemVida = 0;
			}

			// Busca o level do personagem.
			$level = $dadosPersonagem['level'];
			?>

		<div class="avatar">
			Level <?php echo $level; ?>
		</div>

			<div class="barra" id="vida">
				<div id="vida-atual" style="width:<?php echo $porcentagemVida; ?>%"><?php echo "Vida Atual ", $vidaAtual . '/' . $vidaTotal; ?></div>
			</div>

			<?php
			// Busca os dados do personagem
			$buscaPersonagem = mysqli_query($con, "SELECT * FROM personagens WHERE personagemid = 1");
			// Armazena os dados do personagem em uma array.
			$dadosPersonagem = mysqli_fetch_array($buscaPersonagem);
			
			// Armazena a experiência atual do personagem.
			$expAtual = $dadosPersonagem['experiencia'];
			// Armazena a experiência total do personagem.
			$expTotal = $dadosPersonagem['experiencia_maxima'];
			// Porcentagem de experiência do personagem.
			$porcentagemExp = ($expAtual/$expTotal)*100;
			// Verifica se a experiência do personagem está menor que 0.
			if($porcentagemExp <= 0) {
			// Define a experiência como 0.
				$porcentagemExp = 0;
			}
			?>

			<div class="barra" id="experiencia">
				<div id="experiencia-atual" style="width:<?php echo $porcentagemExp; ?>%"><?php echo "Experiência Atual ", $expAtual . '/' . $expTotal; ?></div>
			</div>

		</div>

	<div id="painel-batalha">

			<a href="?pagina=oponente&id=1">
				<span class="oponente-avatar">Oponente 1</span>
			</a>
			<div id="acoes-batalha">
			<form action="" method="post">
				<input type="submit" name="atacar" value="atacar" />
			</form>

<?php
if(isset($_POST['atacar'])) {
	
	// Obtêm o ID do oponente para especificar quem leva dano.
	$idOponente = $_GET['id'];

	////////// Ataque do personagem //////////

	$Ataque0 = rand(1,10);
	$Ataque1 = rand(20,30);
	$Ataque2 = rand(40,50);
	$Ataque3 = rand(60,70);
	$Ataque4 = rand(80,100);
	// Cria uma array para agrupar os ataques.
	$atk = ["$Ataque0", "$Ataque1", "$Ataque2", "$Ataque3", "$Ataque4"];
	// Seleciona um dos ataques da array.
	$selectSkill = array_rand($atk);
	// Define o valor do ataque selecionado randomicamente.
	$usaSkill = $atk[$selectSkill];

	// Número randômico para definir se o personagem acertou o golpe.
	$testeAcerto = rand(0, 100);

	echo "<br /><p>--- Personagem ---</p>";

	// Define a chance de acerto do golpe do personagem.
	if($testeAcerto >= 1) {

		// Define quanto de dano foi tirado no golpe.
		$danoTirado = rand(50, 100);
		// Atualiza a vida do oponente no banco de dados.
		mysqli_query($con, "UPDATE oponentes SET vida = vida-$usaSkill WHERE oponenteid = $idOponente");

		echo "Causou $usaSkill de dano.<br />";
		echo "Acertou o ataque de número $testeAcerto.<br />";
		echo "Usou o ataque $selectSkill.<br />";

	} else {
		echo "Errou o ataque de número $testeAcerto e não causou dano.<br />";
	}
	// Busca os dados do oponente.
	$buscaOponente = mysqli_query($con, "SELECT * FROM oponentes WHERE oponenteid = $idOponente");
	// Armazena os dados do oponente em uma array.
	$dadosOponente = mysqli_fetch_array($buscaOponente);
	
	////////// Ataque do oponente //////////

	// Número randômico para definir se o oponente acertou o golpe.
	$testeAcertoOponente = rand(0, 100);

	echo "<br /><p>--- Oponente ---</p>";

	// Define a chance de acerto do golpe do oponente.
	if($testeAcertoOponente > 50) {

		// Define quanto de dano foi tirado no golpe.
		$danoTiradoOponente = rand(10, 100);
		// Atualiza a vida do oponente no banco de dados.
		mysqli_query($con, "UPDATE personagens SET vida = vida-$danoTirado WHERE personagemid = 1");

		echo "Causou $danoTirado de dano.<br />";
		echo "Acertou o ataque de número $testeAcertoOponente.<br />";

	} else {
		echo "Errou o ataque de número $testeAcerto e não causou dano.<br />";
	}
	// Busca os dados do personagem
	$buscaPersonagem = mysqli_query($con, "SELECT * FROM personagens WHERE personagemid = 1");
	// Armazena os dados do personagem em uma array.
	$dadosPersonagem = mysqli_fetch_array($buscaPersonagem);
	// Verifica se a vida do personagem está menor que 0.
	if($dadosPersonagem['vida'] <= 0) {
		echo 'Que pena, você foi derrotado!<br />';
	}

	// Verifica se a vida do oponente é menor que 0.
	if($dadosOponente['vida'] <= 0) {

		// Define a quantidade de experência que o personagem vai ganhar ao derrotar o oponente.
		$expGanha = rand(50, 100);

		// Atualiza a experiência do personagem no banco de dados.
		mysqli_query($con, "UPDATE personagens SET experiencia = experiencia+$expGanha WHERE personagemid = 1");

		// Verifica se o personagem passou de level.
		if($expAtual + $expGanha >= $expTotal) {
			// Nova experiência do personagem.
			$novaExp = ($expAtual + $expGanha) - $expTotal;

		// Atualiza a nova experiência do personagem no banco de dados.
		mysqli_query($con, "UPDATE personagens SET experiencia = $novaExp, level = level+1, experiencia_maxima = ($level+1)*100, vida = $vidaTotal WHERE personagemid = 1");
		}

		echo 'O oponente foi derrotado e você ganhou ' . $expGanha . ' pontos de experiência!<br />';
	}

}
?>
			</div>

	</div>

	</div>