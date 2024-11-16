<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../CSS/main.css">
</head>

<body>
    <main>

        <?php
        // conexão à bd
        require('baseDados.php');

        // PHP para submeter os dados para a bd
        if (isset($_REQUEST['nome'], $_REQUEST['mail'], $_REQUEST['pwd'], $_REQUEST['cc'], $_REQUEST['birth'])) {
            $username = $_REQUEST['nome'];
            $email = $_REQUEST['mail'];
            $password = $_REQUEST['pwd'];
            $identification = $_REQUEST['cc'];
            $birthday = $_REQUEST['birth'];

            // QUERY para guardar na bd 
            $query = "INSERT into pessoa (nome, cc, data_nasc, email, password) VALUES ('$username','$identification','$birthday','$email','$password')";

            // Enviar a QUERY
            $resultados = pg_query($connection, $query);

        
            // Redirecionar se o registro foi bem-sucedido
            if ($resultados) {
                header("Location: http://localhost:3000/PHP/login.php");
                exit(); // Encerrar o script após o redirecionamento
            } else {
                echo "<div class='form'>
                <h3>Erro ao registrar. Tente novamente.</h3><br/>
                <p class='link'>Clique aqui para <a href='registration.php'>registrar-se</a> novamente.</p>
              </div>";
            
            
        } else {

        ?>

            <div class="wrapper">
                <div class="imgSignUp">
                    <img id="imgSU" src="/IMAGENS/carro.jpg" alt="imagem_signUp">
                </div>
                <div class="outContainer">
                    <div class="container">
                        <h2 id="titulo">Sign Up</h2>
                        <div class="register_form">
                            <form id="registationForm">
                                <div>
                                    <label for="nome">Name</label>
                                    <input type="text" id="nome" name="nome" placeholder="Name" required>
                                </div>
                                <div>
                                    <label for="mail">Email</label>
                                    <input type="email" id="mail" name="mail" placeholder="fastfurious@gmail.com" required>
                                </div>
                                <div>
                                    <label for="pwd">Password</label>
                                    <input type="password" id="pwd" name="pwd" placeholder=". . . . . . . . . ." required>
                                </div>

                                <div>
                                    <div>
                                        <label for="birth">Birthday</label>
                                        <input type="date" name="birth" id="birth">
                                    </div>
                                    <div>
                                        <label for="cc">Id</label>
                                        <input type="number" name="cc" id="cc">
                                    </div>
                                </div>


                                <div class="checkbox">
                                    <input type="checkbox" id="is_admin" name="is_admin" value="1">
                                    <label for="is_admin">Aministrator</label>
                                </div>

                                <a class="link" href="login.php">I already have an Account.</a>

                                <div>
                                    <button id="botao" type="submit">SUBMIT</button>
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