<?php
session_start(); // Inicia a sessão para poder destruí-la

// Remove todas as variáveis da sessão
$_SESSION = array();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: login.php");
exit();
?>