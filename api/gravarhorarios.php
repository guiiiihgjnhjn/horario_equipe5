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