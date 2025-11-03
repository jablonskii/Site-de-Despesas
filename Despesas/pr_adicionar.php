<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = trim($_POST['descricao']); 
    $valor = $_POST['valor'];
    $categoria = trim($_POST['categoria']);
    $data = $_POST['data'];
    $usuario_id = $_SESSION['usuario_id'];
    
    $erros = []; 
    
    if (empty($descricao)) {
        $erros[] = "O campo 'descrição' é obrigatório.";
    }
    
    if (empty($valor)) {
        $erros[] = "O campo 'valor' é obrigatório.";
    } elseif (!is_numeric($valor) || $valor < 0) {
        $erros[] = "O valor deve ser um número positivo.";
    }

    if (empty($data)) {
        $erros[] = "O campo 'data' é obrigatório.";
    }
    
    if (!empty($erros)) {
        $_SESSION['erros_despesa'] = $erros;
        header("Location: adicionar_despesa.php");
        exit();
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO despesas (descricao, valor, categoria, data, usuario_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$descricao, $valor, $categoria, $data, $usuario_id]);
        
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao adicionar despesa: " . $e->getMessage();
    }
}
?>