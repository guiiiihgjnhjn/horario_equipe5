<?php
require_once 'conexao/db.php';

// Puxa lista de professores
$stmt_professores = $pdo->query("SELECT * FROM professores");
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);

// Puxa lista de disciplinas
$stmt_disciplinas = $pdo->query("SELECT * FROM disciplinas");
$disciplinas = $stmt_disciplinas->fetchAll(PDO::FETCH_ASSOC);

// Puxa lista de horários com informações de professores e disciplinas
$stmt_horarios = $pdo->query("
    SELECT h.*, p.nome AS professor_nome, d.nome AS disciplina_nome
    FROM horarios h
    INNER JOIN professores p ON h.professor_id = p.id
    INNER JOIN disciplinas d ON h.disciplina_id = d.id
");
$horarios = $stmt_horarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Tudo</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Visualizar Tudo</h1>

    <!-- Professores -->
    <h2>Professores</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professores as $professor): ?>
                <tr>
                    <td><?php echo $professor['id']; ?></td>
                    <td><?php echo $professor['nome']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Disciplinas -->
    <h2>Disciplinas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disciplinas as $disciplina): ?>
                <tr>
                    <td><?php echo $disciplina['id']; ?></td>
                    <td><?php echo $disciplina['nome']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Horários -->
    <h2>Horários</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Dia da Semana</th>
                <th>Hora de Início</th>
                <th>Hora de Fim</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horarios as $horario): ?>
                <tr>
                    <td><?php echo $horario['id']; ?></td>
                    <td><?php echo $horario['professor_nome']; ?></td>
                    <td><?php echo $horario['disciplina_nome']; ?></td>
                    <td><?php echo $horario['dia_semana']; ?></td>
                    <td><?php echo $horario['hora_inicio']; ?></td>
                    <td><?php echo $horario['hora_fim']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

