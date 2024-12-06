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
                    <div class=" itemModelo">

                    </div>
                </div>
            </div>
        </div>

        <section class="profilePage">
            <div class="profilePageContainer">

                <?php
                // Conexão à base de dados
                require('../comuns/baseDados.php');

                // Verificar se o utilizador está logado
                if (isset($_SESSION['nome'])) {

                    $nome = $_SESSION['nome'];
                    $query = "SELECT pessoa.nome, pessoa.cc, pessoa.data_nasc, pessoa.email, pessoa.password
                            FROM pessoa
                            WHERE pessoa.nome = '$nome'";

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
                                    <li>
                                        <span class='textoGeral specific'>Password: </span>
                                        <span class='textoGeral'>" . htmlspecialchars($utilizador['password']) . "</span>
                                    </li>
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
</body>

</html>