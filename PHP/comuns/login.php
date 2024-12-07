<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/CSS/main.css">
</head>

<body>
    <main>

        <?php

        // Conexão à base de dados
        require('../comuns/baseDados.php');

        // PHP para submeter os dados para a base de dados
        if (isset($_REQUEST['mail'], $_REQUEST['pwd'])) {
            $email = $_REQUEST['mail'];  // String fornecida pelo utilizador
            $password = $_REQUEST['pwd'];  // Senha fornecida pelo utilizador

            // Escape o email e a senha para garantir que estão corretos e seguros
            $escaped_email = pg_escape_string($connection, $email);
            $escaped_password = pg_escape_string($connection, $password);

            // Query para verificar o login na tabela pessoa
            $query = "SELECT nome FROM pessoa WHERE email = '$escaped_email' AND password = '$escaped_password'";

            // Executa a query
            $resultados = pg_query($connection, $query);

            // Verifica se a consulta foi bem-sucedida e se encontrou resultados
            if ($resultados && pg_num_rows($resultados) > 0) {
                session_start();
                $utilizador = pg_fetch_assoc($resultados);

                // Armazena o nome e email do utilizador na sessão
                $_SESSION['nome'] = $utilizador['nome'];
                $_SESSION['user'] = $email;

                // Verifica se o utilizador é administrador
                $queryRole = "SELECT * FROM administrador WHERE pessoa_nome = '" . pg_escape_string($connection, $utilizador['nome']) . "'";
                $resultRole = pg_query($connection, $queryRole);

                if (pg_num_rows($resultRole) > 0) {
                    // Redireciona para a página do administrador
                    header('Location: /PHP/admin/homepage.php');
                } else {
                    // Redireciona para a página do cliente
                    header('Location: /PHP/cliente/homepage.php');
                }
                exit();
            } else {
                echo "<h1>Email ou senha inválidos</h1>";
            }
        } else {

        ?>

            <div class="wrapper">
                <div class="imgSignUp">
                    <img id="imgSU" src="/IMAGENS/carro.jpg" alt="imagem_signUp">
                </div>
                <div class="outContainer">
                    <div class="container">
                        <h2 class="tituloGeral" id="titulo">LOGIN</h2>
                        <div class="login_form">
                            <form class="textoGeral" id="registationForm">
                                <div>
                                    <label for="mail">Email</label>
                                    <input type="email" id="mail" name="mail" placeholder="fastfurious@gmail.com" required>
                                </div>
                                <div>
                                    <label for="pwd">Password</label>
                                    <input type="password" id="pwd" name="pwd" placeholder=". . . . . . . . . ." required>
                                </div>
                                <div>
                                    <button class="botao" id="botaoLogin" type="submit">SUBMIT</button>
                                </div>
                                <div>
                                    <div class="linkContainer">
                                        <a class="sobreEfeito link" href="register.php">Don't have an account yet? Sign up</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }

        ?>

    </main>

    <script src="../JS/script.js"></script>
</body>

</html>