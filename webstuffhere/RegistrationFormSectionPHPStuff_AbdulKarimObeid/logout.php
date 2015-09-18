<?php
    // Start the session
    session_start();
    
    if ($_SESSION["username"] == ''){
        echo "You aren't logged in";
    } else {
        $_SESSION["username"] = "";
        echo "You are now logged out";
    }
    
?>


<br>
<form action="main.php">
<button type="submit" formaction="main.php">Click here to return to main</button>
</form>