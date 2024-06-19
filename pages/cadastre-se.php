<?php
include_once '../includes/conecao.php';
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unipet: Apaixonado por Animais</title>
  <meta name="title" content="Unipet - Ração de Alta Qualidade">
  <meta name="description" content="Loja virtual">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.png" type="">
  <link rel="stylesheet" href="../assets/css/cadastre-se.css">
  <link rel="stylesheet" href="../assets/css/modal.css">
  <link rel="stylesheet" href="../assets/css/menufixo.css">
  <link rel="stylesheet" href="../assets/css/footer.css">


  
  <script src="../assets/js/validacao.js"defer></script>
  <script src="../assets/js/cep.js"defer></script>
 
</head>
<body>
  <main>
    <div id="toast" class="hidden"></div>
    <div id="toast2" class="hidden"></div>
    <div class="containermain container-background-image" style="background-image: url('../assets/image/fotoslogin/fotobackgroundlogin.png');">
      <div class="containerform">
        <div class="containertop">
          <div class="logoimglogin"> 
            <a href="../pages/index.php"><img src="../assets/image/fotoslogin/unipetdarkmode-removebg-preview.png" alt="imglogo" id="logoimagemdarkmodee"></a>
          </div>
          <div class="mensagemlogin">
            <p>Criar uma <b style="color: #ff7b00;">nova conta</b></p>
            <p>Primeira<b style="color: #ff7b00;"> etapa</b></p>
            <div class="progressbar">
              <ul>
                <li class="active form_1_progessbar">
                  <div>
                    <p class="p1">1</p>
                  </div>
                </li>
                <li class="form_2_progessbar">
                  <div>
                    <p class="p2">2</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="../actions/cadastro.php" class="containerdireita" id="form">
          <div class="input-box">
            <input type="text" name="nome" placeholder="Nome Completo" id="nome" required>
          </div>
          <div class="input-box">
            <input id="data" type="date" name="data_nascimento" required>
          </div>
          <div class="input-boxsex">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo">
              <option value="" selected id = defalt>--- Escolha ---</option>
              <option value="Masculino">Masculino</option>
              <option value="Feminino">Feminino</option>
              <option value="Outro">Prefiro não dizer</option>
            </select>
            <span class="error" id="sexoError" style ="color:red"></span>
          </div>
          <div class="input-box">
            <input type="text" name="nomemae" placeholder="Nome Materno" id="nomemae" required>
          </div>
          <div class="input-box">
            <input type="text" name="cpf" placeholder="CPF" id="cpf" required>
          </div>
          <div class="input-box">
            <input type="text" name="cell" placeholder="Telefone Celular" id="telefonecelular" required>
          </div>    
          <div class="input-box">
            <input type="email" name="email" placeholder="E-mail" id="email" required>
          </div>
          <div class="input-box">
            <input type="text" name="login" placeholder="Login" id="login" required>
          </div>               
          <div class="input-box">
            <input type="password" name="senha" placeholder="Senha" id="senha" required>
          </div>
          <div class="input-box">
            <input type="password" name="confsenha" placeholder="Confirme sua senha" required id="confsenha">
          </div>
          <div class = input-box>
                    <input type="text" placeholder="CEP" id = CEP required  >
                </div>
                <div class = input-box>
                    <input type="text" placeholder="Rua" id = Rua required  >
                </div>
                <div class =input-box>
                    <input id ="Bairro" type ="text" name="Bairro" id = Bairro placeholder ="Digite o nome do seu Bairro" required id = >
                </div>
                <div class =input-box>   
                    <input id ="Cidade" type ="text" name="Cidade" id = Cidade placeholder ="Digite sua Cidade"  required id = >
                </div>
                <div class =input-box>
                   
                    <input id ="Estado" type ="text" name="Estado" id = Estado placeholder ="Digite seu Estado" required id = >
                </div>
          <div class="input-box">
            <input type="text" name="tellfixo" placeholder="Telefone Fixo" required id="fixo">
          </div>    
          <div class="btncadastrar">
            <button type="submit" id="Enviar" onclick="validaçãoCAD()" >Cadastrar</button>
            <button type="reset" id="limpar">Limpar</button>
          </div>
          <div class="voltaraohome">
            <p>Já possui uma conta?</p>
            <a href="../pages/login.php"> Clique aqui para fazer login.</a>
          </div>
        </form>
                

  
                
                  
      </div>
    </div>
  </main>
</body>
</html>
