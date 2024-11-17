<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/main.css">
</head>

<body>
    <main>

        <?php
        
        // conexão à bd
        require('baseDados.php');

        // PHP para submeter os dados para a bd
        if (isset($_REQUEST['mail'], $_REQUEST['pwd'])) {
            $email = $_REQUEST['mail'];
            $password = $_REQUEST['pwd'];

            // QUERY para verificar os dados na tabela pessoa
            $query = "SELECT * FROM pessoa WHERE email = $email AND password = $password";

            // Prepara e executa a QUERY
            $resultados = pg_query_params($connection, $query, array($email, $password));

            // Verifica se encontrou algum resultado
            if (pg_num_rows($resultados) > 0) {
                // Login bem-sucedido
                session_start();
                $_SESSION['user'] = $email;

                echo "<div class='form'>
                <h3>Login efetuado com sucesso!</h3><br/>
                <p class='link'>Clique aqui para acessar a <a href='home.php'>Homepage</a></p>
              </div>";
            } else {
                // Login falhou
                echo "<div class='form'>
                <h3>Email ou senha incorretos.</h3><br/>
                <p class='link'>Clique aqui para <a href='login.php'>tentar novamente</a></p>
              </div>";
            }
        } else {

        ?>

            <div class="wrapper">
                <div class="imgSignUp">
                    <img id="imgSU" src="/IMAGENS/carro.jpg" alt="imagem_signUp">
                </div>
                <div class="outContainer">
                    <div class="container">
                        <h2 class="tituloGeral" id="titulo">Login</h2>
                        <div class="login_form">
                            <form  class="textoGeral" id="registationForm" action="/login.php">
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