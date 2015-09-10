<html>
<head>
    <title>Media Library</title>
</head>
<body>
<h1>Media Library</h1>

<?php

include("connect.php"); 
# Connect to the database

$conn = db_connect();

$query = "SELECT * FROM tableFiles" ;
$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

if(isset($_POST['delete'])){
    $queryDelete = "DELETE FROM tableFiles WHERE columnID='$_POST[hidden]'";
	$filename = "/var/www/html/uploads/{$_POST[Name]}";
	echo $filename;
	if (unlink($filename)) {
		mysqli_query($conn, $queryDelete);
        echo 'File <strong>'.$filename.'</strong>has been deleted.';
        } else {
            echo 'File cannot be deleted.';
        }
    }

echo "<table>";
echo "<tr><th>ID</th><th>File</th><th>Name</th><th>Uploaded</th><th>Type</th></tr>";

while ($row = mysqli_fetch_array($queryresult)) {
   echo "<form action=FormPopulate.php method=post>";
   echo "<tr>" ;
	echo "<td>" . "<input type=text name=ID value=" . $row['columnID'] . " </td>";
	echo "<td>" . "<input type=text name=File URL value=" . $row['columnFileURL'] . " </td>";
	echo "<td>" . "<input type=text name=Name value=" . $row['columnName'] . " </td>";
	echo "<td>" . "<input type=text name=Created value=" . $row['columnCreated'] . " </td>";
	echo "<td>" . "<input type=text name=Type value=" . $row['columnType'] . " </td>";	
	echo "<td>" . "<input type=hidden name=hidden value=" . $row['columnID'] . " </td>";
	echo "<td>" . "<input type=submit name=delete value=" .  " </td>";	
   echo "</tr>" ;
	echo "</form>";
}

echo "</table>";

# }

?>

</body>
</html>
