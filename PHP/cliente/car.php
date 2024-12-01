<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car</title>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <header class="cabecalhoGeral">
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

                // Verificar se o utilizador fez login
                if (isset($_SESSION['nome'])) {
                    $nome = htmlspecialchars($_SESSION['nome']);
                    echo "<p>Bem-vindo/a, $nome!</p>";
                } else {
                    echo "<p>Utilizador não autenticado. Por favor, faça login.</p>";
                }
                ?>
                <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
            </div>
            <div class="cartContainer">
                <img class="icones" id="cart" src="/IMAGENS/pictogramaCart.png" alt="cart">
                <!-- TODO: Adicionar a informação dos carros ao carrinho -->
                <span class="countP" id="countP">0</span>
            </div>
        </div>
    </header>
    <main>
        <section class="thirdPage">
            <?php

            // conexão à base de dados
            require('../baseDados.php');

            // Verifica se o atributo "matricula" foi enviado
            if (isset($_GET['matricula'])) { //se foi enviado
                $matricula = pg_escape_string($connection, $_GET['matricula']);

                // Query para buscar os detalhes do carro
                $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img FROM carro WHERE matricula = '$matricula'";
                $resultado = pg_query($connection, $query);

                // Verificar se a consulta foi bem-sucedida
                if ($resultado && pg_num_rows($resultado) > 0) {
                    $carro = pg_fetch_assoc($resultado);

                    // Exibir as informações do carro
                    echo "
                                    <div class='thirdPageContainer'> 
                                        <h1 class='tituloGeral tituloTP'>" . htmlspecialchars($carro['modelo']) . "</h1>
                                        <div class='detalhesCarro'>
                                            <img class='imagem' src='" . htmlspecialchars($carro['img']) . "' alt='" . htmlspecialchars($carro['modelo']) . "'>
                                           
                                            <div class='caractContainer'>
                                                <div class='caracteristicas'>
                                                    <h1 class='tituloGeral nomeCarro'>Specifications</h1>
                                                    <ul class='tituloGeral topicos'>
                                                        <li>
                                                            <span class='tituloGeral'>Registration Plate -</span>
                                                            <span class='textoGeral'>" . htmlspecialchars($carro['matricula']) . "</span>
                                                        </li>
                                                        <li>
                                                            <span class='tituloGeral'>Number of Seats -</span>
                                                            <span class='textoGeral'> " . htmlspecialchars($carro['nmr_lugares']) . "</span>
                                                        </li>
                                                        <li>
                                                            <span class='tituloGeral'>Color -</span>
                                                            <span class='textoGeral'>" . htmlspecialchars($carro['cor']) . "</span>
                                                        </li>
                                                        <li>
                                                            <span class='tituloGeral'>Year -</span>
                                                            <span class='textoGeral'>" . htmlspecialchars($carro['ano']) . "</span>
                                                        </li>
                                                        <li>
                                                            <span class='tituloGeral'>Cost per Day -</span>
                                                            <span class='textoGeral'>" . htmlspecialchars($carro['custo_max_dia']) . "€</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class='buttonContainer'>
                                                    <div>
                                                        <button class='tituloGeral btn date startBtn'>START</button>
                                                        <input class='dateInput startDate' type='date'>
                                                    </div>
                                                    <div>
                                                        <button class='tituloGeral btn date endBtn'>END</button>
                                                        <input class='dateInput endDate' type='date'>
                                                    </div>
                                                    <div>
                                                        <button class='tituloGeral btn carBtn' id='carBtn' onclick='test(" . htmlspecialchars($carro['matricula']) . ")'>ADD TO CART</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ";
                } else {
                    echo "<p>Carro não encontrado.</p>";
                }
            } else {
                echo "<p>Matrícula não especificada.</p>";
            }

            // Fechar a conexão
            pg_close($connection);
            ?>

        </section>
    </main>
    <script src="/JS/car.js"></script>
</body>

</html>

<!-- <div class='element'>
                            <div class='wrapbutton'>
                                <div class='dateContainer'>
                                    <button class='tituloGeral date startBtn'>START</button>
                                    <input class='dateInput startDate' type='date'>
                                </div>
                                <div class='dateContainer'>
                                    <button class='tituloGeral date endBtn'>END</button>
                                    <input class='dateInput endDate' type='date'>
                                </div>
                            </div>
                            <button class='botaoPlus' onclick='test(" . htmlspecialchars($carro['matricula']) . ")'><img class='imgPlus' src='/IMAGENS/pictogramaPlus.png' alt='adicionar'></button>
                        </div> -->