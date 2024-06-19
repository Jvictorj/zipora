<?php
session_start();
require_once('../includes/conecao.php'); // Ajuste o caminho conforme necessário
require_once('../includes/functions.php'); // Ajuste o caminho conforme necessário

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();


// Verificar se os dados necessários foram enviados pelo formulário
if (!isset($_POST['id_item']) || !isset($_POST['quantidade'])) {
    die("ID do item ou quantidade não fornecidos.");
}

$id_item = (int) $_POST['id_item'];
$quantidade = (int) $_POST['quantidade'];

// Preparar a instrução SQL para atualizar a quantidade do item no carrinho
$stmt = $pdo->prepare("UPDATE carrinho SET quantidade = ? WHERE id = ?");
if ($stmt->execute([$quantidade, $id_item])) {
    // Redirecionar de volta para o carrinho de compras
    header('Location: ../pages/carrinho.php');
    exit();
} else {
    // Adicionar mensagem de erro se a atualização falhar
    die("Falha ao atualizar a quantidade do item no carrinho.");
}
?>