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
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Transform Plaintext Password
    
    $postPassword = sha1($postPassword);
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
	// Verify User
    
    $sqlUsernameCheck = "SELECT columnUsername,columnPassword FROM tableUsers WHERE columnUsername='$postUsername'
    AND columnPassword='$postPassword' LIMIT 1";
    if (mysqli_num_rows($conn->query($sqlUsernameCheck))) {
        echo "<p>Username and password are correctly given!</p>";
        $_SESSION["username"] = $postUsername;
        
    } else {
        echo "<p>Username and password either do not exist or are incorrect!</p>";
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Close the connection
    
    $conn->close();
    
?>


<br>
<form action="main.php">
<button type="submit" formaction="main.php">Click here to return to main</button>
</form>