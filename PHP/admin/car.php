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
                <img class="logo" id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="homepage.php#secondSection">ABOUT US</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="products.php">PRODUCTS</a>
                <a class="tituloGeral sobreEfeito" id="secao3" href="homepage.php#fourthSection">CONTACTS</a>
                <a class="tituloGeral sobreEfeito" id="reserva">RESERVAS</a>
            </nav>
        </div>

        <div class="iconesContainer">
            <div class="profileContainer">
                <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">

                <div class="textoGeral loginNome">
                    <?php
                    // Conexão à base de dados
                    require('../comuns/baseDados.php');

                    session_start();
                    // Verificar se o utilizador está logado
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
                // Conexão à base de dados
                require('../comuns/baseDados.php');


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
        <div class="cartBar" id="cartBar">
            <h1 class="tituloGeral titleSC">Reservations List</h1>
            <div class="listCart">
                <div class="item">
                    <div class="itemImg">
                    </div>
                    <div class="itemModelo">
                    </div>
                </div>
            </div>
        </div>

        <?php

        // Verifica se o atributo "matricula" foi enviado
        if (isset($_GET['matricula'])) { //se foi enviado
            $matricula = pg_escape_string($connection, $_GET['matricula']);

            // Query para buscar os detalhes do carro
            $queryCarro = "SELECT carro.matricula, carro.modelo, carro.nmr_lugares, carro.cor, carro.ano, carro.custo_max_dia, carro.img, 
                                      reserva.data_inicio, reserva.data_fim, reserva.carro_matricula, reserva.cliente_pessoa_nome,
                              (SELECT COUNT (*) FROM reserva WHERE reserva.carro_matricula = carro.matricula) AS total_reservas 
                FROM carro, reserva
                WHERE carro.matricula = reserva.carro_matricula
                AND matricula = '$matricula'";

            $resultado = pg_query($connection, $queryCarro);

            // Verificar se a consulta foi bem-sucedida
            if ($resultado && pg_num_rows($resultado) > 0) {
                $carro = pg_fetch_assoc($resultado);

                // Exibir as informações do carro
                echo "
                        <section class='thirdPage'>
                            <div class='thirdPageFC'> 
                                <h1 class='tituloGeral tituloTP'>" . htmlspecialchars($carro['modelo']) . "</h1>
                                <div class='detalhesCarro'>
                                    <img class='imagem' src='" . htmlspecialchars($carro['img']) . "' alt='" . htmlspecialchars($carro['modelo']) . "'>
                                        
                                    <div class='specificationCont'>
                                        <h1 class='tituloGeral nomeCarro'>Specifications</h1>
                                        <ul class='tituloGeral topicos'>
                                            <li>
                                                <span class='textoGeral specific'>Registration Plate: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($carro['matricula']) . "</span>
                                            </li>
                                            <li>
                                                <span class='textoGeral specific'>Number of Seats: </span>
                                                <span class='textoGeral'> " . htmlspecialchars($carro['nmr_lugares']) . "</span>
                                            </li>
                                            <li>
                                                <span class='textoGeral specific'>Color: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($carro['cor']) . "</span>
                                            </li>
                                            <li>
                                                <span class='textoGeral specific'>Year: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($carro['ano']) . "</span>
                                            </li>
                                            <li>
                                                <span class='textoGeral specific'>Cost per Day: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($carro['custo_max_dia']) . "€</span>
                                            </li>
                                        </ul>                        
                                    </div>
                                </div>
                            </section>
                            <section class='thirdPage'>
                                <div class='thirdPageSC' id='second'>
                                    <h1 class='tituloGeral titutloTP'>Reservations</h1>";

                // Reinicializar o resultado para percorrer as reservas
                pg_result_seek($resultado, 0);

                echo "<ul class='topicos'>
                        <li>
                            <span class='textoGeral specific'>Number of reservations: </span>
                            <span class='textoGeral'>" . htmlspecialchars($carro['total_reservas']) . "</span>
                        </li>
                        <br>
                        <hr>
                        <br>
                        ";
                while ($reserva = pg_fetch_assoc($resultado)) {
                echo "
                        <li>
                            <span class='textoGeral specific'>Client: </span>
                            <span class='textoGeral'>" . htmlspecialchars($reserva['cliente_pessoa_nome']) . "</span>
                        </li>
                        <li>
                            <span class='textoGeral specific'>Start Date: </span>
                            <span class='textoGeral'>" . htmlspecialchars($reserva['data_inicio']) . "</span>
                        </li>
                        <li>
                            <span class='textoGeral specific'>End Date: </span>
                            <span class='textoGeral'>" . htmlspecialchars($reserva['data_fim']) . "</span>
                        </li>
                        <br>
                        <hr>
                        <br>
                    ";
                }
                echo "</ul></div></section>";
            } else {
                echo "<p class='textoGeral erro erroCar'>Car not found or no reservations available</p>";
            }
        } else {
            echo "<p class='textoGeral erro erroCar'>No car selected</p>";
        }
        ?>


    </main>
    <script src="/JS/car.js"></script>
    <script src="/JS/header.js"></script>
</body>

</html>