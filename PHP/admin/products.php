<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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

                // Verificar se o utilizador está logado
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
        <section class="secondPage">
            <div class="secondPageContainer">

                <div class="inicialContainer">
                    <!--titleSP - tituloSecondPage-->
                    <h2 class="tituloGeral title" id="titleSP">Models</h2>
                    <div class="searchBar">
                        <div class="search">
                            <form class="searchForm" method="GET" action="products.php">
                                <input class="searchInput" type="search" name="search" placeholder="Search by model" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

                                <!-- Filtro por número de lugares -->
                                <label for="nmr_lugares">Seats:</label>
                                <select name="nmr_lugares" id="nmr_lugares">
                                    <option value="">Any</option>
                                    <option value="2" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '2') ? 'selected' : '' ?>>2</option>
                                    <option value="4" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '4') ? 'selected' : '' ?>>4</option>
                                    <option value="5" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '5') ? 'selected' : '' ?>>5</option>
                                </select>

                                <!-- Filtro por custo máximo -->
                                <label for="custo_max_dia">Max Cost:</label>
                                <input type="number" name="custo_max_dia" id="custo_max_dia" placeholder="Cost per day" value="<?= htmlspecialchars($_GET['custo_max_dia'] ?? '') ?>">

                                <!-- Ordenação -->
                                <label for="sort">Sort by:</label>
                                <select name="sort" id="sort">
                                    <option value="">Default</option>
                                    <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Price (Low to High)</option>
                                    <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Price (High to Low)</option>
                                    <option value="model_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'model_asc') ? 'selected' : '' ?>>Model (A-Z)</option>
                                    <option value="model_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'model_desc') ? 'selected' : '' ?>>Model (Z-A)</option>
                                </select>

                                <!-- Botão de pesquisa -->
                                <button type="submit" class="searchBtn">
                                    <img class="lupa" src="/IMAGENS/pictogramaLupa.png" width="15" height="15" alt="Search">
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="gallery" id="gallery">
                    <?php
                    // conexão à base de dados
                    require('../baseDados.php');

                    // Consulta SQL para buscar todos os carros
                    $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img FROM carro";

                    // Executar a consulta
                    $resultados = pg_query($connection, $query);

                    // Verificar se a consulta foi bem-sucedida
                    if (!$resultados) {
                        echo "Erro ao buscar os dados dos carros: " . pg_last_error($connection);
                        exit();
                    }

                    // Criar cartão
                    // Loop para processar cada linha
                    while ($carro = pg_fetch_assoc($resultados)) {
                        echo "
                        
                            <div class='carro'>
                                <div class='legenda' id='legendaP'>
                                    <h3 class='tituloGeral legend'>" . htmlspecialchars($carro['modelo']) . "</h3>
                                </div>
                                <img class='imgCarro' id='imgGallery' src='" . htmlspecialchars($carro['img']) . "' alt='carro1'>
                                <div class='element'>
                                    <div class='wrapbutton'>
                                        <div class='dateContainer'>
                                            <a href='car.php?matricula=" . urlencode($carro['matricula']) . "'>
                                                <button class='tituloGeral date verMaisBtn'>Ver Mais</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         ";
                    }

                    // Fechar a conexão com a base de dados
                    pg_close($connection);
                    ?>
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
    <script src="/JS/products.js"></script>
</body>

</html>