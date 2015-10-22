<?php
    // Start the session
    session_start();
?>
<?php
include 'connect.php';

$txtName = $_POST['txtName'];
$fileName  = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$user = $_SESSION["userID"];
$fileType = $_FILES['userfile']['type'];
$target_dir = "uploads/";
$target_file = $target_dir . $user . "_" . basename($_FILES['userfile']['name']);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$feedStatus = "added " . $fileName . " to the vault.";
$sqldate = date("Y-m-d H:i:s");
$conn = db_connect();

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

// Check to see if the file already exists
if (file_exists($target_file)) {
	echo "<script type='text/javascript'>alert('You have already uploaded this file before');</script>";
	header("refresh:0; url=upload_form.php");
} else {
	// Check the ability to upload to the server
	if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)) {
		$sql = "INSERT INTO tableFiles (userID, columnFileURL, columnName, columnType) VALUES ('$user', '$target_file', '$txtName', '$fileType')";
		$sql_feed = "INSERT INTO tableFeed (columnUserID, columnStatus, columnDate) VALUES ('$user', '$feedStatus', '$sqldate')";
		if ($conn->query($sql) === TRUE){
			$conn->query($sql_feed);
			$conn->close();
			echo "<script type='text/javascript'>alert('This file has been successfully uploaded');</script>";
			header("refresh:0; url=formPopulateFilter.php");
		} else {
			//  echo "Error: " . $sql . "<br>" . $conn->error;  - OLD message for sql error contents
			echo "<script type='text/javascript'>alert('There has been an error with your connection to our database sorry');</script>";
			header("refresh:0; url=upload_form.php");
		}	
	} else {
		echo "<script type='text/javascript'>alert('There has been an error uploading your file');</script>";
		header("refresh:0; url=upload_form.php");
	}
}
?> 