<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="CSS/mainStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form enctype="multipart/form-data" action="upload.php" method="POST">
	<p>
		<label>Name:</label>
		<input type="text" name="txtName" />
	</p>
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000000000" />
		<label>Choose a file to upload:</label>
	</p>
	<p>
		<input type="file"  name="userfile" /><br />
	</p>
	<p>
		<input type="submit" name="uploadfile" value="Upload File" />
	</p>
</form>

</body>
</html>