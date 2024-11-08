<?php
// Incluir a conexão com o banco de dados
require_once '../conexao/db.php';

// Verifica se o formulário foi enviado para adicionar um novo horário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletando os dados do formulário
    $professor_id = $_POST['professor_id'];
    $disciplina_id = $_POST['disciplina_id'];
    $dia_semana = $_POST['dia_semana'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];

    // Validar se todos os campos foram preenchidos
    if (!empty($professor_id) && !empty($disciplina_id) && !empty($dia_semana) && !empty($hora_inicio) && !empty($hora_fim)) {
        // Preparar e executar a consulta de inserção
        $stmt = $pdo->prepare("INSERT INTO horarios (professor_id, disciplina_id, dia_semana, hora_inicio, hora_fim) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$professor_id, $disciplina_id, $dia_semana, $hora_inicio, $hora_fim]);

        // Redirecionar para evitar o reenvio do formulário após o refresh da página
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color:red;'>Todos os campos são obrigatórios!</p>";
    }
}

// Exibir a lista de horários
$stmt = $pdo->query("SELECT h.*, p.nome AS professor_nome, d.nome AS disciplina_nome 
                     FROM horarios h
                     JOIN professores p ON h.professor_id = p.id
                     JOIN disciplinas d ON h.disciplina_id = d.id");
$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Puxar a lista de professores e disciplinas
$professores = $pdo->query("SELECT * FROM professores")->fetchAll(PDO::FETCH_ASSOC);
$disciplinas = $pdo->query("SELECT * FROM disciplinas")->fetchAll(PDO::FETCH_ASSOC);
?>
