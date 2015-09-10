

<?php
   /* session_start();
    
    if ($_SESSION["username"] == ''){
        echo "You are not currently logged in";
    } else {
        echo "You are currently logged in as".$_SESSION["username"];
    }
    
    echo "<br>";*/
?>

<head>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

<div id="cntWRP">

<form action="login_form.php">
<button type="submit" formaction="login_form.php">Click here to log in</button>
</form>

<form action="registration_form.php">
<button type="submit" formaction="registration_form.php">Click here to register</button>
</form>


<form action="recover_password.php">
<button type="submit" formaction="recover_password.php">Click here to recover a password</button>
</form>

</div>

</body>