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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['AdminEmail'])) {
            header("Location: adminLogin.html");
            exit();
        }

        $host = 'localhost';
        $username = 'root';
        $pass = '1979';
        $database = 'main';

        $mysqli = new mysqli($host, $username, $pass, $database);

        if ($mysqli->connect_error) {
            die('Connection failed: ' . $mysqli->connect_error);
        }

        $sql = "SELECT compra.*, main_tr.Price 
                FROM compra
                JOIN main_tr ON compra.Tank_name = main_tr.Tank_Name
                WHERE compra.status = 'Pendente'
                ORDER BY compra.date ASC ";

        $result = $mysqli->query($sql);

        $groupedCompras = array();

        while ($row = $result->fetch_assoc()) {
            $dataCompra = $row['date'];
            $emailCompra = $row['Email'];
            $groupKey = $dataCompra . '_' . $emailCompra;

            if (!isset($groupedCompras[$groupKey])) {
                $groupedCompras[$groupKey] = array(
                    'data' => $dataCompra,
                    'email' => $emailCompra,
                    'compras' => array(),
                    'totalPrice' => 0
                );
            }

            $groupedCompras[$groupKey]['compras'][] = $row;
            $groupedCompras[$groupKey]['totalPrice'] += $row['Price'];
        }

        foreach ($groupedCompras as $groupedCompra) {
            ?>
            <div class='card mt-3'>
                <div class='card-body'>
                    <h5 class='card-title'>Compras em <?php echo $groupedCompra['data']; ?> para <?php echo $groupedCompra['email']; ?></h5>
                    <?php
                    foreach ($groupedCompra['compras'] as $compra) {
                        ?>
                        <p class='card-text'><strong>Compra #<?php echo $compra['id']; ?>:</strong> Tank Name: <?php echo $compra['Tank_name']; ?>, Status: <?php echo $compra['status']; ?>, Preço de Venda: <?php echo $compra['Price']; ?></p>
                        <?php
                    }
                    ?>
                    <p class='card-text'><strong>Preço Total:</strong> <?php echo $groupedCompra['totalPrice']; ?></p>
                    <form action='deleteCompra.php' method='POST'>
                        <input type='hidden' name='compra_id' value='<?php echo $groupedCompra['compras'][0]['id']; ?>'>
                        <button type='submit' class='btn btn-danger'>Excluir Todas as Compras</button>
                    </form>
                </div>
            </div>
            <?php
        }

        $mysqli->close();
        ?>
    </div>
</body>
</html>
