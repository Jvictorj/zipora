<?php
require_once '../includes/conecao.php';
require_once '../includes/functions.php';

session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit;
}

// Verificar o nível de acesso do usuário
$user_id = $_SESSION['user_id'];
$db = new Database();
$pdo = $db->getConnection();
$stmt = $pdo->prepare("SELECT nivel_acesso FROM usuarios WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || $user['nivel_acesso'] !== 'admin') {
    header('Location: ../pages/login.php');
    exit;
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$limit = 10;
$page_atividades = isset($_GET['page_atividades']) ? (int)$_GET['page_atividades'] : 1;
$page_vendas = isset($_GET['page_vendas']) ? (int)$_GET['page_vendas'] : 1;
$offset_atividades = ($page_atividades - 1) * $limit;
$offset_vendas = ($page_vendas - 1) * $limit;

// Log de vendas
$sql_log_vendas = "SELECT log_vendas.*, produtos.nome AS produto_nome 
                    FROM log_vendas 
                    JOIN produtos ON log_vendas.produto_id = produtos.id";
if ($start_date && $end_date) {
    $sql_log_vendas .= " WHERE log_vendas.data_hora BETWEEN :start_date AND :end_date";
}
$sql_log_vendas .= " ORDER BY log_vendas.data_hora DESC LIMIT :limit OFFSET :offset";

$stmt_log_vendas = $pdo->prepare($sql_log_vendas);
if ($start_date && $end_date) {
    $stmt_log_vendas->bindParam(':start_date', $start_date);
    $stmt_log_vendas->bindParam(':end_date', $end_date);
}
$stmt_log_vendas->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt_log_vendas->bindParam(':offset', $offset_vendas, PDO::PARAM_INT);
$stmt_log_vendas->execute();
$log_vendas = $stmt_log_vendas->fetchAll(PDO::FETCH_ASSOC);

$sql_count_vendas = "SELECT COUNT(*) AS total FROM log_vendas";
if ($start_date && $end_date) {
    $sql_count_vendas .= " WHERE log_vendas.data_hora BETWEEN :start_date AND :end_date";
}
$stmt_count_vendas = $pdo->prepare($sql_count_vendas);
if ($start_date && $end_date) {
    $stmt_count_vendas->bindParam(':start_date', $start_date);
    $stmt_count_vendas->bindParam(':end_date', $end_date);
}
$stmt_count_vendas->execute();
$total_vendas = $stmt_count_vendas->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages_vendas = ceil($total_vendas / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log de Atividades</title>
    <link rel="stylesheet" href="../assets/css/areadmin/vendas.css">
    <link rel="stylesheet" href="../assets/css/paginacao.css">
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
    <div class="log-container">

        <form action="log.php" method="get" class="filter-form">
            <label for="start_date">Data de Início:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
            <label for="end_date">Data de Fim:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
            <button type="submit" class="btn">Filtrar</button>
        </form>

        <div class="section">
            <h3>Vendas</h3>
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Data e Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($log_vendas)): ?>
                        <?php foreach ($log_vendas as $log): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($log['produto_nome']); ?></td>
                                <td><?php echo htmlspecialchars($log['quantidade']); ?></td>
                                <td><?php echo htmlspecialchars($log['data_hora']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- Paginação -->
            <div class="paginacao">
                <?php if ($page_vendas > 1): ?>
                    <a href="?page_vendas=<?php echo ($page_vendas - 1); ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="page-link">&laquo; Anterior</a>
                <?php endif; ?>

                <?php
                $start_loop = max(1, $page_vendas - 1);
                $end_loop = min($start_loop + 2, $total_pages_vendas);

                for ($i = $start_loop; $i <= $end_loop; $i++): ?>
                    <a href="?page_vendas=<?php echo $i; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="page-link <?php if ($i == $page_vendas) echo 'active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page_vendas < $total_pages_vendas): ?>
                    <a href="?page_vendas=<?php echo ($page_vendas + 1); ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="page-link">Próxima &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
