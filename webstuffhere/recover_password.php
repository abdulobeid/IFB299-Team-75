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
		<?php  
    if ($_SESSION["username"] == ''){
        echo '
		<div id="_div_REG">
        <form action="recover.php" method="post">
        <p>
        <h1>Recovery Form</h1>
        </p>
        <p>
        Use this form to recover your password. Simply enter your username below:
			</p>
        <p>
        Username: <input  id="_inp_TXT" type="text" name="Username"><br>
        </p>
		<p>
				We will send your password to the email associated with that username.</p>
        <input id="_inp_BTN" type="submit" value="Recover Password">
		
        </form>
		<br>
		<form action="login_form.php">
		<input id="_inp_BTN" type="submit" value="Return to Main Menu">
		</form>
		</div>
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




