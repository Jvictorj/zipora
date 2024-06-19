<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

session_start();

$errors = [];
$login = $_POST['login'];
$senha = $_POST['senha'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos
    if (empty($login) || empty($senha)) {
        $errors[] = "Login e senha são obrigatórios.";
    }

    // Verificar se o usuário existe
    if (empty($errors)) {
        $db = new Database();
        $pdo = $db->getConnection();
        $user = loginUser($pdo, $login, $senha);

        if ($user) {
            $_SESSION['pending_user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['login']; // ou $user['nome_completo'], dependendo de como você quer exibir o nome

            // Registrar a atividade de login
            $stmt = $pdo->prepare("INSERT INTO log_atividades (usuario, atividade, data_hora) VALUES (:usuario, 'login', NOW())");
            $stmt->bindParam(':usuario', $user['login'], PDO::PARAM_STR);
            $stmt->execute();

            // Redirecionar para a página de 2FA
            header('Location: ../pages/2fa.php');
            exit;
        } else {
            $_SESSION['errors'] = ['Login ou senha incorretos'];
            header('Location: ../pages/login.php');
            exit;
        }
    }
}

// Se houver erros, redirecionar de volta para a página de login com os erros
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../pages/login.php');
    exit;
}
?>