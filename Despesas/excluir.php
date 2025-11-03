<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM despesas WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $usuario_id]);
        
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao excluir despesa: " . $e->getMessage();
    }
}
?>