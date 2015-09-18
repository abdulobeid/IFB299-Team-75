<?php
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "alpine";
    $dbname = "databaseMediaVault";
    
    // Create and check connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Get Details
    
    $postUsername = htmlspecialchars($_POST['Username']);
    $postPassword = htmlspecialchars($_POST['Password']);
	$bUsername = $postUsername;
	$bPassword = $postPassword;
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Transform Plaintext Password
    
    $postPassword = sha1($postPassword);
	
	$sqlUsernameCheck = "SELECT columnUsername,columnPassword,columnID FROM tableUsers WHERE columnUsername='$postUsername'
		AND columnPassword='$postPassword' LIMIT 1";
		
		$queryresult = mysqli_query($conn, $sqlUsernameCheck) or die('Error connecting to database') ;
		
		
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
	<?php
		// Verify User
		$_SESSION["busername"] = '';
		$_SESSION["bpassword"] = '';
		$_SESSION["berror"] = '';
		
		if (mysqli_num_rows($conn->query($sqlUsernameCheck))) {
			
			while ($row = mysqli_fetch_array($queryresult)) {
				$_SESSION["userID"] = $row['columnID'];
			}
			
			$_SESSION["username"] = $postUsername;
			
			echo '
			<div id="_div_SBX">
				<div id="_div_SBX_MSG">
					<p>You have been successfully logged in!</p>
					<p>Loading...</p>
					<img id="_div_LDG_IMG" src="images/loading.fw.png">
				</div>
			</div>';
			header('Refresh: 2; URL=login_form.php');
		} else {
			$_SESSION["busername"] = $bUsername;
			$_SESSION["bpassword"] = $bPassword;
			$_SESSION["berror"] = '!!!';
			echo '
			<div id="_div_SBX">
				<div id="_div_SBX_MSG">
					<p>The details you gave were incorrect!</p>
					<p>Redirecting to Log In page...</p>
					<img id="_div_LDG_IMG" src="images/loading.fw.png">
				</div>
			</div>';
			header('Refresh: 2; URL=login_form.php');
		}
    
	?>
</body>
</html>

<?php
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Close the connection
    
    $conn->close();
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>