<?php
session_start();
require_once '../includes/conecao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit;
}

// Obtém o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

// Inicializa a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

// Prepara e executa a query para excluir o usuário
$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    // Redireciona para a página de login após a exclusão
    session_destroy(); // opcional: destrói todas as sessões
    header("Location: ../pages/index.php");
    exit;
} else {
    echo "Erro ao excluir usuário.";
}
?>
