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
        // Conexão com a base de dados
        require 'baseDados.php';

        // Processamento do formulário
        if (isset($_REQUEST['nome'], $_REQUEST['mail'], $_REQUEST['pwd'], $_REQUEST['cc'], $_REQUEST['birth'])) {
            $username = $_REQUEST['nome'];
            $email = $_REQUEST['mail'];
            $password = $_REQUEST['pwd'];
            $identification = $_REQUEST['cc'];
            $birthday = $_REQUEST['birth'];
            $is_admin = isset($_REQUEST['is_admin']) ? 1 : 0; //o campo do admin é opcional

            // Começa a transação
            pg_query($connection, "BEGIN");

            // Insere na tabela pessoa
            $queryPessoa = "INSERT INTO pessoa (nome, cc, data_nasc, email, password) 
                    VALUES ('$username', '$identification', '$birthday', '$email', '$password')";

            $resultPessoa = pg_query($connection, $queryPessoa);

            if ($resultPessoa) {
                if ($is_admin) {
                    // Insere na tabela administrador
                    $queryAdmin = "INSERT INTO administrador (id, cargo, pessoa_nome) 
                           VALUES (DEFAULT, 'Admin', '$username')";
                    $resultAdmin = pg_query($connection, $queryAdmin);
                    if ($resultAdmin) {
                        pg_query($connection, "COMMIT");
                        header("Location: /PHP/login.php");
                        exit();
                    } else {
                        pg_query($connection, "ROLLBACK");
                    }
                } else {
                    // Insere na tabela cliente
                    // Gera um saldo aleatório entre 100 e 100000
                    $saldoAleatorio = rand(100, 100000);

                    // Insere na tabela cliente com saldo aleatório
                    $queryCliente = "INSERT INTO cliente (saldo, pessoa_nome) 
                             VALUES ($saldoAleatorio, '$username')";
                    $resultCliente = pg_query($connection, $queryCliente);
                    if ($resultCliente) {
                        pg_query($connection, "COMMIT");
                        header("Location: /PHP/login.php");
                        exit();
                    } else {
                        pg_query($connection, "ROLLBACK");
                    }
                }
            } else {
                pg_query($connection, "ROLLBACK");
            }
        } else {
        ?>

            <div class="wrapper">
                <div class="imgSignUp">
                    <img id="imgSU" src="/IMAGENS/carro.jpg" alt="imagem_signUp">
                </div>
                <div class="outContainer">
                    <div class="container">
                        <h2 class="tituloGeral" id="titulo">SIGN UP</h2>
                        <div class="register_form">
                            <form class="textoGeral" id="registationForm" method="POST" action="register.php">
                                <div>
                                    <label for="nome">Name</label>
                                    <input type="text" id="nome" name="nome" placeholder="Name" required>
                                </div>
                                <div class="inline-fields">
                                    <div>
                                        <label for="birth">Date of birth</label>
                                        <input type="date" name="birth" id="birth">
                                    </div>
                                    <div>
                                        <label for="cc">Identification</label>
                                        <input type="number" name="cc" id="cc">
                                    </div>
                                </div>
                                <div>
                                    <label for="mail">Email</label>
                                    <input type="email" id="mail" name="mail" placeholder="fastfurious@gmail.com" required>
                                </div>
                                <div>
                                    <label for="pwd">Password</label>
                                    <input type="password" id="pwd" name="pwd" placeholder=". . . . . . . . . ." required>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" id="is_admin" name="is_admin" value="1">
                                    <label for="is_admin">Administrator</label>
                                </div>
                                <div>
                                    <button class="botao" id="botaoRegister" type="submit">SUBMIT</button>
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