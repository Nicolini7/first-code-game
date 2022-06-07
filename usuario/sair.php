<?php

//Iniciar sessão de usuário novamente.
session_start();
//Encerrar a sessão do usuário.
unset($_SESSION['usuario']);

// Redireciona para a página inicial.
header("Location: http://localhost/browser-game");

?>