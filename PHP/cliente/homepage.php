<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <header class="cabecalhoHP">
        <div class="logotipo">
            <a href="homepage.php">
                <img id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="homepage.php#secondSection">ABOUT US</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="products.php">PRODUCTS</a>
                <a class="tituloGeral sobreEfeito" id="secao3" href="#fourthSection">CONTACTS</a>
            </nav>
        </div>

        <div class="iconesContainer">
            <div class="profileContainer">
                <?php
                // Conexão à base de dados
                require('../baseDados.php');

                session_start();

                // Verifica se o utilizador está logado
                if (isset($_SESSION['nome'])) {
                    $nome = htmlspecialchars($_SESSION['nome']);
                    echo "<p>Bem-vindo, $nome!</p>";
                } else {
                    echo "<p>Por favor, faça login.</p>";
                }
                ?>
                <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
            </div>
            <div class="cartContainer">
                <img class="icones" id="cart" src="/IMAGENS/pictogramaCart.png" alt="cart">
                <span class="countP">0</span>
            </div>
            <div>
                <?php
                // Conexão à base de dados
                require('../baseDados.php');


                if (isset($_SESSION['nome'])) {
                    echo "
                <a href='../logout.php' class='btn-logout'>
                    <img class='icones' id='logout' src='/IMAGENS/logout.png' alt='logout'>
                </a>
                ";
                }
                ?>
            </div>
        </div>
    </header>
    <main>
        <div class="cartBar" id="cartBar">
            <h1 class="tituloGeral title titleSC">Shopping Cart</h1>
            <div class="listCart">
                <div class="item">
                    <div class="itemImg">
                    </div>
                    <div class=" itemModelo">

                    </div>
                </div>
            </div>
            <button class="tituloGeral botaoGeral reservar">RESERVAR</button>
        </div>

        <section class="firstSection">
            <div class="videoInicial">
                <video class="video" muted autoplay loop src="/IMAGENS/videoInicial.mp4" alt="videoInicial"></video>
            </div>
            <div class="sloganInicial">
                <p class="tituloGeral slogan">
                    GO FAST<br>
                    AND FURIOUS.
                </p>
            </div>
        </section>
        <section class="secondSection" id="secondSection">
            <div class="textContainer">
                <div class="textoGeral text">
                    <!--titleSS - titleSecondSection-->
                    <h2 class="tituloGeral title" id="titleSS">ABOUT US</h2>
                    <p><strong>Fast & Furious Cars Inc.</strong> is a leading company in the luxury car rental market. We offer a unique experience for clients seeking elegance, comfort, and quality.
                        Our fleet consists of the most sophisticated vehicles on the market, from executive sedans to sports cars, and we stand out for our exclusivity.
                    </p>
                    <br>
                    <p>Each car is carefully selected to provide an unforgettable experience, whether for a business trip, a special occasion, or simply enjoying the thrill of driving.
                        Our greatest commitment is to unite luxury and practicality, allowing our clients to enjoy a memorable experience with every booking.
                    </p>
                    <br>
                    <p>
                        In addition to our exceptional fleet, we invest in cutting-edge technology to offer a simple and efficient online booking system.
                        The platform allows clients to search for and select the perfect car based on criteria such as brand, style, and price, scheduling the desired rental period in just a few clicks.
                        For administrators, the system provides advanced management tools, such as vehicle visibility controls and real-time statistics, optimizing business operations.
                        Our goal is to redefine the luxury car rental sector by combining exclusivity with personalized services that prioritize customer satisfaction.
                    </p>
                </div>
            </div>
        </section>
        <section class="thirdSection" id="thirdSection">
            <div class="checkthisout">
                <!--titleTS - titleThirdSection-->
                <h2 class="tituloGeral title" id="titleTS">CHECK THIS OUT</h2>
                <div class="painel" id="painel">
                    <?php
                    // conexão à base de dados
                    require('../baseDados.php');

                    // Consulta SQL para ir buscar todos os atibutos da tabela carro
                    $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, 
                    administrador_pessoa_nome, img FROM carro LIMIT 2"; //apenas mostra os dois primeiros reultados(linhas) da tabela

                    // Executar a consulta
                    $resultados = pg_query($connection, $query);

                    // Verificar se a consulta foi bem-sucedida
                    if (!$resultados) {
                        echo "Erro ao procurar os dados dos carros: " . pg_last_error($connection);
                        exit();
                    }

                    // Criar "cartão" 
                    // Loop para processar cada linha
                    while ($carro = pg_fetch_assoc($resultados)) {
                        echo "
                            <a href='products.php'>
                                <div class='carro'>
                                    <div class='legenda' id='legendaP'>
                                        <h3 class='tituloGeral legend'>" . htmlspecialchars($carro['modelo']) . "</h3>
                                    </div>
                                    <img class='imgCarro' id='imgGallery' src='" . htmlspecialchars($carro['img']) . "' alt='carro1'>
                                </div>
                            </a>
                        ";
                    }

                    // Encerra a conexão com a base de dados
                    pg_close($connection);
                    ?>
                </div>
        </section>
    </main>
    <footer class="textoGeral fourthSection" id="fourthSection">
        <div class="conteudoFooter">
            <div class="iconesContact">
                <img class="icoC" id="mail" src="/IMAGENS/pictogramaMail.jpg" alt="iconeMail">
                <img class="icoC" id="phone" src="/IMAGENS/pictogramaTelefone.jpg" alt="iconePhone">
                <img class="icoC" id="local" src="/IMAGENS/pictogramaLocalizacao.jpg" alt="iconeLocal">
            </div>
            <ul>
                <li>fastandfurious@gmail.com</li>
                <li>+351 239 567 307</li>
                <li>Rua Quinta da Beira, lote 3, nº 25, 3030-240, Coimbra</li>
            </ul>
            <div class="iconesMedia">
                <img class="icoM" id="face" src="/IMAGENS/pictogramaFace.png" alt="iconeFacebook">
                <img class="icoM" id="insta" src="/IMAGENS/pictogramaInsta.png" alt="iconeInsta">
                <img class="icoM" id="twitter" src="/IMAGENS/pictogramaTwitter.png" alt="iconeTwitter">
            </div>
        </div>
    </footer>
    <script src="/JS/homepage.js"></script>
    <script src="/JS/header.js"></script>
</body>

</html>