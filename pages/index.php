<?php
require '../includes/functions.php';



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

  <!--bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://kit.fontawesome.com/a7c3ed8833.js" crossorigin="anonymous"></script>

  

  <!--icon-->
  <link rel="shortcut icon" href="../assets/image/favicon/icon-unipet.png" type="">

  <!--css link-->
  
  <link rel="stylesheet" href="../assets/css/index.css">
  <link rel="stylesheet" href="../assets/css/sliderindex.css">
  <link rel="stylesheet" href="../assets/css/modal.css">
  <link rel="stylesheet" href="../assets/css/menufixo.css">
  <link rel="stylesheet" href="../assets/css/footer.css">

  <!-- javascript -->
  <script>var headerBaseUrl = '../assets/';</script>
  <script>var footerBaseUrl = '../assets/image/';</script>


</head>

<body>

<!-- Header - Menu -->
<?php include_once '../includes/header.php'; ?>

    <section class = "sectionmsg">
      <div class = mensagemcadastre-se>
        <a href="cadastre-se.php"><i class="bi bi-suit-heart-fill" ></i><span>Cadastre-se Agora! e faça parte da comunidade <B>UNIPET</B></span></a>
      </div>
    </section>
  
    <section class = slider>
      <div class = slider-content>
        <input type="radio" name="btn-radio" id="radio1">
        <input type="radio" name="btn-radio" id="radio2">
        <input type="radio" name="btn-radio" id="radio3">
        <input type="radio" name="btn-radio" id="radio4">

        <div class = "slide-box primeiro">
          <a href="../pages/produtos.php">
          <img class = "img-desktop" src="../assets/image/banner/BANNER FELICIDADE DALMATA.png" alt="slide 1">
          <img class = "img-mobile" src="../assets/image/banner/bannersmobile/1.png" alt="slide 1">
          </a>
        </div>

        <div class = "slide-box ">
          <a href="../pages/detalhesproduto.php?id=25">  
          <img class = "img-desktop" src="../assets/image/banner/3.png" alt="slide 1">
          <img class = "img-mobile" src="../assets/image/banner/bannersmobile/2.png" alt="slide 1">
        </a>
        </div>

        <div class = "slide-box ">
          <a href="../pages/categorias/produtos_cachorro.php">
          <img class = "img-desktop" src="../assets/image/banner/1.png" alt="slide 1">
          <img class = "img-mobile" src="../assets/image/banner/bannersmobile/3.png" alt="slide 1">
        </a>
        </div>

        <div class = "slide-box ">
          <a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%2C%20gostaria%20de%20tirar%20algumas%20d%C3%BAvidas%20sobre%20a%20UniPet" target="_blank">
          <img class = "img-desktop" src="../assets/image/banner/2.png" alt="slide 1">
          <img class = "img-mobile" src="../assets/image/banner/bannersmobile/4.png" alt="slide 1">
          </a>
        </div>

        <div class ="nav-auto">
          <div class = "auto-btn1"></div>
          <div class = "auto-btn2"></div>
          <div class = "auto-btn3"></div>
          <div class = "auto-btn4"></div>
        </div>

        <div class ="nav-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
        </div>
      </div>
    </section>

  <main>
      <!--Categoria-->
      <section class="secao categoria">
        <div class="container">
          
          <h2 class="h2 secao-titulo">
            <hr>
            <span class="span">Principais</span> Categorias
          </h2>

          <ul class="lista lista-item-categoria">
            <li class="lista-item">
              <div class="card-categoria">
                <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
                  <a href="../pages/categorias/produtos_cachorro.php">
                  <img src="../assets/image/categorias/cachorro.png"  alt="" class="img-cover">
                </figure>
                <h3 class="h3">
                  <a href="../pages/categorias/produtos_cachorro.php" class="card-titulo">Cachorro</a>
                </h3>
              </div>
            </li>

            <li class="lista-item">
              <div class="card-categoria">
                <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
                  <a href="../pages/categorias/produtos_gato.php">
                  <img src="../assets/image/categorias/gato.png"  alt="" class="img-cover">
                </a>
                </figure>
                <h3 class="h3">
                  <a href="../pages/categorias/produtos_gato.php" class="card-titulo">Gatos</a>
                </h3>
              </div>
            </li>

            <li class="lista-item">
              <div class="card-categoria">
                <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
                  <a href="../pages/categorias/produtos_ração.php">
                  <img src="../assets/image/categorias/raçãocategoria.jpg"  alt="" class="img-cover">
                  </a>
                </figure>
                <h3 class="h3">
                  <a href="../pages/categorias/produtos_ração.php" class="card-titulo">Rações</a>
                </h3>
              </div>
            </li>

          

            <li class="lista-item">
              <div class="card-categoria">
                <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
                  <a href="../pages/categorias/produtos_remedio.php">
                  <img src="../assets/image/categorias/medicamentos.png"  alt="" class="img-cover">
                </a>
                </figure>
                <h3 class="h3">
                  <a href="../pages/categorias/produtos_remedio.php" class="card-titulo">Remedios</a>
                </h3>
              </div>
            </li>
            <li class="lista-item">
              <div class="card-categoria">
                <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
                  <a href="../pages/produtos.php">
                  <img src="../assets/image/categorias/todososprodutos.png"  alt="" class="img-cover">
                </a>
                </figure>
                <h3 class="h3">
                  <a href="../pages/produtos.php" class="card-titulo">Todos os Produtos</a>
                </h3>
              </div>
            </li>
          </ul>
        </div>
      </section>
    <hr>

      <!--Ofertas-->
      <section class="secao oferta">
        <div class="container">
          <h2 class="h2 secao-titulo">
            <span >Seu PET <span class="span"> Nossa Paixão</span>
          </h2>
          <ul class="lista-grid">
            <a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%2C%20gostaria%20de%20agendar%20o%20banho%20tosa%20do%20meu%20Pet" target="_blank">
              <li>
                <div class="card-oferta bg-image img-holder" style="background-image: url('../assets/image/CallToAction/CTA1.png'); --width: 540; --height: 374;">
                  <p class="card-legenda"></p>
                  <h3 class="h3 card-titulo">
                    <span class="span"></span>
                  </h3>
                </div>
              </li>
            </a>

            <a href="../pages/categorias/produtos_gato.php">
              <li>
                <div class="card-oferta bg-image img-holder" style="background-image: url('../assets/image/CallToAction/CTA2.png'); --width: 540; --height: 374; ">
                  <p class="card-legenda"></p>
                  <h3 class="h3 card-titulo">
                    <span class="span"></span>
                  </h3>
                </div>
              </li>
            </a>

            <a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%2C%20gostaria%20de%20agendar%20a%20vacina%20do%20meu%20Pet" target="_blank">
              <li>
                <div class="card-oferta bg-image img-holder" style="background-image: url('../assets/image/CallToAction/CTA3.png'); --width: 540; --height: 374; ">
                  <p class="card-legenda"></p>
                  <h3 class="h3 card-titulo">
                    <span class="span"></span>
                  </h3>
                </div>
              </li>
            </a>
          </ul>
        </div>
      </section>

      <hr>

      <!--Produto-->
      <section class="secao produto">
        <div class="container">
          <h2 class="h2 secao-titulo">
            <span class="span">Mais</span> Vendidos
          </h2>

          <ul class="lista-grid">
            
              <li>
                <div class="card-produto">
                  <div class="card-banner img-holder" >
                    <a href="goldenformula.php"><img src="../assets/image/produtos/produto01.png" alt="" class="img-cover default"></a>
                  </div>

                  <div class="card-conteudo">
                    <h3 class="h3">
                      <a href="goldenformula.php" class="card-titulo">Ração Golden Special para Cães </a>
                    </h3>
                    <data class="card-preco" value="97">R$97.00</data>
                  </div>
                </div>
              </li>
        
              <li>
                <div class="card-produto">
                  <div class="card-banner img-holder" >
                    <a href="whiskas.php"><img src="../assets/image/produtos/produto02.png" alt="" class="img-cover default"></a>
                  </div>
                  <div class="card-conteudo">
                    <h3 class="h3">
                      <a href="whiskas.php" class="card-titulo">Promoção Leve 3 e Pague 2</a>
                    </h3>
                    <data class="card-preco" value="149">R$149,90</data>
                  </div>
                </div>
              </li>

              <li>
                <div class="card-produto">
                  <div class="card-banner img-holder" >
                    <a href="biotronnativo.php"><img src="../assets/image/produtos/produto03.png" alt="" class="img-cover default"></a>
                  </div>
                  <div class="card-conteudo">
                    <h3 class="h3">
                      <a href="biotronnativo.php" class="card-titulo">Biotron Nativos</a>
                    </h3>
                    <data class="card-preco" value="69">R$69.97</data>
                  </div>
                </div>
              </li>

              <li>
                <div class="card-produto">
                  <div class="card-banner img-holder" >

                    <a href="simparic.php"><img src="../assets/image/produtos/produto04.png" alt="" class="img-cover default"></a>
                  </div>
                  <div class="card-conteudo">
                    <h3 class="h3">
                      <a href="simparic.php" class="card-titulo">Simparic</a>
                    </h3>
                    <data class="card-preco" value="49">R$1.00</data>
                  </div>
                </div>
              </li>

            <!--OUTROS 4 PRODUTOS--
            <li>
              <div class="card-produto">

                <div class="card-banner img-holder" >
                  <img src="../assets/image/produtos/product-5.jpg"
                    alt="" class="img-cover default">
                  <img src="../assets/image/produtos/product-5_0.jpg"
                    alt="" class="img-cover hover">
                </div>

                <div class="card-conteudo">

                  <h3 class="h3">
                    <a href="#" class="card-titulo">Abacaxi</a>
                  </h3>

                  <data class="card-preco" value="85">R$85.00</data>

                </div>

              </div>
            </li>

            <li>
              <div class="card-produto">

                <div class="card-banner img-holder" >
                  <img src="../assets/image/produtos/product-6.jpg"
                    alt="" class="img-cover default">
                  <img src="../assets/image/produtos/product-6_0.jpg"
                    alt="" class="img-cover hover">
                </div>

                <div class="card-conteudo">

                  <h3 class="h3">
                    <a href="#" class="card-titulo">Abacaxi</a>
                  </h3>

                  <data class="card-preco" value="85">R$85.00</data>

                </div>

              </div>
            </li>

            <li>
              <div class="card-produto">

                <div class="card-banner img-holder">
                  <img src="../assets/image/produtos/product-7.jpg"
                    alt="" class="img-cover default">
                  <img src="../assets/image/produtos/product-7_0.jpg"
                    alt="" class="img-cover hover">

                </div>

                <div class="card-conteudo">

                  <h3 class="h3">
                    <a href="#" class="card-titulo">Abacaxi</a>
                  </h3>

                  <data class="card-preco" value="85">R$85.00</data>

                </div>

              </div>
            </li>

            <li>
              <div class="card-produto">

                <div class="card-banner img-holder">
                  <img src="../assets/image/produtos/product-8.jpg"
                    alt="" class="img-cover default">
                  <img src="../assets/image/produtos/product-8_0.jpg"
                    alt="" class="img-cover hover">
                </div>

                <div class="card-conteudo">

                  <h3 class="h3">
                    <a href="#" class="card-titulo">Abacaxi</a>
                  </h3>

                  <data class="card-preco" value="55">R$55.00</data>

                </div>
                <--OUTROS 4 PRODUTOS-->
              </div>
            </li>
          </ul>
        </div>
      </section>


      <hr>


      <!--SERVIÇO-->

      <section class="secao servico" >
        <div class="container">
          <div class = boximgtudoqueseupetprecisa>
            <a href="../pages/produtos.php">
              <img src="../assets/image/sectionindex/querocomprarunipet.png" class =imgtudoqueseupetprecisa  alt="" class="img">
            </a>
          </div>

          <img src="../assets/image/service-image.png" class="img" alt="">

            <h2 class="h2 secao-titulo">
              <span class="span">Tudo Que Seu Pet Precisa,</span> Quando Ele Precisa.
            </h2>

          <ul class="lista-grid">
            <li>
              <div class="card-servico">
                <figure class="card-icon">
                  <img src="../assets/image/icon-servico/service-icon-1.png" alt="">
                </figure>
                <h3 class="h3 card-titulo">Temos Delivery!</h3>
                <p class="card-texto">
                  Após a confirmação do pagamento ja iniciaremos o processo para enviar o produto do seu amigão!
                </p>
              </div>
            </li>

            <li>
              <div class="card-servico">
                <figure class="card-icon">
                  <img src="../assets/image/icon-servico/service-icon-2.png" alt="">
                </figure>
                <h3 class="h3 card-titulo">Garantia ou Reembolso</h3>
                <p class="card-texto">
                  A Unipet oferece 30 Dias de Garantia ou Reembolso caso o produto apresentar algum tipo de problema. Contate-nos via Whatsapp
                </p>
              </div>
            </li>

            <li>
              <div class="card-servico">
                <figure class="card-icon">
                  <img src="../assets/image/icon-servico/service-icon-3.png" alt="">
                </figure>
                <h3 class="h3 card-titulo">Compra Segura</h3>
                <p class="card-texto">
                  Pagamento totalmente seguro e confiavel.
                </p>
              </div>
            </li>

            <li>
              <div class="card-servico">
                <figure class="card-icon">
                  <img src="../assets/image/icon-servico/service-icon-4.png" alt="">
                </figure>
                <h3 class="h3 card-titulo">Suporte 24/7</h3>
                <p class="card-texto">
                  Nossa equipe estará sempre aqui para ajudar você, qualquer dúvida contate-nos, brevemente será respondido.
                </p>
              </div>
            </li>
          </ul>
        </div>
      </section>

      <hr>

      <!--Gato-->
      <section>
        <div class="container">
            <div class = imgsection>
            <img src="../assets/image/sectionindex/entreemcontatounipet.png" alt="" class="w-100">
          </div>
          <h2 class="h2 secao-titulo">
            <span class="span">Alguma Dúvida?<br></span> Fale com nossa Equipe.
          </h2>
          <a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%2C%20gostaria%20de%20tirar%20algumas%20d%C3%BAvidas%20sobre%20a%20UniPet" target="_blank">
          <div class =btncontato>
            
            <button class = btnconosco>Fale Conosco</button>
          </div>
