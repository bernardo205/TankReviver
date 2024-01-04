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

// Handle tank search
$searchTank = isset($_GET['search']) ? $_GET['search'] : '';

// SQL Query with search condition
$query = "SELECT t.Tank_Name, p.Country, t.Production_Start, t.Production_End, t.Crew,
          t.Horsepower, t.Mass, t.Power_to_Weight
          FROM main_tr t
          JOIN country_type p ON t.Country_Id = p.Country_Id
          WHERE t.Tank_Name LIKE '%$searchTank%'";

$resultado = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <title>Loja Tanks</title>
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
        <div class="row">
            <?php if($resultado && $resultado->num_rows > 0): ?>
                <?php while($row = $resultado->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card tank-card">
                            <?php
                                $tankImageURL = '../img/' . $row['Tank_Name'] . '.png';
                            ?>
                            <img src="<?php echo $tankImageURL; ?>" class="card-img-top tank-image" alt="Tank Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Tank_Name']; ?></h5>
                                <p class="card-text">
                                    <?php echo $row['Country']; ?><br>
                                    Crew: <?php echo $row['Crew']; ?>
                                </p>
                                
                            </div>
                            <div class="additional-details">
                                <p>Horsepower: <?php echo $row['Horsepower']; ?></p>
                                <p>Mass: <?php echo $row['Mass']; ?></p>
                                <p>Power to Weight: <?php echo $row['Power_to_Weight']; ?></p>
                                <a href="php/tank_details.php?tank_name=<?php echo urlencode($row['Tank_Name']); ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <p>No tanks found for the specified search.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
