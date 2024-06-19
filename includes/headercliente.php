<?php
// Iniciar a sessão se não estiver já iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$esta_logado = isset($_SESSION['user_id']);
$user_name = $esta_logado ? $_SESSION['user_name'] : '';
?>

<!--javascript link-->
<script src="../../assets/js/darkmode.js" defer></script>
    <script src="../../assets/js/menumobile.js" defer></script>
    <script src="../../assets/js/modal.js" defer></script>
    <script src="../../assets/js/produto.js" defer></script>
    <script src="../../assets/js/resetform.js" defer></script>
    <script src="../../assets/js/script.js" defer></script>
    <script src="../../assets/js/slide.js" defer></script>
    <script src="../../assets/js/user_log.js" defer></script>
    <script src="../../assets/js/user_log_cliente.js" defer></script>
    <script>var baseUrl = '../../actions/';</script>

<!-- Header Desktop -->
<header class="header-desktop">
    <nav class="navbar">
        <div class="containernav">
            <div class="logoimg">
                <a href="../../pages/index.php"><img src="../../assets/image/unipet.png" alt="imglogo" id="logoimagem"></a>
                <a href="../../pages/index.php"><img src="../../assets/image/dark-mode/unipetdarkmode.png" alt="imglogo" id="logoimagemdarkmode"></a>
            </div>
            <form method="post" action="buscarprodutos.php" class="areainput">
                <div class="imglupa">
                    <button type="submit"><img src="../../assets/image/imagem-menu/lupapng.png" alt="imglupa" id="lupaimagem"></button>
                </div>
                <div class="inputsearch">
                    <input type="text" placeholder="Digite aqui o que seu pet precisa!" id="inputsearch"></input>
                </div>
            </form>
            <div class="iconeslogin">
                <div class="iconlogin"><a href="../../pages/contato.php"><i class="bi bi-telephone-fill" style="font-size:20px;"></i></a></div>
                <div class="iconlogin"><a href="../../pages/login.php"><i class="bi bi-heart" style="font-size:20px;"></i></a></div>
                <div class="iconlogin"><button id="open-modal"><i class="bi bi-cart2" style="font-size:20px;"></i></button></div>
                <div id="fade" class="hide"></div>
                <div id="modal" class="hide">
                    <div class="modal-header">
                        <h2 class="titlemodal">Carrinho</h2>
                        <button id="close-modal"><i class="bi bi-x" style="font-size:40px;"></i></button>
                    </div>
                    <hr class="hrmodal">
                    <div class="modal-body">
                        <div class="container-modal">
                            <div class="paragrafo1"><p><b>Você ainda não tem</b></p></div>
                            <div class="paragrafo1"><p><b>produtos adicionados ao seu carrinho</b></p></div>
                            <div class="sacola-modal"><i class="bi bi-cart2" style="font-size:40px;"></i></div>
                            <div class="paragrafo1"><p>Escolha tudo o que seu Pet precisa e adicione ao</div>
                            <div class="paragrafo1"><p>seu carrinho para comprar.</p></div>
                            <div class="buttonmodal"><button class="btnmodal">Entendi</button></div>
                        </div>
                    </div>
                </div>
                <?php if ($esta_logado): ?>
                    <div class="iconlogin">
                        <i class="bi bi-person" style="font-size:20px;" id="iconemeusdados"></i>
                    </div>
                    <div class="iconlogin">
                        <a href="../../actions/logout.php"><i class="bi bi-box-arrow-right" style="font-size:20px;"></i></a>
                    </div>
                <?php endif; ?>
                <div class="iconlogin">
                    <i id="icon-dark-mode" class="bi bi-moon-fill"></i>
                    <i id="icon-light-mode" class="bi bi-sun-fill"></i>
                </div>
                <div class="entraroucadastrar-se">
                    <?php if ($esta_logado): ?>
                        <span><?php echo htmlspecialchars($user_name); ?></span>
                    <?php else: ?>
                        <a href="../../pages/login.php" class="iconlogin" id="entrar" style="font-size:20px;">Entrar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="areadeservico">
            <ul class="ul-dropdown">
                <li class="li-dropdown">
                    <div class="dificil"> 
                        <a href="../../pages/produtos.php" id="todososprodutos"><b>Todos os Produtos</b></a>
                    </div>
                    <div class="dropdown-menu">
                        <a href="../../pages/categorias/produtos_cachorro.php"><b>Produtos para seu Dog</b></a>
                        <a href="../../pages/categorias/produtos_gato.php"><b>Produtos para seu Gato</b></a>
                        <a href="../../pages/categorias/produtos_ração.php"><b>Ração para seu Amigo(a)</b></a>
                        <a href="../../pages/categorias/produtos_remedio.php"><b>Remédios para seu Amigo(a)</b></a>
                        <a href="../../pages/produtos.php"><b>Coleção UNIPET</b></a>
                    </div>
                </li>
                <li class="li-dropdown">
                    <div class="dificil"> 
                        <a href="../../pages/categorias/produtos_cachorro.php" id="cachorro"><b>Cachorro</b></a>
                    </div>
                </li>
                <li class="li-dropdown">
                    <div class="dificil"> 
                        <a href="../../pages/categorias/produtos_gato.php" id="gato"><b>Gato</b></a>
                    </div>
                </li>
                <li class="li-dropdown">
                    <div class="dificil">
                        <a href="../../pages/categorias/produtos_ração.php" id="pássaro"><b>Ração</b></a>
                    </div>
                </li>
                <li class="li-dropdown">
                    <div class="dificil"> 
                        <a href="../../pages/categorias/produtos_remedio.php" id="remedios"><b>Remédios</b></a>
                    </div>
                </li>
                <li class="li-dropdown">
                    <div class="dificil">  
                        <a href="../../pages/Doação.php" id="doação"><b>Doação</b></a>
                    </div>
                </li>
                <li class="li-dropdown">
                    <div class="dificil">
                        <a href="../../pages/Quem_Somos.php" id="unipet"><b>Unipet</b></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Header Mobile -->
