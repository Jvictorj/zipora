<?php
session_start();
require_once '../../includes/conecao.php';
require_once '../../includes/functions.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit;
}

// Obter o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

// Buscar informações do usuário no banco de dados
$stmt = $pdo->prepare("SELECT nome_completo, cpf, data_nascimento, telefone_celular, email FROM usuarios WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o usuário foi encontrado
if (!$user) {
    // Se não foi encontrado, redireciona para a página de login
    header("Location: ../../pages/login.php");
    exit;
}

// Obter o nome do usuário da sessão
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Cliente</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="../../assets/image/favicon/icon-unipet.png" type="">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/areacliente/clientestyle.css"/>
    <link rel="stylesheet" href="../../assets/css/menufixo.css">
    <link rel="stylesheet" href="../../assets/css/modal.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="stylesheet" href="../../assets/css/areacliente/dadospessoais.css">
    <!-- JS -->
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>

<!-- Header - Menu -->
<?php include_once '../../includes/headercliente.php'; ?>

<div class="contener-pai">
<div class="mensagem-boas-vinda" style="color: var(--cor-secundaria)">
        <span>
            Olá "<?php echo htmlspecialchars($user['nome_completo']); ?>"! Acompanhe aqui seus pedidos e seus dados cadastrais
        </span>
        <input type="submit" a value="Voltar para a loja" />
    </div>
    <div class="row">
        <div class="listas"style="color: var(--cor-secundaria)">
            <ul>
                <li class="lista_func">
                    <a href="../cliente/Meus_Pedidos.php">
                        <i class="bi bi-bag"></i> <span>Meus pedidos</span>
                    </a>
                </li>
                <li class="lista_func">
                    <a href="../cliente/Atualizar_Senha.php">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span> Alterar senha</span></a>
                </li>
                <li class="lista_func">
                    <a href="../cliente/Dados_Pessoais.php">
                        <span><i class="bi bi-person"></i> Dados pessoais </span></a>
                </li>
                <li class="lista_func">
                    <a href="../cliente/Cliente_Contato.php">
                        <i class="bi bi-envelope"></i> <span>Entre em contato </span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="dp-main" style="color: var(--cor-secundaria)">
            <div class="dp-top">
                <h3>Dados pessoais</h3>
                <hr>
            </div>
            <!-- Dados pessoais do usuário -->
            <div class="input-dp">
                <label for="">CPF</label>
                <input type="text" value="<?php echo htmlspecialchars($user['cpf']); ?>" readonly>
            </div>
            <div class="input-dp">
                <label for="">Nome completo</label>
                <input type="text" value="<?php echo htmlspecialchars($user['nome_completo']); ?>" readonly>
            </div>
            <div class="input-dp">
                <label for="">Nascimento</label>
                <input type="text" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" readonly>
            </div>
            <div class="input-dp">
                <label for="">Telefone</label>
                <input type="text" value="<?php echo htmlspecialchars($user['telefone_celular']); ?>" readonly>
            </div>
            <div class="input-dp">
                <label for="">E-mail</label>
                <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>

            <!-- Botão para excluir usuário -->
            <form action="../../actions/cliente_excluir_usuario.php" method="post" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não poderá ser desfeita.');">
                <button type="submit" class="btn btn-danger " name="excluir">Excluir Conta</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include_once '../../includes/footercliente.php'; ?>

</body>
</html>
