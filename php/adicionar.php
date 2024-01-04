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
$nome = $_POST['nome'];
$apelido = $_POST['apelido'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$country = $_POST['country'];

$sql = "INSERT INTO customer(First_Name, Last_Name, Email, Password, Phone_Number, Address, City, State, Zipcode, Country) VALUES('$nome','$apelido','$email','$password','$phone','$address','$city','$state','$zipcode','$country')";

if ($mysqli->query($sql) === TRUE) {
    // If the insertion is successful, redirect to the login page
    header("Location: ../html/login.html");
    exit(); // Make sure to stop further execution after the redirect
} else {
    // If there is an error in the insertion, respond with a JSON indicating failure and the error
    $response = array("success" => false, "error" => $mysqli->error);
}
?>