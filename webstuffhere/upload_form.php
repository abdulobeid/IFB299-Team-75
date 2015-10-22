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
	<link href="CSS/filterStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="_div_BBM_UPL">
<div id="_div_UPP">
<form enctype="multipart/form-data" action="upload.php" method="POST">
	<p>
		<label>Name your File:</label>
		<input type="text" id="_inp_TXT_UP" name="txtName" />
	</p>
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000000000" />
		<label>Choose a file to upload:</label>
	</p>
	<p>
		<input type="file" id="_inp_TXT_UP" name="userfile" /><br />
	</p>
	<p>
		<input type="submit" id="_inp_BTN" name="uploadfile" value="Upload File" />
	</p>
</form>
</div>
</div>
</body>
</html>