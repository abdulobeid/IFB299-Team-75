<?php
    // Start the session
    session_start();
    
    if ($_SESSION["username"] == ''){
        echo '<!DOCTYPE HTML>
        <html>
        <body>
        
        <form action="recover.php" method="post">
        <p>
        <h1>Recovery Form</h1>
        </p>
        <p>
        Use this form to recover your password by entering in your username below. We will send your password to the email associated with that username:
        </p>
        <p>
        Username: <input type="text" name="Username"><br>
        </p>
        <input type="submit">
        </form>
        </body>
        </html>
        ';
    } else {
        echo "You are already logged in as".$_SESSION["username"];
        echo "<br><br><br>";
        echo '
        <form action="logout.php">
        <button type="submit" formaction="logout.php">Click here to log out</button>
        </form>';
    }
?>



<br>
<form action="main.php">
<button type="submit" formaction="main.php">Click here to return to main</button>
</form>
