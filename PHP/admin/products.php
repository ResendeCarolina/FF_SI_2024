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
                <img class="logo" id="logo" src="/IMAGENS/LogoBranco.png" alt="logotipo">
            </a>
        </div>

        <div class="menuContainer">
            <nav class="menu">
                <a class="tituloGeral sobreEfeito" id="secao1" href="homepage.php#thirdSection">STATISTICS</a>
                <a class="tituloGeral sobreEfeito" id="secao2" href="products.php">PRODUCTS</a>
                <a class="tituloGeral sobreEfeito" id="secao3" href="#fourthSection">CONTACTS</a>
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
        <section class="secondPage">
            <div class="secondPageContainer">

                <h5 class="textoGeral subtitle">Search product</h5>
                <div class="searchBar">

                    <form class="searchForm searchFA" method="GET" action="products.php">

                        <!-- filtro para ordenar -->
                        <select class="filter" name="sort" id="sort">
                            <option value="">Sort by</option>
                            <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Price (Low to High)</option>
                            <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Price (High to Low)</option>
                            <option value="model_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'model_asc') ? 'selected' : '' ?>>Model (A-Z)</option>
                            <option value="model_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'model_desc') ? 'selected' : '' ?>>Model (Z-A)</option>
                        </select>

                        <!-- filtro para pesquisar o modelo -->
                        <input class="filter" type="search" name="search" placeholder="Search by model...." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

                        <!-- filtro para pesquisar o número de lugares -->
                        <select class="filter" name="nmr_lugares" id="nmr_lugares">
                            <option value="">Number of Seats</option>
                            <option value="2" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '2') ? 'selected' : '' ?>>2</option>
                            <option value="4" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '4') ? 'selected' : '' ?>>4</option>
                            <option value="5" <?= (isset($_GET['nmr_lugares']) && $_GET['nmr_lugares'] == '5') ? 'selected' : '' ?>>5</option>
                        </select>

                        <!-- filtro para custo máximo -->
                        <input class="filter" type="number" name="custo_max_dia" id="custo_max_dia" placeholder="Max Cost...." value="<?= htmlspecialchars($_GET['custo_max_dia'] ?? '') ?>">

                        <!-- botão de submeter -->
                        <button type="submit" class="searchBtn">
                            <img class="lupa" src="/IMAGENS/pictogramaLupa.png" width="15" height="15" alt="Search">
                        </button>

                    </form>
                </div>

                <div>
                    <a href="addproduct.php">
                        <button class="tituloGeral botaoGeral adicionar">ADD PRODUCT</button>
                    </a>
                </div>


                <div class="gallery" id="gallery">

                    <?php


                    require('../comuns/baseDados.php');

                    //guarda os valores das variáveis selecionadas nos filtros 
                    $search = pg_escape_string($connection, $_GET['search'] ?? '');
                    $nmr_lugares = pg_escape_string($connection, $_GET['nmr_lugares'] ?? '');
                    $custo_max_dia = pg_escape_string($connection, $_GET['custo_max_dia'] ?? '');
                    $sort = $_GET['sort'] ?? '';

                    $query = "SELECT matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, img, oculto
                    FROM carro
                    WHERE 1=1"; //seleciona todos os resultados da tabela carro

                    //filtro por pesquisa (modelo)
                    if (!empty($search)) {
                        $query .= " AND LOWER(modelo) LIKE LOWER('%$search%')";
                    }

                    //filtro por número de lugares
                    if (!empty($nmr_lugares)) {
                        $query .= " AND nmr_lugares = $nmr_lugares";
                    }

                    //filtro por custo máximo por dia
                    if (!empty($custo_max_dia)) {
                        $query .= " AND custo_max_dia <= $custo_max_dia";
                    }

                    //filtro por ordenação
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


                    //executa a consulta
                    $resultados = pg_query($connection, $query);

                    //verifica se a consulta foi bem sucedida
                    if (!$resultados) {
                        echo "Erro ao procurar os dados dos carros: " . pg_last_error($connection);
                        exit();
                    }

                    //cria um loop que cria o número de "cartões" com o número de produtos da base de dados
                    while ($carro = pg_fetch_assoc($resultados)) {
                        //verifica se o valor de 'oculto' é 't' (true) ou 'f' (false)

                        //se oculto = t => desenhado; se oculto = f => não é desenhado;
                        $oculto = ($carro['oculto'] === 't'); // Converte para booleano em PHP
                        echo "
                            <div class='carro'>
                                <div class='legenda' id='legendaP'>
                                    <h3 class='tituloGeral legend'>" . htmlspecialchars($carro['modelo']) . "</h3>
                                </div>
                                <img class='imgCarro' id='imgGallery' src='" . htmlspecialchars($carro['img']) . "' alt='carro1'>
                                <div class='element elementAdmin'>
                                    <a href='car.php?matricula=" . urlencode($carro['matricula']) . "'>
                                        <button class='tituloGeral botaoGeral verMaisBtn'>MORE</button>
                                    </a>
                                    <form method='POST'>
                                        <input type='hidden' name='matricula' value='" . htmlspecialchars($carro['matricula']) . "'>
                                        <div class='olhoBtn'>
                                            <img class='olho' src='/IMAGENS/" . ($oculto ? 'olhoVisivel.png' : 'olhoOculto.png') . "' alt='Visibilidade'>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                        ";
                    }  //se carregar no botao sou remetida (através da matrícula)
                    //para a página car com as especificações de cada carro

                    pg_close($connection);
                    ?>
                </div>

            </div>
        </section>
    </main>
    <footer class=" textoGeral fourthSection" id="fourthSection">
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