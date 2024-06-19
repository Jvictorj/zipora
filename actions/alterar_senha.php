<?php
session_start();
require_once '../includes/conecao.php'; // Verifique se este caminho está correto
require_once '../includes/functions.php'; // Verifique se este caminho está correto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos foram preenchidos
    if (isset($_POST['nova_senha']) && isset($_POST['confirmar_nova_senha'])) {
        $novaSenha = $_POST['nova_senha'];
        $confirmarNovaSenha = $_POST['confirmar_nova_senha'];

        // Verifica se as senhas coincidem
        if ($novaSenha === $confirmarNovaSenha) {
            // Obter o ID do usuário da sessão
            $user_id = $_SESSION['user_id'];

            // Inicializar a conexão com o banco de dados
            $db = new Database();
            $pdo = $db->getConnection();

            // Hash da nova senha
            $hashed_password = password_hash($novaSenha, PASSWORD_DEFAULT);

            // Atualizar a senha no banco de dados
            $stmt = $pdo->prepare("UPDATE usuarios SET senha_hash = :senha WHERE id = :user_id");
            $stmt->bindParam(':senha', $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Redirecionar para uma página de sucesso ou mensagem
                header("Location:../pages/login.php?success=true");
                exit;
            } else {
                // Tratar erros de atualização
                echo "Erro ao atualizar a senha. Por favor, tente novamente.";
            }
        } else {
            // Senhas não coincidem, exibir mensagem de erro
            echo "As senhas não coincidem. Por favor, tente novamente.";
        }
    } else {
        // Campos não preenchidos, exibir mensagem de erro
        echo "Por favor, preencha todos os campos.";
    }
}
?>
