<?php
include "../conexao/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professor_id = $_POST['professor_id'];
    $disciplina_id = $_POST['disciplina_id'];
    $dia_semana = $_POST['dia_semana'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];

   
    $sql = "INSERT INTO horarios (professor_id, disciplina_id, dia_semana, hora_inicio, hora_fim) 
            VALUES (:professor_id, :disciplina_id, :dia_semana, :hora_inicio, :hora_fim)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':professor_id' => $professor_id,
        ':disciplina_id' => $disciplina_id,
        ':dia_semana' => $dia_semana,
        ':hora_inicio' => $hora_inicio,
        ':hora_fim' => $hora_fim
    ]);
}


$stmt_horarios = $pdo->query("
    SELECT h.*, p.nome AS professor_nome, d.nome AS disciplina_nome 
    FROM horarios h
    JOIN professores p ON h.professor_id = p.id
    JOIN disciplinas d ON h.disciplina_id = d.id
");

$horarios = $stmt_horarios->fetchAll(PDO::FETCH_ASSOC);


$stmt_disciplinas = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt_disciplinas->fetchAll(PDO::FETCH_ASSOC);

$stmt_professores = $pdo->query("SELECT id, nome FROM professores");
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/horarios.css" media="screen" />
    <title>Gerenciar Horários</title>
</head>
<body>
<div class="menu">
        <a href="../cadastro/disciplinas.php">Cadastrar Disciplina</a>
        <a href="../cadastro/professores.php">Cadastrar Professor</a>
    </div>
    <div id="container">
<h2>Adicionar Horário</h2>
<form method="POST">
    <label for="professor_id">Professor:</label>
    <select name="professor_id" required>
        <?php foreach ($professores as $professor): ?>
            <option value="<?php echo $professor['id']; ?>"><?php echo $professor['nome']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="disciplina_id">Disciplina:</label>
    <select name="disciplina_id" required>
        <?php foreach ($disciplinas as $disciplina): ?>
            <option value="<?php echo $disciplina['id']; ?>"><?php echo $disciplina['nome']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="dia_semana">Dia da Semana:</label>
    <input type="text" name="dia_semana" required placeholder="Ex: Segunda-feira">

    <label for="hora_inicio">Hora de Início:</label>
    <input type="time" name="hora_inicio" required>

    <label for="hora_fim">Hora de Fim:</label>
    <input type="time" name="hora_fim" required>

    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Horários</h2>
<ul>
    <?php foreach ($horarios as $horario): ?>
        <li>
            <?php echo $horario['professor_nome'] . " - " . $horario['disciplina_nome'] . 
            " (" . $horario['dia_semana'] . " de " . $horario['hora_inicio'] . " até " . $horario['hora_fim'] . ")"; ?>
        </li>
    <?php endforeach; ?>
</ul>
</div>
</body>
</html>
