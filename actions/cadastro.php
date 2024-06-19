<?php
require '../includes/conecao.php';
require '../includes/functions.php';
session_start();

$errors = [];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = sanitizeInput($_POST['nome']);
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $nomemae = sanitizeInput($_POST['nomemae']);
    $cpf = $_POST['cpf'];
    $cell = $_POST['cell'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    $cep = $_POST['cep'];
    $bairro = sanitizeInput($_POST['bairro']);
    $cidade = sanitizeInput($_POST['cidade']);
    $estado = sanitizeInput($_POST['estado']);
    $tellfixo = $_POST['tellfixo'];

    // Validações
    if (empty($nome)) {
        $errors[] = "O nome é obrigatório.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "O e-mail é inválido.";
    }

    if (empty($login)) {
        $errors[] = "O login é obrigatório.";
    }

    if (empty($senha) || empty($confsenha) || $senha !== $confsenha) {
        $errors[] = "As senhas não coincidem.";
    }

    // Verificar se há erros antes de prosseguir com o cadastro
    if (empty($errors)) {
        // Preparar e executar a inserção no banco de dados
        $db = new Database();
        $pdo = $db->getConnection();

        // Verificar se o login já existe
        $sql = "SELECT COUNT(*) FROM usuarios WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $loginExists = $stmt->fetchColumn();
        if ($loginExists > 0) {
            $errors[] = "O login já está em uso.";
        } else {
            // Inserir usuário na tabela de usuários
            $sql = "INSERT INTO usuarios (nome_completo, data_nascimento, sexo, nome_materno, cpf, telefone_celular, email, login, senha_hash, endereco_completo, bairro, cidade, estado, telefone_fixo)
                    VALUES (:nome, :data_nascimento, :sexo, :nomemae, :cpf, :celular, :email, :login, :senha, :endereco_completo, :bairro, :cidade, :estado, :telefone_fixo)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':nomemae', $nomemae);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':celular', $cell);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':login', $login);

            // Criar variável para armazenar o hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senha_hash);

            // Construir o endereço completo com base em CEP, bairro, cidade e estado
            $endereco_completo = $cep . ', ' . $bairro . ', ' . $cidade . ', ' . $estado;
            $stmt->bindParam(':endereco_completo', $endereco_completo);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':telefone_fixo', $tellfixo);

            if ($stmt->execute()) {
                // Redirecionar para a página de sucesso após o cadastro
                header('Location: ../pages/login.php');
                exit;
            } else {
                $errors[] = "Erro ao cadastrar usuário. Por favor, tente novamente mais tarde.";
            }
        }
    }
}

// Se houver erros, redirecionar de volta para a página de cadastro com os erros
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../pages/cadastre-se.php');
    exit;
}
?>
