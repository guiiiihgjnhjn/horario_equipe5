<?php
require_once '../conexao/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $professor_id = $_POST['professor'];

  
    $stmt = $pdo->prepare("INSERT INTO disciplinas (nome, id_professor) VALUES (?, ?)");
    if ($stmt->execute([$nome, $professor_id])) {
        echo "<p>Disciplina adicionada com sucesso!</p>";
    } else {
        echo "<p>Erro ao adicionar disciplina.</p>";
    }
}

$stmt = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_professores = $pdo->query("SELECT id, nome FROM professores");
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);
?>
