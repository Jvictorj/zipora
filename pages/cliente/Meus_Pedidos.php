<?php

require_once '../../includes/conecao.php';
require_once '../../includes/functions.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit;
}

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

// Obter o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

// Buscar informações do usuário no banco de dados
$stmt = $pdo->prepare("SELECT nome_completo, cpf, data_nascimento, telefone_celular, email, nivel_acesso FROM usuarios WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o usuário foi encontrado
if (!$user) {
    header("Location: ../../pages/login.php");
    exit;
}

// Define a variável $user_name
$user_name = $user['nome_completo'];

// Configuração para logs de vendas
// Configuração para logs de vendas
$limit = 10;
$page_vendas = isset($_GET['page_vendas']) ? (int)$_GET['page_vendas'] : 1;
$offset_vendas = ($page_vendas - 1) * $limit;

$sql_log_vendas = "SELECT log_vendas.*, produtos.nome AS produto_nome, produtos.preco AS produto_preco 
                   FROM log_vendas 
                   JOIN produtos ON log_vendas.produto_id = produtos.id 
                   ORDER BY log_vendas.data_hora DESC 
                   LIMIT :limit OFFSET :offset";
$stmt_log_vendas = $pdo->prepare($sql_log_vendas);
$stmt_log_vendas->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt_log_vendas->bindParam(':offset', $offset_vendas, PDO::PARAM_INT);
$stmt_log_vendas->execute();
$log_vendas = $stmt_log_vendas->fetchAll(PDO::FETCH_ASSOC);

$sql_count_vendas = "SELECT COUNT(*) AS total FROM log_vendas";
$stmt_count_vendas = $pdo->prepare($sql_count_vendas);
$stmt_count_vendas->execute();
$total_vendas = $stmt_count_vendas->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages_vendas = ceil($total_vendas / $limit);

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
    <link rel="stylesheet" href="../../assets/css/areacliente/meuspedidos.css"/>
    <link rel="stylesheet" href="../../assets/css/paginacao.css">
   

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
        <input type="submit" value="Voltar para a loja" onclick="window.location.href='../../pages/index.php';"/>
    </div>
      <div class="row">
        <div class="listas"style="color: var(--cor-secundaria)">
            <ul>
                <li class="lista_func">
                    <a href="../../pages/cliente/Meus_Pedidos.php">
                        <i class="bi bi-bag"></i> <span>Meus pedidos</span>
                    </a>
                </li>
                <li class="lista_func">
                    <a href="../../pages/cliente/Atualizar_Senha.php">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span> Alterar senha</span></a>
                </li>
                <li class="lista_func">
                    <a href="../../pages/cliente/Dados_Pessoais.php">
                        <span><i class="bi bi-person"></i> Dados pessoais </span></a>
                </li>
                <li class="lista_func">
                    <a href="../../pages/cliente/Cliente_Contato.php">
                        <i class="bi bi-envelope"></i> <span>Entre em contato </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="big-box" style="color: var(--cor-secundaria)">
            <div class="busca">
                <input type="text" class="inputbuscarmp" placeholder="Pedido por n°"/>
                <button type="submit">BUSCAR</button>
            </div>
            <br/>
            <div class="log-container">
            <h2>Pedidos</h2>
            <form action="log.php" method="get" class="filter-form">
                <label for="start_date">Data de Início:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                <label for="end_date">Data de Fim:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
                <button type="submit" class="btn" style="color: var(--cor-secundaria)">Filtrar</button>
            </form>

          <div class="section">
              <h3>Pedidos</h3>
              <table class="log-table">
                  <thead>
                      <tr>
                          <th>Usuário</th>
                          <th>Data do Pedido</th>
                          <th>Status</th>
                          <th>Total</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php if (!empty($pedidos)): ?>
                          <?php foreach ($pedidos as $pedido): ?>
                              <tr>
                                  <td><?php echo htmlspecialchars($pedido['usuario_nome']); ?></td>
                                  <td><?php echo htmlspecialchars($pedido['data_pedido']); ?></td>
                                  <td><?php echo htmlspecialchars($pedido['status']); ?></td>
                                  <td>R$<?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                              </tr>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="4">Nenhum pedido encontrado.</td>
                          </tr>
                      <?php endif; ?>
                  </tbody>
              </table>
              <!-- Paginação -->
              <div class="paginacao">
                  <?php if ($page_vendas > 1): ?>
                      <a href="?page_vendas=<?php echo ($page_vendas - 1); ?>" class="page-link">&laquo; Anterior</a>
                  <?php endif; ?>
                  <?php
                  $start_loop = max(1, $page_vendas - 1);
                  $end_loop = min($start_loop + 2, $total_pages_vendas);
                  for ($i = $start_loop; $i <= $end_loop; $i++): ?>
                      <a href="?page_vendas=<?php echo $i; ?>" class="page-link <?php if ($i == $page_vendas) echo 'active'; ?>"><?php echo $i; ?></a>
                  <?php endfor; ?>
                  <?php if ($page_vendas < $total_pages_vendas): ?>
                      <a href="?page_vendas=<?php echo ($page_vendas + 1); ?>" class="page-link">Próxima &raquo;</a>
                  <?php endif; ?>
              </div>
          </div>
      </div>
  </div>
</div>
                  </div>
<!-- Footer -->
<?php include_once '../../includes/footercliente.php'; ?>

</body>

</html>
