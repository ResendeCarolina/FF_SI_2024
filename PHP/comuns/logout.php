<?php
session_start(); // Inicia a sessão

// Verifica se a sessão existe
if (isset($_SESSION['user'])) {
    // Remove todos os dados da sessão
    session_unset();

    // Destroi a sessão
    session_destroy();

    // Redireciona para a página de login
    header('Location: ../comuns/login.php');
    exit();
} else {
    // Se não estiver logado, redireciona para a página de login diretamente
    header('Location: ../comuns/login.php');
    exit();
}
?>