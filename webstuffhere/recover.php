<html>
<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="CSS/mainStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="_div_REG">
        <p>
        <h1>Recovery Form</h1>
        </p>

<?php
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
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
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Validate the Provided Data
    $validated = FALSE;
    // Username should exist
    $sqlUsernameCheck = "SELECT columnUsername,columnPassword,columnEmail FROM tableUsers WHERE columnUsername='$postUsername' LIMIT 1";
    
    $result = $conn->query($sqlUsernameCheck);
    
    if (mysqli_num_rows($result)) {
        $validated = TRUE;
        
        
        while($row = $result->fetch_assoc()) {
            $itemUsername = $row["columnUsername"];
            $itemPassword = $row["columnPassword"];
            $itemEmail = $row["columnEmail"];
            
            $messageString = 'Hi '.$itemUsername.', your password is '.'"'.$itemPassword.'"';
            mail( $itemEmail,"Password Recovery from Media Vault",$messageString);
        }
        
        echo "Your password has been sent to your nominated email address. Have a great day!";
        
    } else {
        echo 'Our database indicates that the username you have entered was not found.<br>';
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Close the connection
    
    $conn->close();
    
?>
<p>
<form action="login_form.php">
		<input id="_inp_BTN" type="submit" value="Return to Main Menu">
		</form></p>
</div>
        </body>
        </html>