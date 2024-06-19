<?php
require_once '../includes/conecao.php'; // Arquivo de conexão com o banco de dados
require_once '../includes/functions.php'; // Arquivo com funções auxiliares, se necessário

// Inicializar a conexão com o banco de dados
$db = new Database();
$pdo = $db->getConnection();

$usuarios = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['consulta'])) {
    $consulta = $_POST['consulta'];

    // Preparar a consulta SQL para buscar usuários com base no critério fornecido
    $stmt = $pdo->prepare("
        SELECT id, nome_completo, login, email, telefone_celular
        FROM usuarios
        WHERE cpf = :consulta
        OR id = :consulta
        OR nome_completo LIKE :consulta_like
        OR login = :consulta
        OR email = :consulta
    ");
    
    $consulta_like = "%$consulta%";
    $stmt->bindParam(':consulta', $consulta);
    $stmt->bindParam(':consulta_like', $consulta_like);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lógica para exclusão de usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
    $id = $_POST['excluir'];

    // Preparar e executar a exclusão do usuário
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        // Redirecionar para evitar reenvio do formulário
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Erro ao excluir usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consulta de Usuário</title>
        <!--icon-->
        <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.png" type="">
        <!--css-->
        <link rel="stylesheet" href="../assets/css/areadmin/cons.css">
        <link rel="stylesheet" href="../assets/css/areadmin/sidebar.css">
        <!--js link-->
        <script src="../assets/js/darkmode.js" defer></script>
        <script src="../assets/js/menumobile.js" defer></script>
        <script src="../assets/js/modal.js" defer></script>
        <script src="../assets/js/validacao.js" defer></script>
        <!--bootstrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    </head>
    <>
        
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
            <div class = containerbody></div>
            <div class = containerform>
       
       
            
            <!-- Formulário de Consulta -->
            <form method="POST">
                <label for="consulta">Consultar por CPF, ID, Nome, Login ou Email:</label>
                <input type="text" id="cpf" name="consulta" placeholder="Digite o critério de consulta" required>
                <button type="submit">Consultar</button>
            </form>
            <div id="userInfo">
                <?php if (!empty($usuarios)): ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Número</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id']) ?></td>
                                <td><?= htmlspecialchars($usuario['nome_completo']) ?></td>
                                <td><?= htmlspecialchars($usuario['login']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= htmlspecialchars($usuario['telefone_celular']) ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="excluir" value="<?= htmlspecialchars($usuario['id']) ?>">
                                        <button type="submit" class="delete-button" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php else: ?>
                        <p>Nenhum usuário encontrado.</p>
                <?php endif; ?>
            </div>
        <a class = voltarhref href="../pages/index.php">Voltar a Unipet Admin</a>
     
        
        
       
        
    </div>
</body>
</html>