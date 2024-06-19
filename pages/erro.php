<?php
require '../includes/functions.php';

// Iniciar a sessão se não estiver já iniciada
startSessionIfNotStarted();

// Verificar se o usuário está logado


// Obter o nome do usuário da sessão
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!--bootstrap icons-->
   <script src="https://kit.fontawesome.com/a7c3ed8833.js" crossorigin="anonymous"></script>
 
   
 
   <!--icon-->
   <link rel="shortcut icon" href="Imagens/favicon/icon-unipet.png" type="">
 
   <!--css link-->
   <link rel="stylesheet" href="../assets/css/erro.css">
   <link rel="stylesheet" href="../assets/css/menufixo.css">
   <link rel="stylesheet" href="../assets/css/modal.css">
   <link rel="stylesheet" href="../assets/css/footer.css">

    <!-- javascript -->
    <script>var headerBaseUrl = '../assets/';</script>
    <script>var footerBaseUrl = '../assets/image/';</script>

    

 </head>
 
<body>


    <!-- Header - Menu -->
    <?php include_once '../includes/header.php'; ?>
    
    <div class="container">
      <div class = imgcontainer ></div>
    </div>
 

    <div class =btncontato>
      <a href="index.php" class = btnconosco>
     Voltar a Unipet
      </a>
    </div>
</body>
<!-- footer -->
<?php include_once '../includes/footer.php'; ?>

</html>

