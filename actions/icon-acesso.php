<?php
require_once '../includes/conecao.php'; // Verifique se o caminho está correto
require_once '../includes/functions.php'; // Verifique se o caminho está correto

session_start();

$response = ['success' => false, 'level' => ''];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $db = new Database();
    $pdo = $db->getConnection();
    
    $stmt = $pdo->prepare("SELECT nivel_acesso FROM usuarios WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $response['success'] = true;
        $response['level'] = $user['nivel_acesso']; // Assume que 'nivel_acesso' contém 'cliente' para usuários comuns
    }
}

echo json_encode($response);
?>
