<?php
require_once '../conexao/db.php';

// Adiciona um novo professor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if ($nome && $senha) {
        // Hash da senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO professores (nome, senha) VALUES (:nome, :senha)");
        if ($stmt->execute([':nome' => $nome, ':senha' => $senhaHash])) {
            // Redireciona para a página index após sucesso
            header('Location: ../cadastro/professores.php');
            exit; // Certifique-se de encerrar o script após o redirecionamento
        } else {
            echo "Erro ao adicionar professor.";
        }
    } else {
        echo "Nome ou senha inválidos.";
    }
}
?>