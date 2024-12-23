<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <header class="cabecalhoHP">
        <div class="logotipo">
            <a href="homepage.php">
                <img class="logo" id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="homepage.php#thirdSection">STATISTICS</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="products.php">PRODUCTS</a>
                <a class="tituloGeral sobreEfeito" id="secao3" href="#fourthSection">CONTACTS</a>
            </nav>
        </div>

        <div class="iconesContainer">
            <div class="profileContainer">
                <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">

                <div class="textoGeral loginNome">

                    <?php

                    //conexão à base de dados
                    require('../comuns/baseDados.php');

                    //verifica se a sessão foi iniciada
                    session_start();

                    //guarda o nome do utilizador
                    if (isset($_SESSION['nome'])) {
                        $nome = htmlspecialchars($_SESSION['nome']);
                        echo "<p>Welcome, $nome!</p>";
                    } else {
                        echo "<p>Please login</p>";
                    }
                    ?>

                </div>
            </div>

            <div class="tituloGeral opcoesCont" id="opcoesCont">
                <a href="perfil.php">
                    <div class="sobreEfeito opcoes account" id="acount">
                        <p>MY ACCOUNT</p>
                    </div>
                </a>

                <?php
                //conexão à base de dados
                require('../comuns/baseDados.php');

                //se clicar no botão de logout encerro sessão
                if (isset($_SESSION['nome'])) {
                    echo "
                <a href='../comuns/logout.php' class='btn-logout'>
                    <div class='sobreEfeito opcoes logout' id='logout'>
                        <p>LOGOUT</p>
                    </div>
                </a>
                ";
                }
                ?>

            </div>
        </div>
    </header>
    <main>
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
                    <p><strong>Fast & Furious Cars Inc.</strong> is a leading company in the luxury car rental market.
                        We offer a unique experience for clients seeking elegance, comfort, and quality.
                        Our fleet consists of the most sophisticated vehicles on the market, from executive sedans to
                        sports cars, and we stand out for our exclusivity.
                    </p>
                    <br>
                    <p>Each car is carefully selected to provide an unforgettable experience, whether for a business
                        trip, a special occasion, or simply enjoying the thrill of driving.
                        Our greatest commitment is to unite luxury and practicality, allowing our clients to enjoy a
                        memorable experience with every booking.
                    </p>
                    <br>
                    <p>
                        In addition to our exceptional fleet, we invest in cutting-edge technology to offer a simple and
                        efficient online booking system.
                        The platform allows clients to search for and select the perfect car based on criteria such as
                        brand, style, and price, scheduling the desired rental period in just a few clicks.
                        For administrators, the system provides advanced management tools, such as vehicle visibility
                        controls and real-time statistics, optimizing business operations.
                        Our goal is to redefine the luxury car rental sector by combining exclusivity with personalized
                        services that prioritize customer satisfaction.
                    </p>
                </div>
            </div>
        </section>
        <section class="thirdSection thirdSectionAdmin" id="thirdSection">
            <div class="textoGeral text">
                <!--titleSS - titleSecondSection-->
                <h2 class="tituloGeral title" id="titleSS">STATISTICS</h2>

                <?php
                require('../comuns/baseDados.php');

                //estatísticas
                $stats = [];

                //consulta a tabela carro e conta o número total de carros lá presentes
                $queryCarros = "SELECT COUNT(*) AS total_carros FROM carro";
                $resultCarros = pg_query($connection, $queryCarros);
                $stats['total_carros'] = pg_fetch_result($resultCarros, 0, 'total_carros');

                //consulta a tabela reserva e conta o número de clientes (apenas um de cada) que fizeram reservas
                $queryUtilizadores = "SELECT COUNT(DISTINCT cliente_pessoa_nome) AS total_utilizadores FROM reserva";
                $resultUtilizadores = pg_query($connection, $queryUtilizadores);
                $stats['total_utilizadores'] = pg_fetch_result($resultUtilizadores, 0, 'total_utilizadores');

                //calcula a média do número de reservas feitas por cliente
                $queryMediaReservas = "
                    SELECT AVG(reservas_por_utilizador) AS media_reservas 
                    FROM (
                        SELECT COUNT(*) AS reservas_por_utilizador 
                        FROM reserva 
                        GROUP BY cliente_pessoa_nome
                    ) AS subquery";
                $resultMediaReservas = pg_query($connection, $queryMediaReservas);
                $stats['media_reservas'] = pg_fetch_result($resultMediaReservas, 0, 'media_reservas');

                //calcula o custo médio diário dos carros
                $queryCustoMedio = "SELECT AVG(custo_max_dia) AS custo_medio_carro FROM carro";
                $resultCustoMedio = pg_query($connection, $queryCustoMedio);
                $stats['custo_medio_carro'] = pg_fetch_result($resultCustoMedio, 0, 'custo_medio_carro');

                //ESTATÍSTICA ESCOLHIDA POR NÓS
                //calcula qual é o carro mais reservado
                $queryCarroPopular = "
                    SELECT carro.modelo, COUNT(reserva.carro_matricula) AS total_reservas 
                    FROM reserva
                    JOIN carro ON reserva.carro_matricula = carro.matricula
                    GROUP BY carro.modelo
                    ORDER BY total_reservas DESC
                    LIMIT 1";
                $resultCarroPopular = pg_query($connection, $queryCarroPopular);
                $carroPopular = pg_fetch_assoc($resultCarroPopular);
                $stats['carro_popular'] = $carroPopular;

                pg_close($connection);
                ?>

                <ul class="topicos">
                    <li>
                        <span class='textoGeral specific'>Total Products (cars):</span>
                        <span class='textoGeral'><?= htmlspecialchars($stats['total_carros']); ?></span>
                    </li>
                    <li>
                        <span class='textoGeral specific'>Total Users who Reserved Cars:</span>
                        <span class='textoGeral'><?= htmlspecialchars($stats['total_utilizadores']); ?></span>
                    </li>
                    <li>
                        <span class='textoGeral specific'>Average Reservations per User:</span>
                        <span class='textoGeral'><?= htmlspecialchars(number_format($stats['media_reservas'], 2)); ?></span>
                    </li>
                    <li>
                        <span class='textoGeral specific'>Average car cost per day:</span>
                        <span class='textoGeral'><?= htmlspecialchars(number_format($stats['custo_medio_carro'], 2)); ?>€</span>
                    </li>
                    <li>
                        <span class='textoGeral specific'>Most Reserved Car: </span>
                        <span class='textoGeral'><?= htmlspecialchars($stats['carro_popular']['modelo']) . " (" . htmlspecialchars($stats['carro_popular']['total_reservas']) . " reservations)"; ?></span>
                    </li>
                </ul>
                <div class="graficos">
                    <div class="graficoModelos">
                        <canvas id="graficoModelos"></canvas>
                    </div>
                    <div class="graficoReservas">
                        <canvas id="graficoReservas"></canvas>
                    </div>
                </div>


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
    <script src="/JS/graficos.js"></script>
</body>

</html>