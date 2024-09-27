<?php
require_once 'db.php';

// Adiciona uma nova disciplina
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $stmt = $pdo->prepare("INSERT INTO disciplinas (nome) VALUES (?)");
    $stmt->execute([$nome]);
}

// Exibe a lista de disciplinas
$stmt = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Adicionar Disciplina</h2>
<form method="POST">
    Nome: <input type="text" name="nome" required>
    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Disciplinas</h2>
<ul>
    <?php foreach ($disciplinas as $disciplina): ?>
        <li><?php echo $disciplina['nome']; ?></li>
    <?php endforeach; ?>
    
</ul>
