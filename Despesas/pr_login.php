<?php
session_start(); // Sempre inicie a sessão
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Busca o usuário pelo email
    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Armazena o ID do usuário na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        
        // Redireciona para o painel principal
        header("Location: index.php");
        exit();
    } else {
        // Se as credenciais estiverem erradas, volta para a página de login com um erro
        header("Location: login.php?erro=1");
        exit();
    }
}
?>