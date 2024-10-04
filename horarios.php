<?php
require_once 'db.php';

// Adiciona um novo horário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professor_id = $_POST['professor_id'];
    $disciplina_id = $_POST['disciplina_id'];
    $dia_semana = $_POST['dia_semana'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];

    $stmt = $pdo->prepare("
        INSERT INTO horarios (professor_id, disciplina_id, dia_semana, hora_inicio, hora_fim) 
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$professor_id, $disciplina_id, $dia_semana, $hora_inicio, $hora_fim]);
}

// Exibe a lista de horários
$stmt = $pdo->query("
    SELECT h.*, p.nome AS professor_nome, d.nome AS disciplina_nome 
    FROM horarios h
    JOIN professores p ON h.professor_id = p.id
    JOIN disciplinas d ON h.disciplina_id = d.id
");
$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Puxa lista de professores e disciplinas
$professores = $pdo->query("SELECT * FROM professores")->fetchAll(PDO::FETCH_ASSOC);
$disciplinas = $pdo->query("SELECT * FROM disciplinas")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Adicionar Horário</h2>
<form method="POST">
    Professor:
    <select name="professor_id">
        <?php foreach ($professores as $professor): ?>
            <option value="<?php echo $professor['id']; ?>"><?php echo $professor['nome']; ?></option>
        <?php endforeach; ?>
    </select>
    Disciplina:
    <select name="disciplina_id">
        <?php foreach ($disciplinas as $disciplina): ?>
            <option value="<?php echo $disciplina['id']; ?>"><?php echo $disciplina['nome']; ?></option>
        <?php endforeach; ?>
    </select>
    Dia da Semana: <input type="text" name="dia_semana" required>
    Hora de Início: <input type="time" name="hora_inicio" required>
    Hora de Fim: <input type="time" name="hora_fim" required>
    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Horários</h2>
<ul>
    <?php foreach ($horarios as $horario): ?>
        <li><?php echo $horario['professor_nome'] . " - " . $horario['disciplina_nome'] . " (" . $horario['dia_semana'] . " de " . $horario['hora_inicio'] . " até " . $horario['hora_fim'] . ")"; ?></li>
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

input[type="time"],
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