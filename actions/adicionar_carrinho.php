<?php
session_start();
require_once('../includes/conecao.php');  // Certifique-se de que o caminho está correto
require_once('../includes/functions.php');  // Ajuste o caminho se necessário

// Inicializar a conexão com o banco de dados
$db = new Database();  // Certifique-se de que a classe Database está sendo carregada corretamente
$pdo = $db->getConnection();

// Verifique se o ID do produto e a quantidade foram enviados via POST
if (!isset($_POST['id_produto']) || !isset($_POST['quantidade'])) {
    // Redirecione para a página de produtos com uma mensagem de erro
    header('Location: ../produtos.php?error=missing_data');
    exit();
}

$id_produto = (int)$_POST['id_produto'];
$quantidade = (int)$_POST['quantidade'];

// Verifique se a quantidade é válida
if ($quantidade <= 0) {
    // Redirecione para a página de produtos com uma mensagem de erro
    header('Location: ../produtos.php?error=invalid_quantity');
    exit();
}

// Verifique se o produto já está no carrinho
$stmt = $pdo->prepare("SELECT * FROM carrinho WHERE id_produto = ? AND id_sessao = ?");
$stmt->execute([$id_produto, session_id()]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($item) {
    // Se o produto já está no carrinho, atualize a quantidade
    $nova_quantidade = $item['quantidade'] + $quantidade;
    $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = ? WHERE id = ?");
    $stmt->execute([$nova_quantidade, $item['id']]);
} else {
    // Se o produto não está no carrinho, insira um novo item
    $stmt = $pdo->prepare("INSERT INTO carrinho (id_produto, quantidade, id_sessao) VALUES (?, ?, ?)");
    $stmt->execute([$id_produto, $quantidade, session_id()]);
}

// Redirecionar de volta para a página de produtos com uma mensagem de sucesso
header('Location: ../pages/carrinho.php?success=added_to_cart');
exit();
?>