<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    die("Acesso negado. Por favor, faça login.");
}

include 'conexao.php';
$usuario_id = $_SESSION['usuario_id'];

$filename = 'relatorio_despesas_' . date('Y-m-d') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

fputs($output, "\xEF\xBB\xBF");

$cabecalho = ['Descricao', 'Valor (R$)', 'Categoria', 'Data'];
fputcsv($output, $cabecalho, ';');

try {
    $stmt = $conn->prepare("SELECT descricao, valor, categoria, DATE_FORMAT(data, '%d/%m/%Y') as data_formatada FROM despesas WHERE usuario_id = ? ORDER BY data DESC");
    $stmt->execute([$usuario_id]);

    while ($despesa = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $despesa['valor'] = number_format($despesa['valor'], 2, ',', '.');
        
        fputcsv($output, $despesa, ';');
    }

} catch(PDOException $e) {
    fputcsv($output, ['Erro ao gerar relatorio: ' . $e->getMessage()], ';');
}

// 8. Fecha o ponteiro
fclose($output);
exit();
?>