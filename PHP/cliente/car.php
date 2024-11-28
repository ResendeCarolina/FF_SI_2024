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
            <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
            <div class="cartContainer">
                <img class="icones" id="cart" src="/IMAGENS/pictogramaCart.png" alt="cart">
                <!-- TODO: Adicionar a informação dos carros ao carrinho -->
                <span class="countP" id="countP">0</span>
            </div>
        </div>
    </header>
    <main>
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
                        <div class='carroDetalhes'>
                            <h1 class='tituloGeral'>" . htmlspecialchars($carro['modelo']) . "</h1>
                            <img class='imagem' src='" . htmlspecialchars($carro['img']) . "' alt='" . htmlspecialchars($carro['modelo']) . "'>
                            <div>
                                <ul class='tituloGeral topicos'>
                                    <li>REGISTRATION PLATE</li>
                                    <li>NUMBER OF SEATS</li>
                                    <li>COLOR</li>
                                    <li>YEAR</li>
                                    <li>COST PER DAY</li>
                                </ul>
                                <ul class='textoGeral respostas'>
                                    <li>" . htmlspecialchars($carro['matricula']) . "</li>
                                    <li>" . htmlspecialchars($carro['nmr_lugares']) . "</li>
                                    <li>" . htmlspecialchars($carro['cor']) . "</li>
                                    <li>" . htmlspecialchars($carro['ano']) . "</li>
                                    <li>" . htmlspecialchars($carro['custo_max_dia']) . "€</li>
                                </ul>
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
    </main>
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