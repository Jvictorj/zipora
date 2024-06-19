<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

$feedback = "";
$success = "";

// Verificar produtos próximos da data de vencimento
$sql_alert = "SELECT * FROM produtos WHERE data_vencimento <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND data_vencimento >= CURDATE()";
$stmt_alert = $pdo->query($sql_alert);
$alertas = $stmt_alert->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['name']);
    $descricao = trim($_POST['description']);
    $preco = trim($_POST['salePrice']);
    $quantidade = trim($_POST['amount']);
    $dataVencimento = trim($_POST['expirationDate']);
    $idade = trim($_POST['idade']);
    $porte = trim($_POST['porte']);
    $categoria_ids = $_POST['categoria'];
    $imagePath = '';
    $imageThumbnails = [];

    // Verificação e upload das imagens
    if (!empty($_FILES['productImage']['name'][0])) {
        $targetDir = "../uploads/";

        // Processa cada imagem
        foreach ($_FILES['productImage']['name'] as $key => $fileName) {
            $imagePath = $targetDir . basename($fileName);
            $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["productImage"]["tmp_name"][$key]);

            if ($check === false) {
                $feedback = "O arquivo não é uma imagem.";
                break;
            } elseif ($_FILES["productImage"]["size"][$key] > 5000000) {
                $feedback = "Desculpe, o arquivo é muito grande.";
                break;
            } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                $feedback = "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
                break;
            } else {
                if (!move_uploaded_file($_FILES["productImage"]["tmp_name"][$key], $imagePath)) {
                    $feedback = "Desculpe, houve um erro ao fazer o upload da sua imagem.";
                    break;
                }

                // Salva a primeira imagem como 'imagem' e as demais como 'imagem_thumbnail'
                if ($key === 0) {
                    $imagemPrincipal = $imagePath; // Primeira imagem
                } else {
                    $imageThumbnails[] = $imagePath; // Imagens thumbnails
                }
            }
        }
    }

    if (empty($nome) || empty($preco) || empty($quantidade)) {
        $feedback = "Por favor, preencha todos os campos obrigatórios.";
    } elseif (!is_numeric($preco) || !is_numeric($quantidade)) {
        $feedback = "Preço e Quantidade devem ser valores numéricos.";
    } elseif (empty($feedback)) {
        // Monta a lista de IDs de categorias
        $categoria_ids = isset($_POST['categoria']) ? $_POST['categoria'] : [];

        // Insere o produto na tabela produtos
        $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, data_vencimento, imagem, imagem_thumbnail, idade, porte) 
                VALUES (:nome, :descricao, :preco, :quantidade, :data_vencimento, :imagem, :imagem_thumbnail, :idade, :porte)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':data_vencimento', $dataVencimento);
        $stmt->bindParam(':imagem', $imagemPrincipal); // Salva a imagem principal
        $stmt->bindParam(':imagem_thumbnail', json_encode($imageThumbnails)); // Salva as thumbnails em formato JSON
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':porte', $porte);

        if ($stmt->execute()) {
            $produto_id = $pdo->lastInsertId();

            // Insere as categorias do produto na tabela produto_categoria
            foreach ($categoria_ids as $categoria_id) {
                $sql_categoria = "INSERT INTO produto_categoria (produto_id, categoria_id) VALUES (:produto_id, :categoria_id)";
                $stmt_categoria = $pdo->prepare($sql_categoria);
                $stmt_categoria->bindParam(':produto_id', $produto_id);
                $stmt_categoria->bindParam(':categoria_id', $categoria_id);
                $stmt_categoria->execute();
            }

            // Registrar a notificação
            $mensagem = "Novo produto cadastrado: $nome";
            $sql_notificacao = "INSERT INTO notificacoes (mensagem, data_hora) VALUES (:mensagem, NOW())";
            $stmt_notificacao = $pdo->prepare($sql_notificacao);
            $stmt_notificacao->bindParam(':mensagem', $mensagem);
            $stmt_notificacao->execute();

            header("Location: cadastro-produto.php?success=1");
            exit;
        } else {
            $feedback = "Erro ao cadastrar o produto.";
        }
    }
}

// Obter todas as categorias para o dropdown
$sql_categorias = "SELECT * FROM categorias";
$stmt_categorias = $pdo->query($sql_categorias);
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) FROM produtos";
$total_stmt = $pdo->query($total_sql);
$total_rows = $total_stmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);

