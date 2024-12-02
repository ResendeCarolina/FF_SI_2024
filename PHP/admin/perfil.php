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
                ?>
                <a href="perfil.php">
                    <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
                </a>
            </div>
            <div class="cartContainer">
                <img class="icones" id="cart" src="/IMAGENS/pictogramaCart.png" alt="cart">
                <!-- TODO: Adicionar a informação dos carros ao carrinho -->
                <span class="countP" id="countP">0</span>
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

        <section class="profilePage">
            <div class="profilePageContainer">

                <?php
                // Conexão à base de dados
                require('../baseDados.php');

                session_start();

                // Verificar se o utilizador está logado
                if (isset($_SESSION['nome'])) {

                    $nome = $_SESSION['nome'];
                    $query = "SELECT pessoa.nome, pessoa.cc, pessoa.data_nasc, pessoa.email, pessoa.password, cliente.saldo 
                            FROM pessoa, cliente 
                            WHERE pessoa.nome = cliente.pessoa_nome 
                            AND pessoa.nome = '$nome'";

                    // Executa a query
                    $resultados = pg_query($connection, $query);

                    if ($resultados && pg_num_rows($resultados) > 0) {

                        $utilizador = pg_fetch_assoc($resultados);

                        echo "
                            <h2 class='tituloGeral title'>Hi, " . htmlspecialchars($utilizador['nome']) . "!</h2>
                            <div class='dados'>
                                <ul class='tituloGeral topicos'>
                                    <h3 class='tituloGeral data'>Data</h3>
                                    <li>
                                        <span class='tituloGeral'>Name -</span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['nome']) . "</span>
                                    </li>
                                    <li>
                                        <span class='tituloGeral'>Identification -</span>
                                        <span class='textoGeral'> " . htmlspecialchars($utilizador['cc']) . "</span>
                                    </li>
                                    <li>
                                        <span class='tituloGeral'>Date of Birth -</span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['data_nasc']) . "</span>
                                    </li>
                                    <li>
                                        <span class='tituloGeral'>Email -</span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['email']) . "</span>
                                    </li>
                                    <li>
                                        <span class='tituloGeral'>Password -</span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['password']) . "</span>
                                    </li>
                                    <h3 class='tituloGeral balance'>AccountBalance</h3>
                                    <li>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['saldo']) . "€</span>
                                    </li>
                                    <h3 class='tituloGeral balance'>Reservation History</h3>
                                    <li>
                                        <span class='textoGeral'></span>
                                    </li>
                                </ul>

                            </div>
                        ";
                    } else {
                        echo "<h2 class='tituloGeral title'>Profile not found. Please log in</h2>";
                    }
                }
                ?>
            </div>
        </section>

    </main>

    <script src="/JS/header.js"></script>
</body>

</html>