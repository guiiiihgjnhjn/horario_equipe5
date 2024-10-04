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