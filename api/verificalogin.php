<?php  
session_start(); 

include "../conexao/db.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING); 
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING); 

    if (empty($nome) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM professores WHERE nome = :nome");
    $stmt->execute([':nome' => $nome]);
    $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioEncontrado) {
        if (password_verify($senha, $usuarioEncontrado['senha'])) {
            $_SESSION['usuario'] = $usuarioEncontrado['nome'];

            header('Location: ../vizualizar_tudo.php');
            exit;
        } else {
            echo "Usuário ou senha incorretos.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
