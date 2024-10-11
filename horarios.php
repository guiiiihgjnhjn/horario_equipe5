<?php
include "db.php";

$stmt = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_professores = $pdo->query("SELECT id, nome FROM professores");
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/horarios.css" media="screen" />

    <title>Document</title>
</head>
<body>
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




</body>
</html>

