<html>
<head>
    <title>Media Library</title>
</head>
<body>
<h1>Media Library</h1>

<?php
include 'connect.php;
# Connect to the database
$conn = db_connect();

$query = "SELECT * FROM tableFiles" ;
$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

echo "<table>";
echo "<tr><th>ID</th><th>File</th><th>Name</th><th>Uploaded</th><th>Type</th></tr>";

while ($row = mysqli_fetch_array($queryresult, MYSQLI_ASSOC)) {

    echo "<tr><td>" ;
	echo $row['columnID'];
	echo "</td><td>" ;
	echo $row['columnFile'];
	echo "</td><td>" ;
	echo $row['columnName'];
	echo "</td><td>" ;
	echo $row['columnCreated'];
	echo "</td></tr>" ;
	

}
//I want the button to be beside each column. When you click it gives an alert and then unlinks (deletes) the file
//<input type="button" onclick="alert('Hello World!')" value="Say Hello!">
//http://php.net/manual/en/function.unlink.php

echo "</table>";

//}


?>

</body>
</html>