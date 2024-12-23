<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
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

        <section class="profilePage">
            <div class="profilePageContainer">

                <?php

                require('../comuns/baseDados.php');

                //se o login tiver sido feito
                if (isset($_SESSION['nome'])) {

                    //consulta as tabelas pessoa e cliente e vai buscar todos os dados sobre o cliente
                    $nome = pg_escape_string($connection, $_SESSION['nome']);
                    $query = "SELECT pessoa.nome, pessoa.cc, pessoa.data_nasc, pessoa.email, pessoa.password, cliente.saldo 
                             FROM pessoa, cliente 
                             WHERE pessoa.nome = cliente.pessoa_nome 
                             AND pessoa.nome = '$nome'";

                    $resultados = pg_query($connection, $query);

                    if ($resultados && pg_num_rows($resultados) > 0) {
                        $utilizador = pg_fetch_assoc($resultados);

                        //são exibidos os dados do cliente 
                        echo "
                            <h2 class='tituloGeral title'>Hi, " . htmlspecialchars($utilizador['nome']) . "!</h2>
                            <div class='dados'>
                                <ul class='tituloGeral topicos'>
                                    <h3 class='tituloGeral data'>Data</h3>
                                    <li>
                                        <span class='textoGeral specific'>Name: </span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['nome']) . "</span>
                                    </li>
                                    <li>
                                        <span class='textoGeral specific'>Identification: </span>
                                        <span class='textoGeral'> " . htmlspecialchars($utilizador['cc']) . "</span>
                                    </li>
                                    <li>
                                        <span class='textoGeral specific'>Date of Birth: </span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['data_nasc']) . "</span>
                                    </li>
                                    <li>
                                        <span class='textoGeral specific'>Email: </span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['email']) . "</span>
                                    </li>
                                    <h3 class='tituloGeral balance'>Account Balance</h3>
                                    <li>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['saldo']) . "€</span>
                                    </li>
                                    <h3 class='tituloGeral balance'>Reservation History</h3>";

                        //consulta as tabelas reserva e carro
                        $queryReservas = "SELECT reserva.data_inicio, reserva.data_fim, carro.modelo, carro.matricula
                                          FROM reserva, carro
                                          WHERE reserva.carro_matricula = carro.matricula 
                                          AND reserva.cliente_pessoa_nome = '$nome'
                                          ORDER BY reserva.data_inicio DESC";

                        $resultadosReservas = pg_query($connection, $queryReservas);

                        //se o utilizador tiver feito alguma reserva
                        if ($resultadosReservas && pg_num_rows($resultadosReservas) > 0) {
                            echo "<ul class='tituloGeral histReserv'>";

                            //para o número de reservas que ele tiver feito é exibido o modelo, a matrícula e as datas de reserva dos carros
                            while ($reserva = pg_fetch_assoc($resultadosReservas)) {
                                echo "
                                            <li>
                                                <span class='textoGeral specific'>Car Model: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($reserva['modelo']) . "</span>
                                            </li>
                                            <li>
                                                <span class='textoGeral specific'>Registation Plate: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($reserva['matricula']) . "</span>
                                            </li>
                                            <li>
                                                <span class='textoGeral specific'>Start Date: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($reserva['data_inicio']) . "</span>
                                            </li>
                                            <li  class='ultimo'>
                                                <span class='textoGeral specific'>End Date: </span>
                                                <span class='textoGeral'>" . htmlspecialchars($reserva['data_fim']) . "</span>
                                            </li>
                                            <hr>
                                            <br>
                                        ";
                            }
                            echo "</ul>";
                        } else {
                            //se não tiver reservas feitas
                            echo "<p class='textoGeral'>No reservations found.</p>";
                        }

                        echo "
                                </ul>
                            </div>
                        ";
                    } else {
                        echo "<h2 class='textoGeral erro'>Profile not found. Please log in</h2>";
                    }
                } else {
                    echo "<p class='textoGeral erro'>Profile not found. Please log in</p>";
                }
                ?>

            </div>
        </section>
    </main>
    <script src="/JS/header.js"></script>
    <script src="/JS/cartBar.js"></script>
</body>

</html>