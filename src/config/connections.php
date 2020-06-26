<?php
$localhost = "127.0.0.1";
$username = "root";
$password = "123";
$database = "digi_db";

// Create connection
$conn = mysqli_connect($localhost, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
