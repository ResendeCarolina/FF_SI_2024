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

    <main class="mainContainer">
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


        <h2 class="tituloGeral title">Adicionar Novo Carro</h2>

        <form method="POST" class="formAdicionarCarro">
            <label for="matricula" class="textoGeral">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" class="inputGeral" maxlength="20" required>

            <label for="modelo" class="textoGeral">Modelo:</label>
            <input type="text" id="modelo" name="modelo" class="inputGeral" required>

            <label for="nmr_lugares" class="textoGeral">Número de Lugares:</label>
            <input type="number" id="nmr_lugares" name="nmr_lugares" class="inputGeral" required>

            <label for="cor" class="textoGeral">Cor:</label>
            <input type="text" id="cor" name="cor" class="inputGeral" required>

            <label for="ano" class="textoGeral">Ano:</label>
            <input type="date" id="ano" name="ano" class="inputGeral" required>

            <label for="custo_max_dia" class="textoGeral">Custo Máximo por Dia (€):</label>
            <input type="number" id="custo_max_dia" name="custo_max_dia" class="inputGeral" step="0.01" required>

            <label for="administrador_pessoa_nome" class="textoGeral">Administrador Responsável:</label>
            <input type="text" id="administrador_pessoa_nome" name="administrador_pessoa_nome" class="inputGeral" required>

            <label for="imagem" class="textoGeral">URL da Imagem:</label>
            <input type="url" id="imagem" name="imagem" class="inputGeral" required>
            <br>

            <button type="submit" class="botaoAddCar">Adicionar Carro</button>
        </form>
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
    <script src="/JS/header.js"></script>
</body>

</html>