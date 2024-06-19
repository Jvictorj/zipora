<?php
require '../includes/functions.php';

// Iniciar a sessão se não estiver já iniciada
startSessionIfNotStarted();



// Obter o nome do usuário da sessão
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--icon-->
      <title> Cachorro - O seu Melhor Amigo</title>
      <meta name="title" content="Unipet - Ração de Alta Qualidade">
      <meta name="description" content="Loja virtual">
    
      <!--bootstrap icons-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <!--icon-->
      <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.png" type="">
      <!--css link-->
      <link rel="stylesheet" href="../assets/css/quemsomos.css">
      <link rel="stylesheet" href="../assets/css/menufixo.css">
      <link rel="stylesheet" href="../assets/css/modal.css">
      <link rel="stylesheet" href="../assets/css/footer.css">

      <!-- javascript -->
    <script>var headerBaseUrl = '../assets/';</script>
    <script>var footerBaseUrl = '../assets/image/';</script>
    
 </head>
 <body>
     <!--Header Desktop-->
  <!--menu-->
  <?php include_once '../includes/header.php'; ?>


    <!--Header Mobile-->
   <section class = banner>
    <div class = banner-content>
      <div class = "banner-box">
      <img class = "img-desktop" src="../assets/image/banneracategoria/BANNERQUEMSOMOS.png" alt="slide 1">
      </div>
      </div>
   </section>
   <section class = containermain>
   
    <div class = container>
        <div class = containerheaddescription>
            <div class = contentimg>
                <img src="../assets/image/quemsomos/QUEM SOMOS.png" alt="">
            </div>
            <div class = description>
            <h1>Bem-vindo à <b style="color: rgb(255, 128, 0);">Unipet,</b>, o seu destino definitivo para tudo relacionado aos cuidados e bem-estar dos seus animais de estimação.</h1>
            <h4>Fundada por sete universitários da renomada instituição Unisuam, a Unipet surgiu da paixão compartilhada por animais e da dedicação à comunidade pet.</h4>
            <div class = btncomprar><button class="comprar"><a  classs = abutton href="https://www.unisuam.edu.br/" target="_blank">Ir à Unisuam <i class="bi bi-arrow-right"></i></a> </button></div>
            </div>
        </div>
        <div class = videodescription>
           <video class = videosrc src="../assets/videos/quemsomos/O Ninho tá On _ Boas-vindas aos alunos _ UNISUAM.mp4" autoplay muted loop></video>
        </div>
            </div>
            <div class = container2>
                <div class = containerheaddescription2>
                    <div class = contentimg>
                        <img src="../assets/image/quemsomos/NOSSA MISSÃO.png" alt="">
                    </div>
                    <div class = contentimg2>
                        <img src="../assets/image/quemsomos/gatinhoquemsomos.png" alt="">
                    </div>
                    </div>
                    <div class = containercard>
                    <div class = containercard-conteudo>
                     <h1>✔️ Na <b style="color: rgb(255, 128, 0);">Unipet,</b> nossa missão é fornecer <b style="color: rgb(255, 128, 0);">produtos</b> e <b style="color: rgb(255, 128, 0);"> serviços</b> de alta qualidade que <b style="color: rgb(255, 128, 0);">promovam</b> a saúde, felicidade e vitalidade dos seus animais de estimação.</h1>
                        <h4>✔️ Nosso compromisso com a <b style="color: rgb(255, 128, 0);">execlência</b> se estende desde a seleção dos <b style="color: rgb(255, 128, 0);">melhores produtos</b> até a prestação de um atendimento personalizado e <b style="color: rgb(255, 128, 0);">atencioso</b> a cada cliente.</h4>
                    </div>
                </div>                
                </div>
                <div class = container>
                    <div class = containerheaddescription>
                        <div class = contentimg>
                            <img src="../assets/image/quemsomos/NOSSA VISAO.png" alt="">
                        </div>
                        <div class = description>
                        <h1>Nosso <b style="color: rgb(255, 128, 0);">objetivo</b> é nos tornarmos a <b style="color: rgb(255, 128, 0);">principal referência</b> no segmento pet, não apenas por oferecer produtos de <b style="color: rgb(255, 128, 0);">qualidade</b>, mas também por sermos reconhecidos pela nossa dedicação à comunidade pet e pela nossa contribuição para o <b style="color: rgb(255, 128, 0);">bem-estar animal</b></h1>
                        
                        <div class = btncomprar><button class="comprar"><a  classs = abutton href="todososprodutos.html" target="_blank">Produção UNIPET<i class="bi bi-arrow-right"></i></a> </button></div>
                        </div>
                    </div>
                    <div class = videodescription>
                       <video class = videosrc src="../assets/videos/quemsomos/O Ninho tá On _ Volta às Aulas e boas-vindas aos calouros e veteranos _ UNISUAM.mp4" autoplay muted loop></video>
                    </div>
                </div>                   
   </section>

   <section  class = containermain >
    <div class = container3>
        <div class = containerheaddescription3>
            <div class = contentimg>
                <img src="../assets/image/quemsomos/O DIFRENCIAL.png" alt="">
            </div>
            <div class = contentimg3>
                <img src="../assets/image/quemsomos/cachorroquemsomos.png" alt="">
            </div>
            </div>
            <div class = containercard1>
            <div class = containercard-conteudo>
             <h1> Na <b style="color: rgb(255, 128, 0);">Unipet</b>, valorizamos a expertise adquirida em nossa formação universitária na <b style="color: rgb(255, 128, 0);">Unisuam</b>. Combinando conhecimento teórico com <b style="color: rgb(255, 128, 0);">paixão</b> prática pelos animais.🐾 </h1>
                <h4> Estamos constantemente atualizados com as últimas <b style="color: rgb(255, 128, 0);">tendências</b> e <b style="color: rgb(255, 128, 0);">inovações</b> do setor pet. Além disso, nos destacamos por:</h4>
            </div>
        </div>  
        </div>
   </section>
   <section  class = containermain>
    <div class = container4>
    <div class = containercard3 style="background-image: url(../assets/image/quemsomos/1.png);"></div>  
    <div class = containercard3 style="background-image: url(../assets/image/quemsomos/2.png);"></div>  
    <div class = containercard3 style="background-image: url(../assets/image/quemsomos/3.png);"></div>  
    <div class = containercard3 style="background-image: url(../assets/image/quemsomos/4.png);"></div>  
    <div class = containercard3 style="background-image: url(../assets/image/quemsomos/5.png);"></div>  
    <div class = containercard3 style="background-image: url(../assets/image/quemsomos/6.png);"></div> 
  </div>
