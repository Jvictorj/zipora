<?php
function startSessionIfNotStarted() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function registerUser($pdo, $userData) {
    $stmt = $pdo->prepare('INSERT INTO usuarios (nome_completo, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, endereco_completo, login, senha_hash, nivel_acesso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute($userData);
}

function loginUser($pdo, $login, $senha) {
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE login = ? OR cpf = ?');
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && verifyPassword($senha, $user['senha_hash'])) {
        return $user;
    }
    return false;
}

function verify2FA($pdo, $userId, $authData) {
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ? AND (cpf = ? OR nome_materno = ?)');
    $stmt->execute([$userId, $authData, $authData]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ensureAdmin() {
    startSessionIfNotStarted();
    if (!isset($_SESSION['user_id']) || $_SESSION['user_nivel_acesso'] !== 'admin') {
        header('Location: ../login.php');
        exit;
    }
}

function ensureUser() {
    startSessionIfNotStarted();
    if (!isset($_SESSION['user_id']) || $_SESSION['user_nivel_acesso'] !== 'cliente') {
        header('Location: ../login.php');
        exit;
    }
}
?>
