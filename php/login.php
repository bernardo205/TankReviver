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

$email = strtolower($_POST['email']); // Convert to lowercase
$password = $_POST['password'];

// Check if the email belongs to the "@tankrevive.com" domain
if (strpos($email, '@tankrevive.com') !== false) {
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM admin WHERE email=? AND password=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin login was successful
    if ($result->num_rows > 0) {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Get admin ID if needed
        $row = $result->fetch_assoc();
        $adminId = $row['id'];

        // Store information in session if needed
        $_SESSION['AdminEmail'] = $email;
        $_SESSION['AdminId'] = $adminId;

        echo "<script>alert('Admin Login successful!');</script>";

        // Redirect to admin page
        header("Location: adminPage.php?email=" . urlencode($email));
        exit();
    }
}

// If not an admin or admin login failed, check customer login
$sql = "SELECT * FROM customer WHERE Email=? AND Password=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if customer login was successful
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

    echo "<script>alert('Customer Login successful!');</script>";

    // Redirect to customer page
    header("Location: indexLog.php?email=" . urlencode($email));
    exit();
} else {
    echo "<script>alert('Incorrect email or password');</script>";
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
