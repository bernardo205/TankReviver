<?php
// Inicie a sessão se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destrua todas as variáveis de sessão
session_destroy();

// Redirecione para a página de login do administrador
header("Location: ../html/login.html");
exit();
?>
