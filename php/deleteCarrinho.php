<?php
// deleteCompra.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['compra_id'])) {
    $compraId = $_POST['compra_id'];

    // Criar uma conexão com o banco de dados
    $host = 'localhost';
    $username = 'root';
    $pass = '1979';
    $database = 'main';

    $mysqli = new mysqli($host, $username, $pass, $database);

    // Verificar a conexão
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    // Preparar e executar a consulta SQL para excluir o item do carrinho
    $deleteQuery = "DELETE FROM carrinho WHERE id = ?";
    $deleteStmt = $mysqli->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $compraId);

    if ($deleteStmt->execute()) {
        // Após excluir, redirecionar de volta para a página do perfil
        header("Location: perfil.php");
        exit();
    } else {
        // Se a execução da consulta falhar, exibir uma mensagem de erro
        echo "Erro ao excluir o item do carrinho.";
    }

    // Fechar a conexão e a declaração
    $deleteStmt->close();
    $mysqli->close();
} else {
    // Se o pedido não for POST ou não houver 'compra_id', redirecionar para a página inicial ou exibir uma mensagem de erro.
    header("Location: index.php");
    exit();
}
?>
