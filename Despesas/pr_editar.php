<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];
    $usuario_id = $_SESSION['usuario_id'];
    
    try {
        // A query UPDATE também verifica o usuario_id para segurança
        $stmt = $conn->prepare("UPDATE despesas SET descricao = ?, valor = ?, categoria = ?, data = ? WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$descricao, $valor, $categoria, $data, $id, $usuario_id]);
        
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao editar despesa: " . $e->getMessage();
    }
}
?>