</a>
        

          <div class="gato-content">
            <img src="" alt="" class="img">
            <h2 class="h2 secao-titulo"></h2>
            <p class="secao-texto">
              <a href="" id="invisivel"></a>
            </p>
          </div>
        </div>
      </section>

      <hr>

      <!--Marcas-->
      <section class="secao marca">
        <div class="container">
          <h2 class="h2 secao-titulo">
            <span class="span">Marcas</span> Populares
          </h2>
          <ul class="lista">
            <li class="lista-item">
              <div class="card-marca img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/image/marcas/brand-1.jpg" alt="" class="img-cover">
              </div>
            </li>

            <li class="lista-item">
              <div class="card-marca img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/image/marcas/brand-2.jpg" alt="" class="img-cover">
              </div>
            </li>

            <li class="lista-item">
              <div class="card-marca img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/image/marcas/brand-3.jpg" alt="" class="img-cover">
              </div>
            </li>

            <li class="lista-item">
              <div class="card-marca img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/image/marcas/brand-4.jpg" alt="" class="img-cover">
              </div>
            </li>

            <li class="lista-item">
              <div class="card-marca img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/image/marcas/brand-5.jpg" alt="" class="img-cover">
              </div>
            </li>
          </ul>
        </div>
      </section>
  </main>



<!-- Footer -->
<?php include_once '../includes/footer.php'; ?>

  <!-- Voltar para cima -->

  <a id="link-topo" href="#">&#9650;</a>

<!--Botão whatsapp-->
<a href="https://api.whatsapp.com/send?phone=5521971682272&text=Ol%C3%A1%20gostaria%20de%20saber%20mais%20sobre%20a%20Unipet" target="_blank"><img src="https://host2b.net/download/imagem/whatsapp-icon.png" style="height:60px; position:fixed; bottom:25px; left:25px; z-index:99999;" data-selector="img"></a>

</body>

</html>