<header class="header-mobile">
    <nav class="navbar">
        <div class="containernav">
            <div class="containertop"> 
                <div class="iconmobile">
                    <div class="mobile-menu-icon">
                        <button id="btn-menu">
                            <i class="bi bi-list" id="iconemenumobile" style="font-size:40px;"></i>
                        </button>
                    </div>
                </div>
                <div class="containerlogo">
                    <a href="../../pages/index.php"><img src="../../assets/image/unipet.png" alt="imglogo" id="logoimagem"></a>
                    <a href="../../pages/index.php"><img src="../../assets/image/dark-mode/unipetdarkmode.png" alt="imglogo" id="logoimagemdarkmode"></a>
                </div>
            </div>

            <div class="areainput">
                <div class="imglupa">
                    <button><img src="../../assets/image/imagem-menu/lupapng.png" alt="imglupa" id="lupaimagem"></button>
                </div>
                <div class="inputsearch">
                    <input type="text" placeholder="Digite aqui o que seu pet precisa!"></input>
                </div>
            </div>

            <div class="menu-mobile" id="menu-mobile">
                <div class="arealoginmobile">
                    <?php if ($esta_logado): ?>
                        <div class="iconlogin">
                            <i class="bi bi-person" style="font-size:20px;" id="iconemeusdados-mobile"></i>
                        </div>
                        <div class="iconlogin">
                            <a href="../../actions/logout.php"><i class="bi bi-box-arrow-right" style="font-size:20px;"></i></a>
                        </div>
                        <span><?php echo htmlspecialchars($user_name); ?></span>
                    <?php else: ?>
                        <a href="../../pages/login.php" class="iconlogin" id="entrar" style="font-size:20px;"><p>Olá, Faça seu login.</p></a>
                    <?php endif; ?>
                    <div class="btn-fechar" id="btn-fechar">
                        <i class="bi bi-x" id="btn-fechar"></i>
                    </div>
                </div>
                <nav>
                    <ul>
                        <div class="titulomobile"><p>Tudo que seu pet precisa</p></div>
                        <li class="li-dropdown">     
                            <div class="dificil"> 
                                <a href="../../pages/produtos.php" id="todososprodutos"><b>Todos os Produtos</b></a>
                            </div>
                        </li>
                        <div class="titulomobile"><p>Departamentos</p></div>
                        <li class="li-dropdown">
                            <div class="dificil"> 
                                <a href="../../pages/categorias/produtos_cachorro.php" id="cachorro"><b>Cachorro</b></a>
                            </div>
                        </li>
                        <li class="li-dropdown">
                            <div class="dificil"> 
                                <a href="../../pages/categorias/produtos_gato.php" id="gato"><b>Gato</b></a>
                            </div>
                        </li>
                        <li class="li-dropdown">           
                            <div class="dificil">
                                <a href="../../pages/categorias/produtos_gato.php" id="pássaro"><b>Ração</b></a>
                            </div>
                        </li>
                        <li class="li-dropdown">
                            <div class="dificil"> 
                                <a href="../../pages/categorias/produtos_gato.php" id="remedios"><b>Remédios</b></a>
                            </div>         
                        </li>
                        <li class="li-dropdown">         
                            <div class="dificil">  
                                <a href="../../pages/Doação.php" id="doação"><b>Doação</b></a>
                            </div>      
                        </li>
                        <li class="li-dropdown">   
                            <div class="dificil">
                                <a href="../../pages/Quem_Somos.php" id="unipet"><b>Unipet</b></a>
                            </div>         
                        </li>
                        <div class="titulomobile"><p>Utilidades</p></div>
                        <div class="areautilidades">
                            <a href="../../pages/contato.php">Contato</a>
                        </div>
                        <div class="titulomobile"><p>Troca de Contraste</p></div>
                        <div class="areacontraste">
                            <div class="darkmode">
                                <i id="icon-dark-mode-mobile" class="bi bi-moon-fill"></i>
                                <i id="icon-light-mode-mobile" class="bi bi-sun-fill"></i>
                            </div>    
                        </div>                          
                    </ul>
                </nav>
            </div><!--menu-mobile-->
            <div class="overlay-menu" id="overlay-menu"></div>
        </div>  
    </nav>
</header>
