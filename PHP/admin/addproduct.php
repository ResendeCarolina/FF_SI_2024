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
        require('../comuns/baseDados.php'); // Conexão com a base de dados

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Receber os dados do formulário
            $matricula = $_POST['matricula'];
            $modelo = $_POST['modelo'];
            $nmr_lugares = $_POST['nmr_lugares'];
            $cor = $_POST['cor'];
            $ano = $_POST['ano'];
            $custo_max_dia = $_POST['custo_max_dia'];
            $administrador_pessoa_nome = $_POST['administrador_pessoa_nome'];
            $imagem = $_POST['imagem']; // URL da imagem

            // Validação básica
            if (empty($matricula) || empty($modelo) || empty($nmr_lugares) || empty($cor) || empty($ano) || empty($custo_max_dia) || empty($administrador_pessoa_nome) || empty($imagem)) {
                die("Todos os campos são obrigatórios.");
            }

            // Query de inserção
            $query = "INSERT INTO carro (matricula, modelo, nmr_lugares, cor, ano, custo_max_dia, administrador_pessoa_nome, img)
                      VALUES ('$matricula', '$modelo', $nmr_lugares, '$cor', '$ano', $custo_max_dia, '$administrador_pessoa_nome', '$imagem')";

            // Executar a query
            $result = pg_query($connection, $query);

            if ($result) {
                echo "Carro adicionado com sucesso!";
                header("Location: products.php"); // Redirecionar para a página de produtos
                exit();
            } else {
                echo "Erro ao adicionar carro: " . pg_last_error($connection);
            }
        }
        ?>

        <section class="addCarPage">
            <div class="addCarPageContainer">

                <!--titleAC - titleAddStatistics-->
                <h2 class="tituloGeral title" id="titleAC">NEW PRODUCT</h2>

                <form method="POST" class="formAdicionarCarro">

                    <label for="matricula" class="textoGeral">Registration Plate</label>
                    <input type="text" id="matricula" name="matricula" class="textoGeral inputGeral" maxlength="20" placeholder="Insert registration plate">

                    <label for="modelo" class="textoGeral">Model</label>
                    <input type="text" id="modelo" name="modelo" class="textoGeral inputGeral" placeholder="Insert model" required>

                    <label for="nmr_lugares" class="textoGeral">Number of seats</label>
                    <input type="number" id="nmr_lugares" name="nmr_lugares" class="textoGeral inputGeral" placeholder="Insert number of seats" required>

                    <label for="cor" class="textoGeral">Color</label>
                    <input type="text" id="cor" name="cor" class="textoGeral inputGeral" placeholder="Insert color" required>

                    <label for="ano" class="textoGeral">Year</label>
                    <input type="date" id="ano" name="ano" class="inputGeral" placeholder="Insert year" required>

                    <label for="custo_max_dia" class="textoGeral">Maxim cost per day (€)</label>
                    <input type="number" id="custo_max_dia" name="custo_max_dia" class="textoGeral inputGeral" step="0.01" placeholder="Insert value" required>

                    <label for="administrador_pessoa_nome" class="textoGeral">Responsable administrator</label>
                    <input type="text" id="administrador_pessoa_nome" name="administrador_pessoa_nome" class="textoGeral inputGeral" placeholder="Insert name" required>

                    <label for="imagem" class="textoGeral">Image URL</label>
                    <input type="url" id="imagem" name="imagem" class="textoGeral inputGeral" placeholder="Insert link" required>

                    <button class="tituloGeral botaoGeral botaoGeral addBtn" type="submit" class="tituloGeral botaoAddCar">ADD CAR</button>
                </form>
            </div>
        </section>
    </main>
    <script src="/JS/header.js"></script>
</body>

</html>