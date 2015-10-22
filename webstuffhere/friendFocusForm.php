<?php
    // Start the session
    session_start();

include("connect.php"); 
# Connect to the database


$conn = db_connect();

if (isset($_POST['_f_D'])) {

	$sql = "DELETE FROM tableFriends WHERE columnUserID1 = ".$_POST['_f_D']." AND columnUserID2 = ".$_SESSION["userID"];
	
	if ($conn->query($sql) === TRUE) {} else {}
	
	$sql = "DELETE FROM tableFriends WHERE columnUserID1 = ".$_SESSION["userID"]." AND columnUserID2 = ".$_POST['_f_D'];
	
	if ($conn->query($sql) === TRUE) {} else {}
	
	echo '<script type="text/javascript">'
		, 'parent.alertReload();'
	   , 'parent.launchFriendAddForm();'
	   , '</script>'
	;
}

if (isset($_POST['_f_VF'])) {
	$_SESSION["userInsight"] = $_POST['_f_VF'];
	echo '<script type="text/javascript">'
	   , 'parent.launchInsightUser();'
	   , '</script>'
	;
}
?>

<html>
<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="CSS/mainStyles.css" rel="stylesheet" type="text/css" />
	<link href="CSS/filterStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>			
<div id="_div_BBR_IFR">
	<p>
	Friend Details
	</p>
	<div id="_div_FTR_BOX">
	<p>
	Username: <stuff id="f_usrNMT"></stuff>
	</p>
	<p>
	Full Name: <stuff id="f_fllNMT"></stuff>
	</p>
	<p>
	Email Address: <stuff id="f_emlNMT"></stuff>
	</p>
	</div>
	
	<div id="_div_FTR_BOX_VEW">
		<form action=friendFocusForm.php method=post>
		<p>
		<input id="_f_VF" name="_f_VF" type="hidden" value="-1">
		<input id="_inp_BTN_2" type="submit" onclick="ViewFriendFiles()" value="View Friend's Files">
		</p>
		</form>
	</div>
	
	<div id="_div_FTR_BOX_VEW">
		<form action=friendFocusForm.php method=post>
		<p>
		<input id="_f_D" name="_f_D" type="hidden">
		<input id="_inp_BTN_DELETE" type="submit" value="Remove Friend">
		</p>
		</form>
	</div>
	
</body>

<script>
function setAttributesOf(attuIDS,attuUser,attuName,attuEmail) {
	document.getElementById("f_usrNMT").innerHTML = attuUser;
	document.getElementById("f_fllNMT").innerHTML = attuName;
	document.getElementById("f_emlNMT").innerHTML = attuEmail;
	document.getElementById("_f_D").value = attuIDS;
	document.getElementById("_f_VF").value = attuIDS;
}
</script>