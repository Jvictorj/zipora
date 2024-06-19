<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

// Iniciar a sessão se não estiver já iniciada
startSessionIfNotStarted();

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $produto = null;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Produto</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/produto-detalhes.css">
    <link rel="stylesheet" href="../assets/css/menufixo.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/modal.css">

    <!-- javascript -->
    
</head>
<body>
    <!-- Header - Menu -->
    <?php include_once '../includes/header.php'; ?>  

    <?php if ($produto): ?>
    <main>
        <section id="produto-detalhes" class="section-p1">
            <div class="row">
                <div class="col-2 principal-produto-imagem">
                    <img id="img-principal" src="<?php echo htmlspecialchars($produto['imagem']); ?>" width="100%" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    
                    <div class="small-img-group">
                        <?php 
                        $imagens = explode(',', $produto['imagem_thumbnail']);
                        $index = 0;
                        foreach ($imagens as $imagem): 
                        ?>
                        <div class="small-img-col">
                            <img src="<?php echo htmlspecialchars(trim($imagem)); ?>" onclick="Mostrar_Imagem(<?php echo $index++; ?>)" width="100%" class="small-img" alt="">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-2 principal-produto-detalhes">
                    <h1 class="titulo-produto"><?php echo htmlspecialchars($produto['nome']); ?></h1>
                    <div class="produto-marca"><a href="index.html">Home</a><span> | </span><a href="#descricao-link">Ver Descrição</a><span> | </span><a href="">Golden</a></div>

                    <select name="" id="Select-qtd">
                        <option value="">Selecione o tamanho</option>
                        <option value=""><?php echo htmlspecialchars($produto['preco']); ?></option>
                    </select>

                    <div class="preco-produto">
                        <h3><?php echo htmlspecialchars($produto['preco']); ?></h3>
                        <div><p class="preco-parcela"><strong>ou 2x de R$ 50 sem juros</strong></p></div>
                    </div>
                    <div class="favorito"><button class="fav-btn" onclick="Btn_Favorito()"><i class="bi bi-heart-fill"></i></button></div>

                    <div class="descricao-simples">
                        <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                    </div>

                    <div class="acao">
                        <div class="quantity-input">
                            <button type="button" class="minus-btn" onclick="Diminuir_Valor()">-</button>
                            <input type="number" name="quantidade" value="1" id="btn-input">
                            <button type="button" class="plus-btn" onclick="Aumentar_Valor()">+</button>
                        </div>

                        <form method="POST" action="../actions/adicionar_carrinho.php">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                            <input type="hidden" name="quantidade" value="1">
                            <div class="btncomprar">
                                <button type="submit" class="comprar btn-add"><i class="bi bi-cart2"></i> Adicionar ao Carrinho</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="descricao" id="id-descricao">
            <div class="descricao-container">
                <h2 class="descricao-titulo"><a href="" name="descricao-link">Descrição</a></h2>
                <li class="texto-descricao">
                    <?php echo htmlspecialchars($produto['descricao']); ?>
                </li>
            </div>
        </section>

        <section id="especificacao">
            <div class="container-espec">
                <h2 class="espec-titulo">Especificações</h2>
                <ul>
                    <li class="especificacao-li-gray">
                        <span class="spec-key">Idade</span>
                        <span class="spec-valor">Adulto</span>
                    </li>
                </ul>
                <!-- Adicione mais especificações conforme necessário -->
            </div>
        </section>
        
    </main>
    <?php else: ?>
        <p>Produto não encontrado.</p>
    <?php endif; ?>

    <!-- Footer -->
    <?php include_once '../includes/footer.php'; ?>

</body>
</html>
