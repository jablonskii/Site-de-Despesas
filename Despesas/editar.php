<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexao.php';
$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM despesas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuario_id]);
$despesa = $stmt->fetch();

if (!$despesa) {
    die("Despesa não encontrada ou acesso negado.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Despesa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Editar Despesa</h1>
    
    <form method="post" action="pr_editar.php">
        <input type="hidden" name="id" value="<?= $despesa['id'] ?>">
        
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" value="<?= htmlspecialchars($despesa['descricao']) ?>" required>
        </div>
        <div>
            <label for="valor">Valor (R$):</label>
            <input type="number" step="0.01" id="valor" name="valor" value="<?= htmlspecialchars($despesa['valor']) ?>" required>
        </div>
        <div>
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($despesa['categoria']) ?>">
        </div>
        <div>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" value="<?= htmlspecialchars($despesa['data']) ?>" required>
        </div>
        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="index.php">Voltar para a lista</a>
</body>
</html>