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
                    echo "<p>Por favor, faça login.</p>";
                }
                ?>
                <img class="icones" id="perfil" src="/IMAGENS/pictogramaPerfil.png" alt="perfil">
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

        <section class="secondPage">
            <div class="secondPageContainer">

                <!--titleSP - tituloSecondPage-->
                <h2 class="tituloGeral title" id="titleSP">Models</h2>

                <h5 class="tituloGeral subtitle">Search your dream car</h5>
                <div class="searchBar">

                    <form class="searchForm" method="GET" action="products.php">

                        <!-- Filtro para ordenar -->
                        <select class="filter" name="sort" id="sort">
                            <option value="">Sort by</option>
                            <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Price (Low to High)</option>
                            <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Price (High to Low)</option>
                            <option value="model_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'model_asc') ? 'selected' : '' ?>>Model (A-Z)</option>
                            <option value="model_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'model_desc') ? 'selected' : '' ?>>Model (Z-A)</option>
                        </select>

                        <input class="filter" type="search" name="search" placeholder="Search by model...." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

                        <!-- Filtro relativo ao número de lugares -->
                        <select class="filter" name="nmr_lugares" id="nmr_lugares">
                            <option value="">Number of Seats</option>
                            <option value="2" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '2') ? 'selected' : '' ?>>2</option>
                            <option value="4" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '4') ? 'selected' : '' ?>>4</option>
                            <option value="5" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '5') ? 'selected' : '' ?>>5</option>
                        </select>

                        <!-- Filtro relativo ao custo máximo diário -->
                        <input class="filter" type="number" name="custo_max_dia" id="custo_max_dia" placeholder="Max Cost...." value="<?= htmlspecialchars($_GET['custo_max_dia'] ?? '') ?>">

                        <!-- Botão de pesquisa -->
                        <button type="submit" class="searchBtn">
                            <img class="lupa" src="/IMAGENS/pictogramaLupa.png" width="15" height="15" alt="Search">
                        </button>

                    </form>

                </div>


                <div class="gallery" id="gallery">
                    <?php
                    // Conexão à base de dados
                    require('../baseDados.php');

                    // Capturar os parâmetros da pesquisa e filtros
                    $search = pg_escape_string($connection, $_GET['search'] ?? '');
                    $nmr_lugares = pg_escape_string($connection, $_GET['nmr_lugares'] ?? '');
                    $custo_max_dia = pg_escape_string($connection, $_GET['custo_max_dia'] ?? '');
                    $sort = $_GET['sort'] ?? '';

                    // Base da query
                    $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img FROM carro WHERE 1=1";

                    // Filtro por pesquisa (modelo)
                    if (!empty($search)) {
                        $query .= " AND LOWER(modelo) LIKE LOWER('%$search%')";
                    }

                    // Filtro por número de lugares
                    if (!empty($nmr_lugares)) {
                        $query .= " AND nmr_lugares = $nmr_lugares";
                    }

                    // Filtro por custo máximo por dia
                    if (!empty($custo_max_dia)) {
                        $query .= " AND custo_max_dia <= $custo_max_dia";
                    }

                    // Ordenação
                    switch ($sort) {
                        case 'price_asc':
                            $query .= " ORDER BY custo_max_dia ASC";
                            break;
                        case 'price_desc':
                            $query .= " ORDER BY custo_max_dia DESC";
                            break;
                        case 'model_asc':
                            $query .= " ORDER BY modelo ASC";
                            break;
                        case 'model_desc':
                            $query .= " ORDER BY modelo DESC";
                            break;
                        default:
                            $query .= " ORDER BY modelo ASC"; // Ordenação padrão
                    }


                    // Executar a consulta
                    $resultados = pg_query($connection, $query);

                    // Verificar se a consulta foi bem-sucedida
                    if (!$resultados) {
                        echo "Erro ao procurar os dados dos carros: " . pg_last_error($connection);
                        exit();
                    }

                    // Criar "cartão" 
                    // Loop para processar cada linha
                    while ($carro = pg_fetch_assoc($resultados)) {
                        echo "
                        
                            <div class='carro'>
                                <div class='legenda' id='legendaP'>
                                    <h3 class='tituloGeral legend'>" . htmlspecialchars($carro['modelo']) . "</h3>
                                </div>
                                <img class='imgCarro' id='imgGallery' src='" . htmlspecialchars($carro['img']) . "' alt='carro1'>
                                <div class='element'>
                                    <a href='car.php?matricula=" . urlencode($carro['matricula']) . "'>
                                        <button class='tituloGeral botaoGeral verMaisBtn'>Ver Mais</button>
                                    </a>
                                </div>
                            </div>
                        ";
                    } //se carregar no botao sou remetida para a página car com as especificações de cada carro

                    // Encerra a conexão com a base de dados
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
    <script src="/JS/header.js"></script>
</body>

</html>