<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexao.php';
$usuario_id = $_SESSION['usuario_id'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas Despesas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header>
        <div class="header-content">
            <div class="welcome-message">
                <h1>Gerenciador de Despesas</h1>
            </div>
            <a href="logout.php" class="logout-button">Sair</a>
        </div>
    </header>

    <div class="container">

        <div class="actions-container">
            <a href="adicionar.php" class="action-button">Adicionar Nova Despesa</a>
            <a href="gerar_relatorio.php" class="action-button">Gerar Relatório em Excel</a>
        </div>

        <h2>Suas Despesas</h2>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor (R$)</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT id, descricao, valor, categoria, DATE_FORMAT(data, '%d/%m/%Y') as data_formatada FROM despesas WHERE usuario_id = ? ORDER BY data DESC");
                $stmt->execute([$usuario_id]);
                
                while ($despesa = $stmt->fetch()):
                ?>
                <tr>
                    <td><?= htmlspecialchars($despesa['descricao']) ?></td>
                    <td><?= number_format($despesa['valor'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($despesa['categoria']) ?></td>
                    <td><?= $despesa['data_formatada'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $despesa['id'] ?>">Editar</a>
                        <a href="excluir.php?id=<?= $despesa['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta despesa?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div> </body>
</html>