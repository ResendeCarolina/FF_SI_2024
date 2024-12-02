<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
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
                <a href="perfil.php">
                    <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
                </a>
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

        <section class="perfilPage">
            <div class="perfilPageContainer">

                <h2 class="tituloGeral title" id="titlePerfil">Hi</h2>
            </div>
        </section>

    </main>

    <script src="/JS/header.js"></script>
</body>

</html>