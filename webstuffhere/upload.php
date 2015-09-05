<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

include 'connect.php';

$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['userfile']['name']);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$conn = db_connect();

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)) {
	echo "This file ".  basename($_FILES['userfile']['name']). " has been uploaded";
} else {
	echo "The file ".  basename($_FILES['userfile']['name']). " has not been uploaded";
}

$sql = "INSERT INTO tableFiles (columnFileURL, columnName, columnType) VALUES ('$target_dir', '$fileName', '$fileType')";

if ($conn->query($sql) === TRUE) {
    echo "\nNew record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
