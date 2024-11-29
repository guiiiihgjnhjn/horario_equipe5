<?php
require_once '../conexao/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if ($nome && $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO professores (nome, senha) VALUES (:nome, :senha)");
        if ($stmt->execute([':nome' => $nome, ':senha' => $senhaHash])) {
            header('Location: ../cadastro/professores.php');
            exit; 
        } else {
            echo "Erro ao adicionar professor.";
        }
    } else {
        echo "Nome ou senha inválidos.";
    }
}
?>