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

        //conexão à base de dados
        require('../comuns/baseDados.php');

        //verifica se todos os campos de preenchimento obrigatório foram preenchidos
        if (isset($_REQUEST['mail'], $_REQUEST['pwd'])) {
            $email = $_REQUEST['mail'];
            $password = $_REQUEST['pwd'];

            $escaped_email = pg_escape_string($connection, $email);
            $escaped_password = pg_escape_string($connection, $password);

            //verifica se na tabela pessoa já existe alguém com esta conta
            $query = "SELECT nome FROM pessoa WHERE email = '$escaped_email' AND password = '$escaped_password'";
            $resultados = pg_query($connection, $query);

            //se existir
            if ($resultados && pg_num_rows($resultados) > 0) {

                //inicia sessão
                session_start();
                $utilizador = pg_fetch_assoc($resultados);

                //o nome e o email do utilizador são guardados
                $_SESSION['nome'] = $utilizador['nome'];
                $_SESSION['user'] = $email;

                //se for administrador
                $queryRole = "SELECT * FROM administrador WHERE pessoa_nome = '" . pg_escape_string($connection, $utilizador['nome']) . "'";
                $resultRole = pg_query($connection, $queryRole);

                if (pg_num_rows($resultRole) > 0) {
                    //redireciona para a página do administrador
                    header('Location: /PHP/admin/homepage.php');
                } else {
                    //redireciona para a página do cliente
                    header('Location: /PHP/cliente/homepage.php');
                }
                exit();
            } else { //se os dados não estiverem de acordo com os da base de dados
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
</body>

</html>