$sql = "SELECT p.*, GROUP_CONCAT(c.nome SEPARATOR ', ') AS categorias 
        FROM produtos p 
        LEFT JOIN produto_categoria pc ON p.id = pc.produto_id 
        LEFT JOIN categorias c ON pc.categoria_id = c.id 
        GROUP BY p.id 
        LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$success = isset($_GET['success']) ? "Produto cadastrado com sucesso!" : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="../assets/css/cadastrarprodutos.css">
    <link rel="stylesheet" href="../assets/css/areadmin/sidebar.css">
    <link rel="stylesheet" href="../assets/css/paginacao.css">
    
</head>
<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4><a href="../pages/index.php">Unipet</a></h4>
            </div>
            <ul class="list-unstyled components">
                <div class = tiltemenu>
                <p>MENU</p>
                </div>
                <li>
                    <a href="cadastro-produto.php">Cadastro de Produtos</a>
                </li>
                <li>
                    <a href="Consulta_Usuario.php">Consultar Usuario</a>
                </li>
                <li>
                    <a href="log.php">Registro De Eventos</a>
                </li>
                <li>
                    <a href="vendas.php">Registro De Vendas</a>
                </li>
                <li>
                    <a href="../pages/index.php">Voltar a Home</a>
                </li>
            </ul>
            <div class="iconlogin" onclick="sair3()"></div>
        </nav>

        <div class="container content" id="content">
            <h4>Cadastro de Produtos</h4>
            <?php if ($feedback): ?>
                <div class="alert"><?php echo htmlspecialchars($feedback); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <!-- Alerta de produtos próximos da data de vencimento -->
            <?php if (!empty($alertas)): ?>
                <div class="alert alert-warning">
                    <strong>Atenção!</strong> Os seguintes produtos estão próximos da data de vencimento:
                    <ul>
                        <?php foreach ($alertas as $alerta): ?>
                            <li><?php echo htmlspecialchars($alerta['nome']) . ' - Vence em: ' . htmlspecialchars(date('d/m/Y', strtotime($alerta['data_vencimento']))); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form class="form-product" action="cadastro-produto.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario();">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Nome do produto *</label>
                        <input class="form-control" type="text" name="name" placeholder="Nome do produto" required/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Descrição do produto</label>
                        <input class="form-control" type="text" name="description" placeholder="Descrição do produto"/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Preço de venda *</label>
                        <input class="form-control" type="number" step="0.01" name="salePrice" placeholder="Preço de venda" required/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Quantidade *</label>
                        <input class="form-control" type="number" name="amount" placeholder="Quantidade" required/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data de Vencimento</label>
                        <input class="form-control" type="date" name="expirationDate" placeholder="Data de validade"/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Idade</label>
                        <input class="form-control" type="text" name="idade" placeholder="Idade"/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Porte</label>
                        <input class="form-control" type="text" name="porte" placeholder="Porte"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="categoria">Categoria</label><br>
                        <select name="categoria" id="categoria" class="form-control">
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php echo htmlspecialchars($categoria['nome']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="productImage">Imagem do Produto *</label><br>
                        <input type="file" id="productImage" name="productImage[]" multiple required>
                    </div>
                    
                    <div class="col-md-3">
                        <br/>
                        <button class="btn btn-primary bnt-product" type="submit">Cadastrar</button>
                    </div>
                </div>
            </form>
            
            <h4>Listagem de Produtos</h4>
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço de Venda</th>
                    <th>Quantidade</th>
                    <th>Data de Vencimento</th>
                    <th>Idade</th>
                    <th>Porte</th>
                    <th>Categoria</th>
                    <th>Imagem</th>
                    <th>Ação</th>
                </tr>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['id']); ?></td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($produto['preco']); ?></td>
                        <td><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($produto['data_vencimento']))); ?></td>
                        <td><?php echo htmlspecialchars($produto['idade']); ?></td>
                        <td><?php echo htmlspecialchars($produto['porte']); ?></td>
                        <td>
                            <?php
                                // Repete entre as categorias para encontrar a correspondente ao produto
                                foreach ($categorias as $categoria) {
                                    if ($categoria['id'] == $produto['categoria_id']) {
                                        echo htmlspecialchars($categoria['nome']);
                                        break;  // Termina o loop assim que encontrar a categoria correta
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php if (!empty($produto['imagem'])): ?>
                                <img src="../uploads/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" style="width: 100px;"/>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="../admin/editar-produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="../admin/excluir-produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="paginacao">
                <?php if ($page > 1): ?>
                    <a href="cadastro-produto.php?page=<?php echo $page - 1; ?>" class="page-link">&laquo; Anterior</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="cadastro-produto.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <a href="cadastro-produto.php?page=<?php echo $page + 1; ?>" class="page-link">Próximo &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>    
</body>
</html>
