<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

// Iniciar a sessão se não estiver já iniciada
startSessionIfNotStarted();

// Obter o nome do usuário da sessão
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário';

// Consultar todas as categorias
$stmt_categorias = $pdo->query("SELECT id, nome FROM categorias");
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

// Verificar a categoria e o critério de ordenação selecionados
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
$ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'nome_asc';
$consulta = isset($_GET['consulta']) ? $_GET['consulta'] : '';

$limit = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Construir a consulta SQL base
$sql = "SELECT p.*, COALESCE(SUM(lv.quantidade), 0) AS vendas 
        FROM produtos p 
        LEFT JOIN log_vendas lv ON p.id = lv.produto_id";

// Condições baseadas nos filtros selecionados
$params = array();

if ($categoria_id > 0) {
    $sql .= " WHERE p.categoria_id = :categoria_id";
    $params[':categoria_id'] = $categoria_id;
} elseif (!empty($consulta)) {
    $sql .= " WHERE p.nome LIKE :consulta_like
            OR p.descricao LIKE :consulta_like
            OR p.preco LIKE :consulta_like";
    $params[':consulta_like'] = "%$consulta%";
}

$sql .= " GROUP BY p.id";

// Ordenação
switch ($ordem) {
    case 'preco_asc':
        $sql .= " ORDER BY p.preco ASC";
        break;
    case 'preco_desc':
        $sql .= " ORDER BY p.preco DESC";
        break;
    case 'nome_asc':
        $sql .= " ORDER BY p.nome ASC";
        break;
    case 'nome_desc':
        $sql .= " ORDER BY p.nome DESC";
        break;
    case 'mais_vendidos':
        $sql .= " ORDER BY vendas DESC";
        break;
    default:
        $sql .= " ORDER BY p.nome ASC";
        break;
}

// Adicionar LIMIT e OFFSET para paginação
$sql .= " LIMIT :limit OFFSET :offset";

// Preparar a consulta
$stmt = $pdo->prepare($sql);

// Vincular parâmetros
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

foreach ($params as $key => $value) {
    if (is_int($value)) {
        $stmt->bindParam($key, $value, PDO::PARAM_INT);
    } else {
        $stmt->bindParam($key, $value);
    }
}

// Executar a consulta
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar se existem produtos
if (count($produtos) === 0) {
    header('Location: ../pages/erro.php');
    exit; // Certifique-se de sair para evitar qualquer execução adicional
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Produtos</title>

    <!-- Ícone -->
    <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.png" type="">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/produtos.css">
    <link rel="stylesheet" href="../assets/css/paginacao.css">
    <link rel="stylesheet" href="../assets/css/sliderindex.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" href="../assets/css/menufixo.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/form-categoria.css">
    
    <!-- JavaScript -->
    <script>var headerBaseUrl = '../assets/';</script>
    <script>var footerBaseUrl = '../assets/image/';</script>

</head>
<body>

    <!-- Header - Menu -->
    <?php include_once '../includes/header.php'; ?>

    <main>
        
        <!-- Formulário de Filtro por Categoria e Ordenação -->
        <form method="GET" action="produtos.php" class="form-filtro">
            <label for="categoria">Filtrar por Categoria:</label>
            <select name="categoria" id="categoria" onchange="this.form.submit()">
                <option value="0">Todas as Categorias</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id']; ?>" <?php if ($categoria['id'] == $categoria_id) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($categoria['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="ordem">Ordenar por:</label>
            <select name="ordem" id="ordem" onchange="this.form.submit()">
                <option value="nome_asc" <?php if ($ordem == 'nome_asc') echo 'selected'; ?>>A-Z</option>
                <option value="nome_desc" <?php if ($ordem == 'nome_desc') echo 'selected'; ?>>Z-A</option>
                <option value="preco_asc" <?php if ($ordem == 'preco_asc') echo 'selected'; ?>>Mais Baratos</option>
                <option value="preco_desc" <?php if ($ordem == 'preco_desc') echo 'selected'; ?>>Mais Caros</option>
                <option value="mais_vendidos" <?php if ($ordem == 'mais_vendidos') echo 'selected'; ?>>Mais Vendidos</option>
            </select>

            <!-- <label for="consulta">Pesquisar:</label>
            <input type="text" name="consulta" id="consulta" placeholder="Pesquisar produtos..." value="<?php echo htmlspecialchars($consulta); ?>" />
            <button type="submit">Buscar</button> -->
        </form>

        <section class="secao produto">
            <div class="containerproduto">
                <h2 class="h2 secao-titulo">
                    <span class="span">Bem vindo a Terra dos Peludos</span> 🐾💕
                </h2>
                <?php if (count($produtos) > 0): ?>
                    <ul class="lista">
                        <?php foreach ($produtos as $produto): ?>
                            <li>
                                <div class="card-produto">
                                    <div class="card-banner img-holder">
                                        <a href="../pages/detalhesproduto.php?id=<?php echo $produto['id']; ?>">
                                            <img src="../uploads/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="img-cover default">
                                        </a>
                                    </div>
                                    <div class="card-conteudo">
                                        <h3 class="h3">
                                            <a href="../pages/detalhesproduto.php?id=<?php echo $produto['id']; ?>" class="card-titulo"><?php echo htmlspecialchars($produto['nome']); ?></a>
                                        </h3>
                                        <data class="card-preco">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></data>

                                        <form method="POST" action="../actions/adicionar_carrinho.php">
                                            <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                                            <input type="hidden" name="quantidade" value="1">
                                            <div class="btncomprar">
                                                <button type="submit" class="comprar">Comprar</button>
                                            </div>
                                        </form>

                                        <!-- <div class="btncomprar">
                                            <button class="comprar"><a href="../pages/carrinho.php?id=<?php echo $produto['id']; ?>">Comprar</a></button>
                                        </div> -->
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Paginação -->
                    <div class="paginacao">
                        <?php if ($page > 1): ?>
                            <a href="produtos.php?page=<?php echo ($page - 1); ?>" class="page-link">&laquo; Anterior</a>
                        <?php endif; ?>

                        <?php
                        $start_loop = max(1, $page - 1);
                        $end_loop = min($start_loop + 2, $limit);

                        for ($i = $start_loop; $i <= $end_loop; $i++): ?>
                            <a href="produtos.php?page=<?php echo $i; ?>" class="page-link <?php if ($i === $page) echo 'active'; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $limit): ?>
                            <a href="produtos.php?page=<?php echo ($page + 1); ?>" class="page-link">Próxima &raquo;</a>
                        <?php endif; ?>
                    </div>



                    <?php else: ?>
                    <!-- Redirecionamento para página de erro -->
                    <?php
                    header('Location: ../pages/erro.php');
                    exit; 
                    ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Rodapé -->
        <?php include_once '../includes/footer.php'; ?>

    </main>

</body>
</html>
