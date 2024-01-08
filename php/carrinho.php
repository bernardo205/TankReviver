<?php
// Start the session
session_start();

// Your database connection parameters
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required session and POST variables are set
    if (!empty($_SESSION['CustomerEmail']) && isset($_POST['tank_name'])) {
        // Get user email and tank name from session and POST data
        $userEmail = $_SESSION['CustomerEmail'];
        $tankName = $_POST['tank_name'];

        // Prepare and execute the SQL query to insert data into the carrinho table
        $query = "INSERT INTO carrinho (user_email, tank_name) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $userEmail, $tankName);

        if ($stmt->execute()) {
            // Redirect to indexLog.php after updating the database
            header("Location: indexLog.php");
            exit();
        } else {
            // Handle the case when the query execution fails
            echo "Error updating the database.";
        }
    } else {
        // Handle the case when session or tank_name is not set
        echo "Invalid request.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>
