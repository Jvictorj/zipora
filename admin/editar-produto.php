<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

$id = $_GET['id'];
$feedback = "";

// Obter todas as categorias para o dropdown
$sql_categorias = "SELECT * FROM categorias";
$stmt_categorias = $pdo->query($sql_categorias);
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['name']);
    $descricao = trim($_POST['description']);
    $preco = trim($_POST['salePrice']);
    $quantidade = trim($_POST['amount']);
    $dataVencimento = trim($_POST['expirationDate']);
    $idade = trim($_POST['idade']);
    $porte = trim($_POST['porte']);
    $categoria_id = trim($_POST['categoria']);
    $imagePath = $produto['imagem'];

    if (!empty($_FILES['productImage']['name'])) {
        $targetDir = "../uploads/";

        // Verificar se o diretório existe, se não, criar
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imagePath = $targetDir . basename($_FILES["productImage"]["name"]);
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);

        if ($check === false) {
            $feedback = "O arquivo não é uma imagem.";
        } elseif ($_FILES["productImage"]["size"] > 5000000) {
            $feedback = "Desculpe, o arquivo é muito grande.";
        } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $feedback = "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        } else {
            if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $imagePath)) {
                $feedback = "Desculpe, houve um erro ao fazer o upload da sua imagem.";
            }
        }
    }

    if (empty($nome) || empty($preco) || empty($quantidade)) {
        $feedback = "Por favor, preencha todos os campos obrigatórios.";
    } elseif (!is_numeric($preco) || !is_numeric($quantidade)) {
        $feedback = "Preço e Quantidade devem ser valores numéricos.";
    } elseif (empty($feedback)) {
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade, data_vencimento = :data_vencimento, imagem = :imagem, idade = :idade, porte = :porte, categoria_id = :categoria_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':data_vencimento', $dataVencimento);
        $stmt->bindParam(':imagem', $imagePath);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':porte', $porte);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: cadastro-produto.php");
            exit;
        } else {
            $feedback = "Erro ao atualizar o produto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../assets/css/cadastrarprodutos.css">
    <link rel="stylesheet" href="../assets/css/areadmin/sidebar.css">
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
        <h4>Editar Produto</h4>
        <?php if ($feedback): ?>
            <div class="alert"><?php echo htmlspecialchars($feedback); ?></div>
        <?php endif; ?>
        <form class="form-product" action="editar-produto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Nome do produto *</label>
                    <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($produto['nome']); ?>" required/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Descrição do produto</label>
                    <input class="form-control" type="text" name="description" value="<?php echo htmlspecialchars($produto['descricao']); ?>"/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Preço de venda *</label>
                    <input class="form-control" type="number" step="0.01" name="salePrice" value="<?php echo htmlspecialchars($produto['preco']); ?>" required/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quantidade *</label>
                    <input class="form-control" type="number" name="amount" value="<?php echo htmlspecialchars($produto['quantidade']); ?>" required/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Data de Vencimento</label>
                    <input class="form-control" type="date" name="expirationDate" value="<?php echo htmlspecialchars($produto['data_vencimento']); ?>"/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Idade</label>
                    <input class="form-control" type="text" name="idade" value="<?php echo htmlspecialchars($produto['idade']); ?>" placeholder="Idade"/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Porte</label>
                    <input class="form-control" type="text" name="porte" value="<?php echo htmlspecialchars($produto['porte']); ?>" placeholder="Porte"/>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Categoria *</label>
                    <select class="form-control" name="categoria" required>
                        <option value="">Selecione a categoria</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo htmlspecialchars($categoria['id']); ?>" <?php if ($categoria['id'] == $produto['categoria_id']) echo 'selected'; ?>><?php echo htmlspecialchars($categoria['nome']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Imagem do produto</label>
                    <input class="form-control" type="file" name="productImage" accept="image/*"/>
                    <?php if (!empty($produto['imagem'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" style="width: 100px;"/>
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <br/>
                    <button class="btn btn-primary bnt-product" type="submit">Atualizar</button>
                    
                </div>
                <div class="col-md-3">
                    <button class="btn-voltar"><a href="cadastro-produto.php">Voltar</a></button>
                </div>
            </div>
        </form>
    </div>
        
    </div>    

    
</body>
</html>
