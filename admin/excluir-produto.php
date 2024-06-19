<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

// Verificar se o parâmetro id foi fornecido na URL
if (!isset($_GET['id'])) {
    echo "ID do produto não especificado.";
    exit;
}

$id = $_GET['id'];

try {
    // Inicializar a conexão com o banco de dados
    $db = new Database();
    $pdo = $db->getConnection();

    // Preparar a query SQL para excluir o produto
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a query
    if ($stmt->execute()) {
        // Redirecionar para a página de cadastro de produtos após a exclusão
        header("Location: ../admin/cadastro-produto.php");
        exit;
    } else {
        echo "Erro ao excluir o produto.";
    }
} catch (PDOException $e) {
    echo "Erro ao tentar excluir o produto: " . $e->getMessage();
}
?>
