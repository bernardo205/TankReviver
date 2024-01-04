<?php

// Database connection parameters
$host = 'localhost';
$username = 'root';
$pass = '1979';
$database = 'main';

// Create a database connection
$mysqli = new mysqli($host, $username, $pass, $database);

// Check the connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Use declaração preparada para evitar injeção de SQL
$sql = "SELECT * FROM customer WHERE Email=? AND Password=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Verifique se o login foi bem-sucedido
if ($result->num_rows > 0) {
    // Inicie a sessão se ainda não estiver iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Obtenha o ID do cliente, se necessário
    $row = $result->fetch_assoc();
    $customerId = $row['Customer_Id'];

    // Armazene informações na sessão, se necessário
    $_SESSION['CustomerEmail'] = $email;
    $_SESSION['CustomerId'] = $customerId;

    echo "<script>alert('Login com sucesso!');</script>";
    header("Location: indexLog.php");
    exit();
} else {
    echo "<script>alert('E-mail ou senha incorretos');</script>";
}

// Feche a declaração e a conexão
$stmt->close();
$mysqli->close();

?>
