<?php
$localhost = "";
$username = "digi_db";
$password = "";
$database = "digi_db";
global $conn;
// Create connection
$conn = mysqli_connect($localhost, $username, $password, $database,41890);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

