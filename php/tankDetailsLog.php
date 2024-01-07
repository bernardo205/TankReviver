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

$tankName = isset($_GET['tank_name']) ? $_GET['tank_name'] : '';
$userEmail = isset($_GET['user_email']) ? $_GET['user_email'] : '';

$sql = "
    SELECT
        main_tr.Tank_Name,
        country_type.Country,
        main_tr.Production_Start,
        main_tr.Production_End,
        main_tr.Numbers_Made,
        main_tr.Crew,
        main_tr.Horsepower,
        main_tr.Mass,
        main_tr.Power_to_Weight,
        main_tr.Max_Speed,
        fuel_type.Fuel,
        main_tr.Elevation,
        main_tr.Depression,
        main_tr.Range_km,
        tank_type.Tank,
        main_tr.Hull_Armor,
        main_tr.Turret_Armor,
        main_tr.Armor_Penetration,
        caliber_type.Caliber
    FROM
        main_tr
    JOIN
        country_type ON main_tr.Country_Id = country_type.Country_Id
    JOIN
        fuel_type ON main_tr.Fuel_Id = fuel_type.Fuel_Id
    JOIN
        tank_type ON main_tr.Tank_Id = tank_type.Tank_Id
    JOIN
        caliber_type ON main_tr.Caliber_Id = caliber_type.Caliber_Id
    WHERE
        main_tr.Tank_Name = ?
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $tankName);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_SESSION['CustomerEmail'])) {
        $userName = $_SESSION['CustomerEmail'];
        $tankName = isset($_POST['tank_name']) ? $_POST['tank_name'] : '';

        // Passar dados pela URL para a página de carrinho
        header("Location: carrinho.php?tank_name=" . urlencode($tankName) . "&user_email=" . urlencode($userName));
        exit();
    } else {
        echo "Usuário não logado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/tankDetails.css">
    <title>Tank Details</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Tank Reviver</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../html/aboutUs.html">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/specialRequest.html">Special Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="tank-details">
                <img src="../img/<?php echo htmlspecialchars($row['Tank_Name']); ?>.png" alt="Tank Image">
                    <h2><?php echo htmlspecialchars($row['Tank_Name']); ?></h2>
                    <p><label>Country:</label> <?php echo htmlspecialchars($row['Country']); ?></p>
                    <p><label>Production Start:</label> <?php echo htmlspecialchars($row['Production_Start']); ?></p>
                    <p><label>Production End:</label> <?php echo htmlspecialchars($row['Production_End']); ?></p>
                    <p><label>Numbers Made:</label> <?php echo htmlspecialchars($row['Numbers_Made']); ?></p>
                    <p><label>Crew:</label> <?php echo htmlspecialchars($row['Crew']); ?></p>
                    <p><label>Horsepower:</label> <?php echo htmlspecialchars($row['Horsepower']); ?></p>
                    <p><label>Mass:</label> <?php echo htmlspecialchars($row['Mass']); ?></p>
                    <p><label>Power to Weight:</label> <?php echo htmlspecialchars($row['Power_to_Weight']); ?></p>
                    <p><label>Max Speed:</label> <?php echo htmlspecialchars($row['Max_Speed']); ?></p>
                    <p><label>Fuel:</label> <?php echo htmlspecialchars($row['Fuel']); ?></p>
                    <p><label>Elevation:</label> <?php echo htmlspecialchars($row['Elevation']); ?></p>
                    <p><label>Depression:</label> <?php echo htmlspecialchars($row['Depression']); ?></p>
                    <p><label>Range (km):</label> <?php echo htmlspecialchars($row['Range_km']); ?></p>
                    <p><label>Tank Type:</label> <?php echo htmlspecialchars($row['Tank']); ?></p>
                    <p><label>Hull Armor:</label> <?php echo htmlspecialchars($row['Hull_Armor']); ?></p>
                    <p><label>Turret Armor:</label> <?php echo htmlspecialchars($row['Turret_Armor']); ?></p>
                    <p><label>Armor Penetration:</label> <?php echo htmlspecialchars($row['Armor_Penetration']); ?></p>
                    <p><label>Caliber:</label> <?php echo htmlspecialchars($row['Caliber']); ?></p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="tank_name" value="<?php echo htmlspecialchars($row['Tank_Name']); ?>">
                        <button type="submit" class="btn btn-danger">Buy</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No tank details found for the specified tank.</p>
        <?php endif; ?>
    </div>
</body>
</html>
