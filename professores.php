<?php
require_once 'db.php';

// Adiciona um novo professor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $stmt = $pdo->prepare("INSERT INTO professores (nome) VALUES (?)");
    $stmt->execute([$nome]);
}

// Exibe a lista de professores
$stmt = $pdo->query("SELECT * FROM professores");
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Adicionar Professor</h2>
<form method="POST">
    Nome: <input type="text" name="nome" required>
    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Professores</h2>
<ul>
    <?php foreach ($professores as $professor): ?>
        <li><?php echo $professor['nome']; ?></li>
    <?php endforeach; ?>
</ul>
