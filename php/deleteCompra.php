<?php
// Inicie a sessão se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifique se o usuário está autenticado como administrador
if (!isset($_SESSION['AdminEmail'])) {
    header("Location: adminLogin.html");
    exit();
}

// Parâmetros de conexão com o banco de dados
$host = 'localhost';
$username = 'root';
$pass = '1979';
$database = 'main';

// Criação da conexão com o banco de dados
$mysqli = new mysqli($host, $username, $pass, $database);

// Verifica a conexão
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Verifique se o ID da compra está presente na solicitação POST
if (isset($_POST['compra_id'])) {
    $compraId = $_POST['compra_id'];

    // SQL para excluir a compra com o ID fornecido
    $sql = "DELETE FROM compra WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $compraId);
    $stmt->execute();
    $stmt->close();

    // Redirecione de volta à página adminPage.php após excluir a compra
    header("Location: adminPage.php");
    exit();
} else {
    // Se o ID da compra não estiver presente na solicitação POST, redirecione para adminPage.php
    header("Location: adminPage.php");
    exit();
}

// Feche a conexão
$mysqli->close();
?>
