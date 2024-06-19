<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

session_start();

// Verificar se o usuário está logado e capturar o nome de usuário antes de destruir a sessão
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];

    // Conectar ao banco de dados
    $db = new Database();
    $pdo = $db->getConnection();

    // Registrar a atividade de logout
    $stmt = $pdo->prepare("INSERT INTO log_atividades (usuario, atividade, data_hora) VALUES (:usuario, 'logout', NOW())");
    $stmt->bindParam(':usuario', $user_name, PDO::PARAM_STR);
    $stmt->execute();
}

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login
header('Location: ../pages/login.php');
exit;
?>
