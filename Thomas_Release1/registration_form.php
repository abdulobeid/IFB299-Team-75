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
			<form action="register.php" method="post">
			<p>
			<h1>Registration Form</h1>
			</p>
			<p>
			Please enter your details below...
			</p>
			<p>
			Full Name: <input type="text" name="FullName"><br>
			</p>
			<p>
			Username: <input type="text" name="Username"><br>
			</p>
			<p>
			Password: <input type="password" name="Password"><br>
			</p>
			<p style="margin-right:9%">
			Confirm Password: <input type="password" name="ConfirmPassword"><br>
			</p>
			<p style="margin-right:5%">
			Contact E-mail: <input type="text" name="Email"><br>
			</p>
		</div>
        <p style="text-align:center">
        Please agree to the following terms of use for the system:
        <div style="height:120px;width:60%;margin-left:25% ;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
            <h3>Anti-Piracy & Confidentiality Policy and Agreement</h3>
            It is of utmost importance for MediaVault to safeguard our client studios and production companies information. Our good working relationship with our clients hinges on our commitment to protect their interests.
                As a signed background actor with MediaVault , you are prohibited to use, publish, email, reproduce, disclose, furnish, reveal, communicate, transfer or make accessible to any other person for any purpose any information that you encounter, acquire or learn about in connection with your employment on a client project that the client has not given you written authorization to disclose or made available to the public, except as needed in the course of your employment on the clients project and for the benefit of the client.
                    Protected information of our clients that you may receive in connection with employment on a project includes those you may encounter in scripts, script pages, story lines, information regarding cast, crew, or other client studio or production company employees or representatives, production notes or logs, shooting schedules or call sheets, or “behind the scenes” information about the project or individuals or entities affiliated with the project. You may not take home any hard copies of these items.
                    Moreover, in the course of your employment with MediaVault, you will acquire or receive information that is treated as private and confidential by MediaVault. These private and confidential information include but are not limited to personal contact information for MediaVaults casting directors or client personnel (such as assistant directors in charge for background actors) or any other information that you may encounter through your employment relationship with MediaVault that MediaVault has not made available to the public. You are prohibited from disclosing, reproducing, emailing, using, releasing, or otherwise making accessible to any other person for any purpose any information treated as private and confidential by MediaVault except as needed to interact with representatives of MediaVault or the client to obtain or perform your employment on client projects through MediaVault.
                        This Anti-Piracy & Confidentiality Policy will be strictly enforced by MediaVault . Any violations of this Anti-Piracy & Confidentiality Policy will result in disciplinary action including termination of employment, invalidate registration and removal from roster from MediaVault and (2) full civil and/or criminal prosecution to the extent permitted by law.

        
        I Agree <input type="checkbox" name="Agreement"><br>
        </p>
        </div>
        <input type="submit" style="margin-left:50%">
		<br>
        </form>
        
        </body>
        </html>';
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
<button type="submit" formaction="login_form.php" style="margin-left:46%">Click here to return to main</button>
</form>
</body>
</html>