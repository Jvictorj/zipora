<?php
session_start();
require_once '../includes/conecao.php'; 
require_once '../includes/functions.php'; 

$db = new Database();
$pdo = $db->getConnection();

$item = $_GET['id_item'];
  // var_dump($item) ;

$sql = "DELETE FROM carrinho WHERE id = :id" ;
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$item);
$stmt->execute();

  header('location: ../pages/carrinho.php');
exit(); 


?>