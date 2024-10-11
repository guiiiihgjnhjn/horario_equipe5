<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de conexão com o banco de dados
include "db.php"; // Ajuste o caminho se necessário

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['usuario']; // Nome do usuário enviado pelo formulário
    $senha = $_POST['senha']; // Senha enviada pelo formulário

    // Prepara a consulta SQL
    $stmt = $pdo->prepare("SELECT * FROM professores WHERE nome = :nome");
    $stmt->execute([':nome' => $nome]);
    $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e a senha está correta
    if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) {
        // Armazena informações na sessão
        $_SESSION['usuario'] = $usuarioEncontrado['nome'];

        // Redireciona para a página desejada (por exemplo, index.php)
        header('Location: vizualizar_tudo.php');
        exit; // Encerra o script após o redirecionamento
    } else {
        // Mensagem de erro se as credenciais estiverem incorretas
        echo "Usuário ou senha incorretos.";
    }
}
?>
