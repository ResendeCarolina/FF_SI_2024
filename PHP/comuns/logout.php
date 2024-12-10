<?php
session_start(); //inicia a sessão

//verifica se a sessão foi iniciada
if (isset($_SESSION['user'])) {
    //remove/apaga todos os dados da sessão
    session_unset();

    //encerra a sessão
    session_destroy();

    //depoi de fazer logout sou redirecionado para o login
    header('Location: ../comuns/login.php');
    exit();
} else {
    //se não, vou diretamente para a página do login
    header('Location: ../comuns/login.php');
    exit();
}
