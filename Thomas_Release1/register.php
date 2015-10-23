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
    
    $postFullName = htmlspecialchars($_POST['FullName']);
    $postUsername = htmlspecialchars($_POST['Username']);
    $postPassword = htmlspecialchars($_POST['Password']);
    $postConfirmPassword = htmlspecialchars($_POST['ConfirmPassword']);
    $postEmail    = htmlspecialchars($_POST['Email']);
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Validate the Provided Data
    $validated = TRUE;
    
    // Ensure all fields are accounted for and not empty
    if (trim($postFullName) == '' ||
        trim($postUsername) == '' ||
        trim($postPassword) == '' ||
        trim($postConfirmPassword) == '' ||
        trim($postEmail) == '') {
        $validated = FALSE;
        echo "<p>Ensure all fields are accounted for and not empty</p>";
    }
    
    // Full Name should not contain illegal characters
    if (strpos($postFullName,'`') || strpos($postFullName,'&') || strpos($postFullName,'{') ||
        strpos($postFullName,'~') || strpos($postFullName,'*') || strpos($postFullName,'}') ||
        strpos($postFullName,'!') || strpos($postFullName,'(') || strpos($postFullName,'[') ||
        strpos($postFullName,'@') || strpos($postFullName,')') || strpos($postFullName,']') ||
        strpos($postFullName,'#') || strpos($postFullName,'_') || strpos($postFullName,"\\") ||
        strpos($postFullName,'$') || strpos($postFullName,'-') || strpos($postFullName,'|') ||
        strpos($postFullName,'%') || strpos($postFullName,'+') || strpos($postFullName,';') ||
        strpos($postFullName,'^') || strpos($postFullName,'=') || strpos($postFullName,':') ||
        strpos($postFullName,"'") || strpos($postFullName,'"') || strpos($postFullName,',') ||
        strpos($postFullName,'<') || strpos($postFullName,'>') || strpos($postFullName,'.') ||
        strpos($postFullName,'/') || strpos($postFullName,'?') || strpos($postFullName,'1') ||
        strpos($postFullName,'2') || strpos($postFullName,'3') || strpos($postFullName,'4') ||
        strpos($postFullName,'5') || strpos($postFullName,'6') || strpos($postFullName,'7') ||
        strpos($postFullName,'8') || strpos($postFullName,'9') || strpos($postFullName,'0')) {
        $validated = FALSE;
        echo "<p>Full Name should not contain illegal characters</p>";
    }
    
    // Full Name should have a minimum of one space
    if (!strpos($postFullName,' ')) {
        $validated = FALSE;
        echo "<p>Full Name should have a minimum of one space</p>";
    }
    
    // Full Name should be two separate names
    if (strlen($postFullName) < 3 ||
        substr($postFullName,0) == ' ' ||
        substr($postFullName,(strlen($postFullName)-1)) == ' ') {
        $validated = FALSE;
        echo "<p>Full Name should be two separate names</p>";
    }
    
    // Username should not have a space
    if (strpos($postUsername,' ')) {
        $validated = FALSE;
        echo "<p>Username should not have a space</p>";
    }
    
    // Username should be a minimum of eight characters
    if (strlen($postFullName) < 8) {
        $validated = FALSE;
        echo "<p>Username should be a minimum of eight characters</p>";
    }
    
    // Username should not contain illegal characters
    if (strpos($postUsername,'`') || strpos($postUsername,'&') || strpos($postUsername,'{') ||
        strpos($postUsername,'~') || strpos($postUsername,'*') || strpos($postUsername,'}') ||
        strpos($postUsername,'!') || strpos($postUsername,'(') || strpos($postUsername,'[') ||
        strpos($postUsername,'@') || strpos($postUsername,')') || strpos($postUsername,']') ||
        strpos($postUsername,'$') || strpos($postUsername,'|') || strpos($postUsername,'#') ||
        strpos($postUsername,'%') || strpos($postUsername,'+') || strpos($postUsername,';') ||
        strpos($postUsername,'^') || strpos($postUsername,'=') || strpos($postUsername,':') ||
        strpos($postUsername,"'") || strpos($postUsername,'"') || strpos($postUsername,',') ||
        strpos($postUsername,'<') || strpos($postUsername,'>') || strpos($postUsername,"\\") ||
        strpos($postUsername,'/') || strpos($postUsername,'?')) {
        $validated = FALSE;
        echo "<p>Username should not contain illegal characters</p>";
    }

    // Username should not be already taken
    $sqlUsernameCheck = "SELECT * FROM tableUsers WHERE columnUsername='$postUsername' LIMIT 1";
    if (mysqli_num_rows($conn->query($sqlUsernameCheck))) {
        $validated = FALSE;
        echo "<p>Username should not be already taken</p>";
    }
    
    // Password should not contain illegal characters
    if (strpos($postPassword,'`') || strpos($postPassword,'&') || strpos($postPassword,'{') ||
        strpos($postPassword,'~') || strpos($postPassword,'*') || strpos($postPassword,'}') ||
        strpos($postPassword,'!') || strpos($postPassword,'(') || strpos($postPassword,'[') ||
        strpos($postPassword,'@') || strpos($postPassword,')') || strpos($postPassword,']') ||
        strpos($postPassword,'$') || strpos($postPassword,'|') || strpos($postPassword,'#') ||
        strpos($postPassword,'%') || strpos($postPassword,'+') || strpos($postPassword,';') ||
        strpos($postPassword,'^') || strpos($postPassword,'=') || strpos($postPassword,':') ||
        strpos($postPassword,"'") || strpos($postPassword,'"') || strpos($postPassword,',') ||
        strpos($postPassword,'<') || strpos($postPassword,'>') || strpos($postPassword,"\\") ||
        strpos($postPassword,'/') || strpos($postPassword,'?')) {
        $validated = FALSE;
        echo "<p>Password should not contain illegal characters</p>";
    }
    
    // Password should match the confirmed password
    if ($postConfirmPassword != $postPassword) {
        $validated = FALSE;
        echo "<p>Password should match the confirmed password</p>";
    }
    
    // Password should be a minimum of eight characters
    if (strlen($postPassword) < 8) {
        $validated = FALSE;
        echo "<p>Password should be a minimum of eight characters</p>";
    }
    
    // Email should not contain illegal characters
    if (strpos($postEmail,'`') || strpos($postEmail,'&') || strpos($postEmail,'{') ||
        strpos($postEmail,'~') || strpos($postEmail,'*') || strpos($postEmail,'}') ||
        strpos($postEmail,'!') || strpos($postEmail,'(') || strpos($postEmail,'[') ||
        strpos($postEmail,')') || strpos($postEmail,']') || strpos($postEmail,'?') ||
        strpos($postEmail,'$') || strpos($postEmail,'|') || strpos($postEmail,'#') ||
        strpos($postEmail,'%') || strpos($postEmail,'+') || strpos($postEmail,';') ||
        strpos($postEmail,'^') || strpos($postEmail,'=') || strpos($postEmail,':') ||
        strpos($postEmail,"'") || strpos($postEmail,'"') || strpos($postEmail,',') ||
        strpos($postEmail,'<') || strpos($postEmail,'>') || strpos($postEmail,"\\") ||
        strpos($postEmail,'/')) {
        $validated = FALSE;
        echo "<p>Email should not contain illegal characters</p>";
    }
    
    // Email should follow global standards of syntax
    if (!strpos($postEmail,'@') || !strpos($postEmail,'.')) {
        $validated = FALSE;
        echo "<p>Email should follow global standards of syntax</p>";
    }
    
    // Email should not be already taken
    $sqlEmailCheck = "SELECT * FROM tableUsers WHERE columnEmail='$postEmail' LIMIT 1";
    if (mysqli_num_rows($conn->query($sqlEmailCheck))) {
        $validated = FALSE;
        echo "<p>Email should not be already taken</p>";
    }
    
    // Agrement should be ticked
    if (!isset($_POST['Agreement'])) {
        $validated = FALSE;
        echo "<p>Agrement should be ticked</p>";
    }
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // If the details are valid, enter them into the database
    
    if ($validated) {
		//Transform the plaintext password to a hashed string
		$postPassword = sha1($postPassword);
        // Enter record
        $sql = "INSERT INTO `databaseMediaVault`.`tableUsers`
        (`columnID`, `columnFullName`, `columnUsername`, `columnPassword`, `columnEmail`)
        VALUES (NULL, '".$postFullName."', '".$postUsername."', '".$postPassword."', '".$postEmail."');";
    
        if ($conn->query($sql) === TRUE) {
            echo "New user created successfully. Check phpMyAdmin for said record.<br>";
            
            echo '
            <form action="registration_form.php">
            <button type="submit" formaction="registration_form.php">Add Another User</button>
            </form>';
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '
        <form action="registration_form.php">
        <button type="submit" formaction="registration_form.php">Retry</button>
        </form>';
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Close the connection
    
    $conn->close();
    
?>


<br>
<form action="main.php">
<button type="submit" formaction="main.php">Click here to return to main</button>
</form>