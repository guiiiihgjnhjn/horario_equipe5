<?php
include '../conexao/db.php';
$stmt = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_professores = $pdo->query("SELECT id, nome FROM professores");
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/disciplinas.css" media="screen" />

    <title>Adicionar Disciplina</title>
</head>
<body>
<div class="menu">
        <a href="horarios.php">Cadastrar Horário</a>
       
        <a href="professores.php">Cadastrar Professor</a>
    </div>
    <div id="container">
<h2>Adicionar Disciplina</h2>
<form method="POST" action="../api/gravardisciplinas.php">
    Nome: <input type="text" name="nome" required>
    Professor: 
    <select id="professor" name="professor" required>
        <?php if (!empty($professores)): ?>
            <?php foreach ($professores as $professor): ?>
                <option value="<?php echo htmlspecialchars($professor['id']); ?>">
                    <?php echo htmlspecialchars($professor['nome']); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">Nenhum professor encontrado</option>
        <?php endif; ?>
    </select>
    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Disciplinas</h2>
<ul>
    <?php foreach ($disciplinas as $disciplina): ?>
        <li><?php echo htmlspecialchars($disciplina['nome']); ?></li>
    <?php endforeach; ?>
</ul>
</div>
</body>
</html>
