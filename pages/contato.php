<?php
require '../includes/functions.php';

?>

<!DOCTYPE html>
 <html lang="en">
 <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--icon-->
    <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.png" type="">
     <!--css-->
     <link rel="stylesheet" href="../assets/css/footer.css">
     <link rel="stylesheet" href="../assets/css/contato.css">
     <link rel="stylesheet" href="../assets/css/menufixo.css">
     <link rel="stylesheet" href="../assets/css/modal.css">
     <link rel="stylesheet" href="../assets/css/footer.css">
     <!-- javascript -->
    <script>var headerBaseUrl = '../assets/';</script>
    <script>var footerBaseUrl = '../assets/image/';</script>

    <title>Unipet - Fale Conosco</title>
 </head>

  <!-- header -->
  <?php include_once '../includes/header.php'; ?>

 <body>
    <section class="form-container">
        <div class="container">
            <form method="post" action="envia.php">
                <h1>Entre em contato </h1>
                <p> Preencha o formulário abaixo e entraremos em contato com você.</p>
                <div class="input-single">
                    <input class="input" type="text" id="nome" name="nome" required autocomplete="off" >
                    <label for="nome">Seu nome completo</label>
                </div>
                <div class="input-single">
                    <input class="input" type="text" id="email" name="email" required autocomplete="off"  >
                    <label for="email">Seu e-mail</label>
                </div>
                <div class="input-single">
                    <input class="input" type="text" id="telefone" name="telefone" required autocomplete="off"  >
                    <label for="telefone"> Seu telefone</label>
                </div>
                <div class = input-mensagem>
                    <input type="text" placeholder="Digite aqui sua Mensagem (opcional)" cols="30" rows="10">
                </div>
                
             
                <div class="btn"><input type="submit" value="Enviar"></div>
            </form>
        </div>
    </section>

  <!-- Footer -->
  <?php include_once '../includes/footer.php'; ?>

<!--Botão whatsapp-->
<a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%20gostaria%20de%20saber%20mais%20sobre%20a%20Unipet" target="_blank"><img src="https://host2b.net/download/imagem/whatsapp-icon.png" style="height:60px; position:fixed; bottom:25px; left:25px; z-index:99999;" data-selector="img"></a>
<!--Botão whatsapp-->.
</body>
 </html>