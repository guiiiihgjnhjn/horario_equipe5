<?php
$host = 'localhost';
$db = 'escola_horarios';
$user = 'root'; // Usuário padrão do MySQL
$pass = '';     // Deixe a senha em branco se estiver usando a configuração padrão do XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
