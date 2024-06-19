<?php
require '../includes/conecao.php';
require '../includes/functions.php';

session_start();
if (!isset($_SESSION['pending_user_id'])) {
    header('Location: ../pages/login.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $authData = sanitizeInput($_POST['auth-data']);
    
    $db = new Database();
    $pdo = $db->getConnection();
    $userId = $_SESSION['pending_user_id'];

    $user = verify2FA($pdo, $userId, $authData);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome_completo'];
        $_SESSION['user_nivel_acesso'] = $user['nivel_acesso'];
        unset($_SESSION['pending_user_id']); // Remover 'pending_user_id' após autenticação bem-sucedida
        header('Location: ../pages/index.php');
        exit;
    } else {
        $errors[] = 'Dados de autenticação inválidos.';
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../pages/2fa.php');
    exit;
}
?>