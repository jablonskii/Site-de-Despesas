<?php
session_start(); 

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Login</h1>
    
    <?php if(isset($_GET['erro'])): ?>
        <p style="color:red;">Email ou senha inválidos!</p>
    <?php endif; ?>
     <?php if(isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso'): ?>
        <p style="color:green;">Cadastro realizado com sucesso! Faça o login.</p>
    <?php endif; ?>

    <form method="post" action="pr_login.php">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
    <br>
    <a href="cadastrar.php">Não tem uma conta? Cadastre-se</a>
</body>
</html>