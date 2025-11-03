<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Crie sua Conta</h1>
    
    <form method="post" action="pr_cadastro.php">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="login.php">Já tem uma conta? Faça login</a>
</body>
</html>