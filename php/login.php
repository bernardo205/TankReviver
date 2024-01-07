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

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM customer WHERE Email=? AND Password=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if login was successful
if ($result->num_rows > 0) {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get customer ID if needed
    $row = $result->fetch_assoc();
    $customerId = $row['Customer_Id'];

    // Store information in session if needed
    $_SESSION['CustomerEmail'] = $email;
    $_SESSION['CustomerId'] = $customerId;

    echo "<script>alert('Login successful!');</script>";

    // Add email as a parameter in the redirection URL
    header("Location: indexLog.php?email=" . urlencode($email));
    exit();
} else {
    echo "<script>alert('Incorrect email or password');</script>";
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
