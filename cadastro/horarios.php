<?php
// Incluir a lógica de backend (processamento de dados)

include "../conexao/db.php";

$stmt = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

</body>
</html>
