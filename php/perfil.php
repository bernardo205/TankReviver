<?php
// Inicie a sessão para acessar as variáveis de sessão
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['CustomerEmail'])) {
    // Se não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit();
}

// Recupere os dados da conta do usuário, se necessário
$customerId = isset($_SESSION['CustomerId']) ? $_SESSION['CustomerId'] : null;
$customerEmail = $_SESSION['CustomerEmail'];

// Crie uma conexão com o banco de dados
$host = 'localhost';
$username = 'root';
$pass = '1979';
$database = 'main';

$mysqli = new mysqli($host, $username, $pass, $database);

// Verifique a conexão
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Consulta para obter os dados do cliente
$sql = "SELECT * FROM customer WHERE Customer_Id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

// Armazene os dados do cliente em um array
$customerData = $result->fetch_assoc();

// Feche a declaração e a conexão
$stmt->close();

// Atualizar dados na base de dados quando o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedFirstName = $_POST['first_name'];
    $updatedLastName = $_POST['last_name'];
    $updatedPhoneNumber = $_POST['phone_number'];
    $updatedAddress = $_POST['address'];
    $updatedCity = $_POST['city'];
    $updatedState = $_POST['state'];
    $updatedZipcode = $_POST['zipcode'];
    $updatedCountry = $_POST['country'];

    // Reabra a conexão com o banco de dados
    $mysqli = new mysqli($host, $username, $pass, $database);

    // Verifique a conexão
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    // Atualizar os dados na base de dados
    $updateSql = "UPDATE customer SET First_Name=?, Last_Name=?, Phone_Number=?, Address=?, City=?, State=?, Zipcode=?, Country=? WHERE Customer_Id=?";
    $updateStmt = $mysqli->prepare($updateSql);
    $updateStmt->bind_param("ssisssssi", $updatedFirstName, $updatedLastName, $updatedPhoneNumber, $updatedAddress, $updatedCity, $updatedState, $updatedZipcode, $updatedCountry, $customerId);
    $updateStmt->execute();
    $updateStmt->close();

    // Feche a conexão
    $mysqli->close();

    // Recarregue a página para exibir os dados atualizados
    header("Location: perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Cliente</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Tank Reviver</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="html/aboutUs.html">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="html/specialRequest.html">Special Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="get" action="index.php">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Perfil do Cliente</h1>
        
        <h2>Dados da Conta:</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($customerData['First_Name']); ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($customerData['Last_Name']); ?>">

            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" value="<?php echo htmlspecialchars($customerData['Phone_Number']); ?>">

            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($customerData['Address']); ?>">

            <label for="city">City:</label>
            <input type="text" name="city" value="<?php echo htmlspecialchars($customerData['City']); ?>">

            <label for="state">State:</label>
            <input type="text" name="state" value="<?php echo htmlspecialchars($customerData['State']); ?>">

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="zipcode" value="<?php echo htmlspecialchars($customerData['Zipcode']); ?>">

            <label for="country">Country:</label>
            <input type="text" name="country" value="<?php echo htmlspecialchars($customerData['Country']); ?>">

            <button type="submit">Atualizar Dados</button>
        </form>

        <p><a href="logout.php">Sair</a></p> <!-- Link para a página de logout -->
    </div>

</body>
</html>
