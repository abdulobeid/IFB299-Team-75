<?php
    // Start the session
    session_start();
    
    if ($_SESSION["username"] == ''){
        echo '
        <!DOCTYPE HTML>
        <html>
        <body>
        
        <form action="login.php" method="post">
        <p>
        <h1>Login Form</h1>
        </p>
        <p>
        Please enter your details below...
        <p>
    Username: <input type="text" name="Username"><br>
        </p>
        <p>
    Password: <input type="password" name="Password"><br>
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


<br>

try entering 'bob12345' as username with 'pw123456' as password 