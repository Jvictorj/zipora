<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unipet: Login</title>
  <meta name="title" content="Unipet - Ração de Alta Qualidade">
  <meta name="description" content="Loja virtual">

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- icon -->
  <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.ico" type="image/png">

  <!-- css -->
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="stylesheet" href="../assets/css/modal.css">
  <link rel="stylesheet" href="../assets/css/menufixo.css">

  <script src="../assets/js/validacao.js"defer></script>

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
        <?php
        session_start();
        if (!empty($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            unset($_SESSION['errors']);
        }
        ?>
        <form method="post" action="../actions/login.php" class="containerdireita">
          <div class="tiltelogin">
            <p><b>Acesse usando seu Login ou CPF</b></p>
          </div>
          <div class="input-box">
            <input type="text" name="login" placeholder="Insira seu Login ou CPF" id="loogin" required>
          </div>
          <div class="input-box">
            <input type="password" name="senha" placeholder="Senha" id="senha-log" required>
          </div>
          <div class="esqueciminhasenha">
            <a href="esqueciasenha.php"><i class="bi bi-question-circle"></i> Esqueci minha senha</a>
          </div>
          <div class="btnentrar">
            <button type="submit" id="Enviar" onclick="validaçãoTLOgin()">Entrar</button>
            <a href="cadastre-se.php">Cadastre-se</a>
          </div>
          <div class="voltaraohome">
            <a href="index.php">Voltar ao Início</a>
          </div>
        </form>
      </div>
    </div>
  </main>
  <a id="link-topo" href="#">&#9650;</a>
</body>
</html>
