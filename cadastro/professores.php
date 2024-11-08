<?php
include '../conexao/db.php';
// Exibe a lista de professores
$stmt = $pdo->query("SELECT * FROM professores");
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/professores.css" media="screen" />

    <title>Document</title>
</head>
<body>
<h2>Adicionar Professor</h2>
<form method="POST" action="../api/gravarprofessores.php">
    Nome: <input type="text" name="nome" required>
    Senha: <input type="text" name="senha" id="senha">
    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Professores</h2>
<ul>
    <?php foreach ($professores as $professor): ?>
        <li><?php echo $professor['nome']; ?></li>
    <?php endforeach; ?>
</ul>


</body>
</html>

