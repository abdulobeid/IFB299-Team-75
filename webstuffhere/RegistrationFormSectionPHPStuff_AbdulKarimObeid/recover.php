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
        
        echo "Your password has been sent to your nominated email";
        
    } else {
        echo 'Username should be in the database.';
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Close the connection
    
    $conn->close();
    
?>


<br>
<form action="main.php">
<button type="submit" formaction="main.php">Click here to return to main</button>
</form>