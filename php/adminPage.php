<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Página de Compras</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashbord</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="adminLogout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
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

        // Código SQL para obter todas as compras
        $sql = "SELECT * FROM compra where status = 'Pendente' ORDER BY date ASC ";
        $result = $mysqli->query($sql);

        // Verifica se há resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class='card mt-3'>
                    <div class='card-body'>
                        <h5 class='card-title'>Compra #<?php echo $row['id']; ?></h5>
                        <p class='card-text'><strong>Email:</strong> <?php echo $row['Email']; ?></p>
                        <p class='card-text'><strong>Tank Name:</strong> <?php echo $row['Tank_name']; ?></p>
                        <p class='card-text'><strong>Data:</strong> <?php echo $row['date']; ?></p>
                        <p class='card-text'><strong>Status:</strong> <?php echo $row['status']; ?></p>
                        <p class='card-text'><strong>Preço de Venda:</strong> <?php echo $row['sale_price']; ?></p>
                        
                        <!-- Botão de exclusão -->
                        <form action='deleteCompra.php' method='POST'>
                            <input type='hidden' name='compra_id' value='<?php echo $row['id']; ?>'>
                            <button type='submit' class='btn btn-danger'>Excluir Compra</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class='card mt-3'>
                <div class='card-body'>
                    Nenhuma compra encontrada.
                </div>
            </div>
            <?php
        }

        // Feche a conexão
        $mysqli->close();
        ?>
    </div>
</body>
</html>
