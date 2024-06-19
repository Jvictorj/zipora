<?php
require '../includes/functions.php';
require_once '../includes/conecao.php';
session_start();


$db = new Database();
$pdo = $db->getConnection();


$stmt = $pdo->prepare("SELECT carrinho.*, produtos.nome, produtos.preco, produtos.imagem FROM carrinho JOIN produtos ON carrinho.id_produto = produtos.id WHERE id_sessao = ?");
$stmt->execute([session_id()]);
$itens_carrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = 0;

// Exibir os itens do carrinho
foreach ($itens_carrinho as $item) {
    $subtotal = $item['preco'] * $item['quantidade'];
    $total += $subtotal;
    //echo "<p>{$item['nome']} - Quantidade: {$item['quantidade']} - Subtotal: R$ {$subtotal}</p>";
}

//echo "<p>Total do Carrinho: R$ {$total}</p>";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho | Unipet </title>


    <!--bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--icon-->
    <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.ico" type="">
    <!--css-->
    <link rel="stylesheet" href="../assets/css/carrinho.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" href="../assets/css/menufixo.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <!-- javascript -->
    <script>var headerBaseUrl = '../assets/';</script>
    <script>var footerBaseUrl = '../assets/image/';</script>



<body>

    <!-- Header - Menu -->
    <?php include_once '../includes/header.php'; ?>





    <section class="container">
        <div class="containerbox">
            <div class="title"><h1>Carrinho</h1></div>
            <div class="caixamensagem">
                <p>A Unipet oferece Garantia e Reembolso de até 30 dias em todos os produtos</p>
            </div>
            <div class="containertitle">
                <div class="variaveis"><p>Produtos</p></div>
                <div class="variaveis"><p>Preço</p></div>
                <div class="variaveis"><p>Quantidade</p></div>
                <div class="variaveis"><p>Total</p></div>
                <div class="variaveis"><p>Status</p></div>
            </div>
            <?php foreach ($itens_carrinho as $item): ?>
            <div class="containerproduto">
                <div class="produto">
                    <img src="../uploads/<?php echo htmlspecialchars($item['imagem']); ?>" style="width: 100px; height: 100px;">
                </div>
                <div class="variaveisproduto"> R$ <?= number_format($item['preco'], 2, ',', '.') ?> </div>
                <div class="variaveisproduto">
                    <form action="../actions/atualizar_quantidade.php" method="post" >
                        <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1">
                        <input type="hidden" name="id_item" value="<?= $item['id'] ?>">
                        <button type="submit">Atualizar</button>
                    </form>
                </div>
                <div class="variaveisproduto">R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></div>
                <div class="variaveisproduto">
                    <form action="../actions/remover_carrinho.php" method="get">
                    <input type="hidden" name="id_item" value=" <?= $item['id'] ?>" >
                    <button type="submit">Remover Item</button>
                    </form>
                </div>
            </div>
            <?php $total = $item['preco'] * $item['quantidade']; ?>
            <?php endforeach; ?>
            <div class="containerbox02">
                <div class="resumopedido">
                    <h2>Total: R$ <?= number_format($total, 2, ',', '.') ?></h2>
                </div>
                <div class="btnaction">
                    <button class="btnpagamento">Ir Para Pagamento</button>
                </div>
            </div>
        </div>
    </section>

  
  <!--Rodape-->
    <!-- Header - Menu -->
    <?php include_once '../includes/header.php'; ?>



   <!-- 
    - #BACK TO TOP
  -->

  <a id="link-topo" href="#">&#9650;</a>





  <!--Botão whatsapp-->
<a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%20gostaria%20de%20saber%20mais%20sobre%20a%20Unipet" target="_blank"><img src="https://host2b.net/download/imagem/whatsapp-icon.png" style="height:60px; position:fixed; bottom:25px; left:25px; z-index:99999;" data-selector="img"></a>
<!--Botão whatsapp-->.

</body>
</html>