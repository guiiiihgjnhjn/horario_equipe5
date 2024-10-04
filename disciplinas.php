<?php
require_once 'db.php'; // Certifique-se de que 'db.php' contém a configuração do PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $professor_id = $_POST['professor'];

    // Inserir disciplina no banco de dados
    $stmt = $pdo->prepare("INSERT INTO disciplinas (nome, id_professor) VALUES (?, ?)");
    if ($stmt->execute([$nome, $professor_id])) {
        echo "<p>Disciplina adicionada com sucesso!</p>";
    } else {
        echo "<p>Erro ao adicionar disciplina.</p>";
    }
}

// Recuperar disciplinas
$stmt = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Recuperar professores
$stmt_professores = $pdo->query("SELECT id, nome FROM professores");
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Disciplina</title>
</head>
<body>

<h2>Adicionar Disciplina</h2>
<form method="POST">
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

</body>
</html>
 <style>
/* styles.css */

/* Estilos gerais do corpo */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 20px;
    margin-left: 682px;
    padding: 20px;
}

/* Estilo para os cabeçalhos */
h2 {
    color: #333;
}

/* Estilo do formulário */
form {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    width: 600px;
}

/* Estilo para os inputs e select */
input[type="text"],
select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Estilo para o botão */
button {
    background-color:#1C1C1C;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #218838;
}

/* Estilo para a lista de disciplinas */
ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    background: #e9ecef;
    margin: 5px 0;
    padding: 10px;
    border-radius: 4px;
    width: 600px;
}

/* Mensagens de feedback */
p {
    font-size: 16px;
    color: #28a745;
}

</style>