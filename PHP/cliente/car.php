<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car</title>
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
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
        <div class="cartBar" id="cartBar">
            <h1 class="tituloGeral titleSC">Reservations List</h1>
            <div class="listCart">

                <?php

                require('../comuns/baseDados.php');

                //se a sessão foi iniciada (fez login)
                if (isset($_SESSION['nome'])) {

                    //consulta as tabelas reserva e carro e seleciona as reservas que o cliente fez
                    $queryReservas = "SELECT reserva.data_inicio, reserva.data_fim, reserva.carro_matricula, carro.modelo, carro.img
                                      FROM reserva, carro
                                      WHERE reserva.carro_matricula = carro.matricula 
                                      AND reserva.cliente_pessoa_nome = '$nome'
                                      ORDER BY reserva.data_inicio DESC"; //as datas mais recentes aparecem primeiro

                    $resultadosReservas = pg_query($connection, $queryReservas);


                    //se houver resultados
                    if ($resultadosReservas && pg_num_rows($resultadosReservas) > 0) {
                        echo "<ul class='tituloGeral'>";
                        while ($reserva = pg_fetch_assoc($resultadosReservas)) {
                            //vai ser desenhada na aba lateral todas as reservas do cliente com a imagem, 
                            //matrícula, modelo e datas de reserva do carro
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
                        //se não houver resultados, não há reservas
                        echo "<p class='textoGeral'>No reservations found</p>";
                    }
                } else {
                    echo "<p class='textoGeral'>No reservations found</p>";
                }

                ?>
            </div>
        </div>

        <?php

        //verifica se o atributo "matricula" foi enviado
        if (isset($_GET['matricula'])) { //se foi enviado
            $matricula = pg_escape_string($connection, $_GET['matricula']);

            //consulta a tabela carro
            $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img 
                      FROM carro 
                      WHERE matricula = '$matricula'";
            $resultado = pg_query($connection, $query);

            //verificar se a consulta foi bem-sucedida
            if ($resultado && pg_num_rows($resultado) > 0) {
                $carro = pg_fetch_assoc($resultado);

                //consoante a PK do carro (matrícula), vamos buscar todas as suas especificações
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
                                        <form class='formCar' id='carForm' method='POST'>
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
                        </section>
                        ";
            } else {
                echo "<p class='textoGeral erro erroCar'>Car not found</p>";
            }
        } else {
            echo "<p class='textoGeral erro erroCar'>Not found</p>";
        }

        pg_close($connection);
        ?>

        </section>
    </main>
    <script src="/JS/car.js"></script>
    <script src="/JS/header.js"></script>
    <script src="/JS/cartBar.js"></script>
</body>

</html>