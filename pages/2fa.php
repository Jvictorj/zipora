<?php
include_once '../includes/conecao.php';

session_start();
if (!isset($_SESSION['pending_user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unipet: Apaixonado por Animais</title>
  <meta name="title" content="Unipet - Ração de Alta Qualidade">
  <meta name="description" content="Loja virtual">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.ico" type="">
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="stylesheet" href="../assets/css/modal.css">
  <link rel="stylesheet" href="../assets/css/menufixo.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <script src="../assets/js/validacao.js"></script>
</head>
<body>
  <div id="toast" class="hidden"></div>
  <div id="toast2" class="hidden"></div>
  <main>
    <div class="containermain container-background-image" style="background-image: url('../assets/image/fotoslogin/fotobackgroundlogin.png');">
      <div class="containerform" id="form">
        <div class="containeresqueda">
          <div class="logoimglogin"> 
            <a href="index.php"><img src="../assets/image/fotoslogin/unipetdarkmode-removebg-preview.png" alt="imglogo" id="logoimagemdarkmodee"></a>
          </div>
          <div class="mensagemlogin">
            <p>Faça a <b style="color: #ff7b00;">melhor escolha</b></p>
            <p>para seu amigo(a)</p>
          </div>
        </div>
        <form method="post" action="../actions/authenticate.php" class="containerdireita">
          <div class="tiltelogin">
            <p><b>Autenticação de Dois Fatores</b></p>
          </div>
          <div class="input-box">
            <input type="text" id="auth-data" placeholder="Insira seu CPF ou Nome Materno" name="auth-data" required>
          </div>
          <div class="btnentrar">
            <button type="submit" id="Enviar">Entrar</button>
          </div>
          <div class="voltaraohome">
            <a href="login.php">Voltar ao Início</a>
          </div>
        </form>
      </div>
    </div>
  </main>
  <a id="link-topo" href="#">&#9650;</a>
</body>
</html>
