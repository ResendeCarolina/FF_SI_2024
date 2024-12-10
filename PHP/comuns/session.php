<!--guarda a informação dos dados do login do usuário-->

<?php
//inicia sessão
session_start();

//se a variável de início de sessão não estiver definida então o login não foi feito
if (!isset($_SESSION["username"])) {
    header("Location: registration.php");
    exit();
}
?>