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

// Log de atividades
$sql_log_atividades = "SELECT * FROM log_atividades";
if ($start_date && $end_date) {
    $sql_log_atividades .= " WHERE data_hora BETWEEN :start_date AND :end_date";
}
$sql_log_atividades .= " ORDER BY data_hora DESC LIMIT :limit OFFSET :offset";

$stmt_log_atividades = $pdo->prepare($sql_log_atividades);
if ($start_date && $end_date) {
    $stmt_log_atividades->bindParam(':start_date', $start_date);
    $stmt_log_atividades->bindParam(':end_date', $end_date);
}
$stmt_log_atividades->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt_log_atividades->bindParam(':offset', $offset_atividades, PDO::PARAM_INT);
$stmt_log_atividades->execute();
$log_atividades = $stmt_log_atividades->fetchAll(PDO::FETCH_ASSOC);

$sql_count_atividades = "SELECT COUNT(*) AS total FROM log_atividades";
if ($start_date && $end_date) {
    $sql_count_atividades .= " WHERE data_hora BETWEEN :start_date AND :end_date";
}
$stmt_count_atividades = $pdo->prepare($sql_count_atividades);
if ($start_date && $end_date) {
    $stmt_count_atividades->bindParam(':start_date', $start_date);
    $stmt_count_atividades->bindParam(':end_date', $end_date);
}
$stmt_count_atividades->execute();
$total_atividades = $stmt_count_atividades->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages_atividades = ceil($total_atividades / $limit);

// Notificações
$sql_notificacoes = "SELECT * FROM notificacoes ORDER BY data_hora DESC";
$stmt_notificacoes = $pdo->query($sql_notificacoes);
$notificacoes = $stmt_notificacoes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log de Atividades</title>
    <link rel="stylesheet" href="../assets/css/log.css">
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
        <h2>Log de Atividades</h2>
        <form action="log.php" method="get" class="filter-form">
            <label for="start_date">Data de Início:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
            <label for="end_date">Data de Fim:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
            <button type="submit" class="btn">Filtrar</button>
        </form>

        <div class="section">
            <h3>Logins e Logouts</h3>
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Atividade</th>
                        <th>Data e Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($log_atividades)): ?>
                        <?php foreach ($log_atividades as $log): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($log['atividade']); ?></td>
                                <td><?php echo htmlspecialchars($log['data_hora']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- Paginação -->
            <div class="paginacao">
                <?php if ($page_atividades > 1): ?>
                    <a href="?page_atividades=<?php echo ($page_atividades - 1); ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="page-link">&laquo; Anterior</a>
                <?php endif; ?>

                <?php
                $start_loop = max(1, $page_atividades - 1);
                $end_loop = min($start_loop + 2, $total_pages_atividades);

                for ($i = $start_loop; $i <= $end_loop; $i++): ?>
                    <a href="?page_atividades=<?php echo $i; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="page-link <?php if ($i == $page_atividades) echo 'active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page_atividades < $total_pages_atividades): ?>
                    <a href="?page_atividades=<?php echo ($page_atividades + 1); ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="page-link">Próxima &raquo;</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="section">
            <h3>Notificações</h3>
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Mensagem</th>
                        <th>Data e Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notificacoes)): ?>
                        <?php foreach ($notificacoes as $notificacao): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($notificacao['mensagem']); ?></td>
                                <td><?php echo htmlspecialchars($notificacao['data_hora']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
