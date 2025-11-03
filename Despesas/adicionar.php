<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Despesa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Adicionar Nova Despesa</h1>

    <?php
    $data_atual = date('Y-m-d'); 
    if (isset($_SESSION['erros_despesa']) && !empty($_SESSION['erros_despesa'])) {
        echo '<div class="error-box">';
        foreach ($_SESSION['erros_despesa'] as $erro) {
            echo '<p>' . htmlspecialchars($erro) . '</p>';
        }
        echo '</div>';
        
        unset($_SESSION['erros_despesa']);
    }
    ?>
    
    <form method="post" action="pr_adicionar.php">
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
        </div>
        <div>
            <label for="valor">Valor (R$):</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
        </div>
         <div>
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria">
        </div>
        <div>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" value="<?= htmlspecialchars($data_atual) ?>" required>
        </div>
        <button type="submit">Adicionar</button>
    </form>
    <br>
    <a href="index.php">Voltar para a lista</a>
</body>
</html>