<?php
// Inicie a sessão para acessar as variáveis de sessão
session_start();

// Se não estiver logado, redirecione para a página de login
if (!isset($_SESSION['CustomerEmail'])) {
    header("Location: login.php");
    exit();
}

// Recupere o email do cliente da sessão
$customerEmail = $_SESSION['CustomerEmail'];

// Seu código de conexão ao banco de dados
$host = 'localhost';
$username = 'root';
$pass = '1979';
$database = 'main';

$mysqli = new mysqli($host, $username, $pass, $database);

// Verifique a conexão
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Consulta para obter os itens do carrinho do cliente
$cartQuery = "SELECT * FROM carrinho WHERE user_email = ?";
$cartStmt = $mysqli->prepare($cartQuery);
$cartStmt->bind_param("s", $customerEmail);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();

// Armazene os itens do carrinho em um array
$cartItems = $cartResult->fetch_all(MYSQLI_ASSOC);

// Processar o formulário de dados bancários
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $numero_cartao = $_POST['numero_cartao'];
    $nome_titular = $_POST['nome_titular'];
    $data_validade = $_POST['data_validade'];
    $codigo_seguranca = $_POST['codigo_seguranca'];

    // Valide os dados do cartão (adicionar validações conforme necessário)

    // Insira os dados na tabela compra para cada item no carrinho
    foreach ($cartItems as $cartItem) {
        $tankName = $cartItem['tank_name'];
        $sale_price = $cartItem['price'];  // Certifique-se de ter o campo correto no banco de dados para o preço

        // Insira os dados na tabela compra
        $insertSql = "INSERT INTO compra (Email, Tank_name, date, status, sale_price) VALUES (?, ?, NOW(), 'Pendente', ?)";
        $insertStmt = $mysqli->prepare($insertSql);
        $insertStmt->bind_param("ssi", $customerEmail, $tankName, $sale_price);
        $insertStmt->execute();
        $insertStmt->close();
    }

    // Esvazie o carrinho após o processamento bem-sucedido
    $deleteCartSql = "DELETE FROM carrinho WHERE user_email = ?";
    $deleteCartStmt = $mysqli->prepare($deleteCartSql);
    $deleteCartStmt->bind_param("s", $customerEmail);
    $deleteCartStmt->execute();
    $deleteCartStmt->close();

    // Redirecione para uma página de confirmação ou outra página apropriada
    header("Location: perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processar Compras</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="indexLog.php">Tank Reviver</a>
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
        </div>
    </div>
</nav>

    <div class="container">
        <h1>Processar Compras</h1>

        <!-- Formulário para dados bancários -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="numero_cartao" class="form-label">Número do Cartão:</label>
                <input type="text" name="numero_cartao" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nome_titular" class="form-label">Nome do Titular:</label>
                <input type="text" name="nome_titular" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="data_validade" class="form-label">Data de Validade:</label>
                <input type="text" name="data_validade" class="form-control" placeholder="MM/AAAA" required>
            </div>
            <div class="mb-3">
                <label for="codigo_seguranca" class="form-label">Código de Segurança:</label>
                <input type="text" name="codigo_seguranca" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Enviar Dados Bancários</button>
        </form>
    </div>


    <a href="perfil.php"><button type="submit" class="btn btn-danger" style="margin-top: 15px;margin-left: 100px;">Voltar ao perfil</button></a>
</div>

</body>
</html>
