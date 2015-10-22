<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href="CSS/mainStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php 
		if ($_SESSION["username"] == ''){
			echo'
				<div id="_div_SBX">
					<div id="_div_SBX_MSG">
						<p>You are not logged in to log out!</p>
						<p>Redirecting to Log In...</p>
						<img id="_div_LDG_IMG" src="images/loading.fw.png">
					</div>
				</div>';
		} else {
			$_SESSION["username"] = "";
			echo'
				<div id="_div_SBX">
					<div id="_div_SBX_MSG">
						<p>You are now logged out!</p>
						<p>Redirecting to Log In...</p>
						<img id="_div_LDG_IMG" src="images/loading.fw.png">
					</div>
				</div>';
		}
		
		header('Refresh: 2; URL=login_form.php');
	?>
</body>