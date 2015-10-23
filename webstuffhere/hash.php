<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

////Connect to server////
include 'connect.php';
// Create connection
$conn = db_connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Bind string to variable
$str = 'pw123456';
//Hash variable
$password = sha1($str);
//Print hashed output
echo "Password hashed becomes $password";

echo "<br />This is hashing!";

$conn->close();
?> 
