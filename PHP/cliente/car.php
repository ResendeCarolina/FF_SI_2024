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
                    require('../baseDados.php');

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
                require('../baseDados.php');


                if (isset($_SESSION['nome'])) {
                    echo "
                <a href='../logout.php' class='btn-logout'>
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
                <?php
                // Conexão à base de dados
                require('../baseDados.php');

                // Query para buscar o histórico de reservas
                $queryReservas = "SELECT reserva.data_inicio, reserva.data_fim, reserva.carro_matricula, carro.modelo, carro.img
                                  FROM reserva, carro
                                  WHERE reserva.carro_matricula = carro.matricula 
                                  ORDER BY reserva.data_inicio DESC";

                $resultadosReservas = pg_query($connection, $queryReservas);

                if ($resultadosReservas && pg_num_rows($resultadosReservas) > 0) {
                    echo "<ul class='tituloGeral'>";
                    while ($reserva = pg_fetch_assoc($resultadosReservas)) {
                        // Lista de Reservas do utilizador
                        echo "
                            <li>
                                <div class='listaItem'>
                                    <div class='textoTitulo item itemModelo'>
                                        " . htmlspecialchars($reserva['modelo']) . "
                                    </div>
                                    <div class='cartaoZinho'>
                                        <div class='item itemImg'>
                                            <img class='imgAba' src='" . htmlspecialchars($reserva['img']) . "' alt='carro'>
                                        </div>     
                                        <div class='textoAba'>
                                            <div class='textoGeral item itemMatricula'>
                                                <p>RP: " . htmlspecialchars($reserva['carro_matricula']) . "</p>
                                            </div>
                                            <div class='textoGeral item itemInicio'>
                                                <p>SD: " . htmlspecialchars($reserva['data_inicio']) . "</p>
                                            </div>
                                            <div class='textoGeral item itemFim'>
                                                <p>ED: " . htmlspecialchars($reserva['data_fim']) . "</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <br>
                        ";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='textoGeral'>No reservations found.</p>";
                }
                ?>
            </div>
        </div>

        <section class="thirdPage">
            <?php

            // Verifica se o atributo "matricula" foi enviado
            if (isset($_GET['matricula'])) { //se foi enviado
                $matricula = pg_escape_string($connection, $_GET['matricula']);

                // Query para buscar os detalhes do carro
                $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img 
                FROM carro 
                WHERE matricula = '$matricula'";
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

                                        <form id='carForm' method='POST'>
                                            <input type='hidden' name='matricula' id='matricula' value='" . htmlspecialchars($carro['matricula']) . "'>
                                            <div class='buttonContainer'>
                                                <div>
                                                    <button class='tituloGeral botaoGeral btn date startBtn'>START</button>
                                                    <input class='dateInput startDate' type='date' id='startDate' name='startDate' required>
                                                </div>
                                                <div>
                                                    <button class='tituloGeral botaoGeral btn date endBtn'>END</button>
                                                    <input class='dateInput endDate' type='date' id='endDate' name='endDate' required>
                                                </div>
                                                <div>
                                                    <button type='submit' class='tituloGeral botaoGeral btn carBtn' id='carBtn'>BOOK</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ";
                } else {
                    echo "<p class='textoGeral erro erroCar'>Car not found</p>";
                }
            } else {
                echo "<p class='textoGeral erro erroCar'>Not found</p>";
            }

            // Fechar a conexão
            pg_close($connection);
            ?>

        </section>
    </main>
    <script src="/JS/car.js"></script>
    <script src="/JS/header.js"></script>
    <script src="/JS/calendar.js"></script>
</body>

</html>

<!--  <div id='calendarContainer'>
    <div id='calendarHeader'>
        <button id='prevMonth'>←</button>
        <span id='currentMonth'></span>
        <button id='nextMonth'>→</button>
    </div>
    <div id='calendarGrid'>
    </div>
</div>  -->