</div> 
</div>            
  </section>

   <hr>
   <section  class = containermain>
    <div class = containerfinal>
      <div class = containerboxfinal>
        <div class = containerboximgdescription>
        <div class = imgboxfinal><img src="../assets/image/quemsomos/finalquemsomos.jpg" alt=""></div>
        <div class = descripitionimg><h1>Tudo para manter a saúde do seu pet em dia</h1>
          <p>Vacinas, consultas e exames com qualidade e carinho.</p>
          <div class = btnsaibamais><a href="https://api.whatsapp.com/send?phone=5521971682272&text=Gostaria%20de%20mais%20informa%C3%A7%C3%B5es%20sobre%20a%20UniPet" target="_blank" class = btnsaiba><button>Saiba mais sobre a UNIPET</button></a></div>
        </div>
      </div>
      
      </div>
    </div>
   </section>
   

  <!--Rodape-->
  <?php include_once '../includes/footer.php'; ?>

  <!-- 
    - #BACK TO TOP
  -->

  <a id="link-topo" href="#">&#9650;</a>



<!--Botão whatsapp-->
<a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%20gostaria%20de%20saber%20mais%20sobre%20a%20Unipet" target="_blank"><img src="https://host2b.net/download/imagem/whatsapp-icon.png" style="height:60px; position:fixed; bottom:25px; left:25px; z-index:99999;" data-selector="img"></a>
<!--Botão whatsapp-->.

</body>
</html>