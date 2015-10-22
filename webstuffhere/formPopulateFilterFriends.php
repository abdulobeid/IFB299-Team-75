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
	<link href="CSS/filterStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

include("connect.php"); 
# Connect to the database

$conn = db_connect();
    
$queryAdd = "";
$queryStandIn = " WHERE ";


// Get the friends and store them in an array

$tickerUserFind = 0;

$query = "SELECT * FROM tableFriends WHERE columnUserID1 = " . $_SESSION["userID"];

$queryresult = mysqli_query($conn, $query) or die('Error connecting to database1') ;

while ($row = mysqli_fetch_array($queryresult)) {
	$UserFriendCodes[$tickerUserFind] = $row['columnUserID2'];
	$tickerUserFind ++;
}

$query = "SELECT * FROM tableFriends WHERE columnUserID2 = " . $_SESSION["userID"];

$queryresult = mysqli_query($conn, $query) or die('Error connecting to database2') ;

while ($row = mysqli_fetch_array($queryresult)) {
	$UserFriendCodes[$tickerUserFind] = $row['columnUserID1'];
	$tickerUserFind ++;
}

/*
$query = "SELECT * FROM tableUsers WHERE " . $queryAdd ;

$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$query = "SELECT * FROM tableUsers WHERE";

$countUsers = count($UserFriendCodes);

for ($i = 0; $i < $countUsers; $i ++) {
	$query = $query . $queryAdd . " columnID = " . $UserFriendCodes[$i];
	$queryAdd = " OR ";
}
if ($countUsers != 0) {

$queryresult = mysqli_query($conn, $query) or die('Error connecting to database3'.$countUsers) ;
}

echo '<div id="_div_BBM_FLB" onmouseover="mouseOverFile('."'-1'".')"  onclick="mouseClickFile('."'-1'".')" >';

$ticker = 0;

while ($row = mysqli_fetch_array($queryresult)) {
	$ticker ++;
	$cStr = $row['columnFullName'];
	echo '<div id="_div_FLE" name="'.$ticker.'" onmouseover="mouseOverFile('."'".$ticker."'".')"  onclick="mouseClickFile('."'".$ticker."'".')">';
   echo "<form action=formPopulateFilter.php method=post>";
   
   $cStrLen = strlen($cStr);
   
   
	echo '<img id="_div_FLE_IMG" src="images/user.fw.png"><p>';
	echo $cStr;
	echo "</form>";
	echo '</div>';
	$arrayUserTickers[$ticker] = $ticker;
	$arrayUserIDS[$ticker] = $row['columnID'];
	$arrayUserNames[$ticker] = $row['columnUsername'];
	$arrayUserFullNames[$ticker] = $row['columnFullName'];
	$arrayUserEmails[$ticker] = $row['columnEmail'];
}

echo '</div>';


if(isset($_POST['delete'])){
    $queryDelete = "DELETE FROM tableUsers WHERE columnID='$_POST[hidden]'";
	$filename = "/var/www/html/uploads/{$_POST[Name]}";
	echo $filename;
	if (unlink($filename)) {
		mysqli_query($conn, $queryDelete);
        echo 'File <strong>'.$filename.'</strong>has been deleted.';
	} else {
		echo 'File cannot be deleted.';
	}
}

?>

















<script>
var b = false;
var selected = -1;

var Tickers = [];
var IDS = []; 
var UserNames = [];
var UserFullNames = [];
var UserEmails = [];
	
	var a = <?php echo $ticker; ?>;
	<?php $ticker2 = 0; 
	for ($i = 1; $i<= $ticker; $i ++) { ?>
		<?php $ticker2 ++; ?>
		Tickers[<?php echo $i?>] = <?php echo "'".$arrayUserTickers[$ticker2]."';"; ?>
		IDS[<?php echo $i?>] = <?php echo "'".$arrayUserIDS[$ticker2]."';"; ?>
		UserNames[<?php echo $i?>] = <?php echo "'".$arrayUserNames[$ticker2]."';"; ?>
		UserFullNames[<?php echo $i?>] = <?php echo "'".$arrayUserFullNames[$ticker2]."';"; ?>
		UserEmails[<?php echo $i?>] = <?php echo "'".$arrayUserEmails[$ticker2]."';"; ?>
	<?php } ?>
	
	
	
	
function mouseClickFile(item) { 
	
	if (item != "-1") {
		for (i = 1; i <= a; i ++) {
			document.getElementsByName(i)[0].id = "_div_FLE";
		}
		b = true;
		 document.getElementsByName(item)[0].id = "_div_FLE_2";
		 selected = item;
		 parent.launchFriendForm(Tickers[selected],IDS[selected],UserNames[selected],UserFullNames[selected],UserEmails[selected]);
	} else {
		if (b == true) {
			b = false;
		} else {
			for (i = 1; i <= a; i ++) {
				document.getElementsByName(i)[0].id = "_div_FLE";
			}
			selected = -1;
			parent.launchFriendAddForm();
		}
	}
}

function mouseOverFile(item) { 
	var a = <?php echo $ticker; ?>;
	if (item != "-1") {
		for (i = 1; i <= a; i ++) {
			if (i != selected) {
				document.getElementsByName(i)[0].id = "_div_FLE";
				}
		}
		b = true;
		if (item != selected) {
			document.getElementsByName(item)[0].id = "_div_FLE_3";
		}
	} else {
		if (b == true) {
			b = false;
		} else {
			for (i = 1; i <= a; i ++) {
				if (i != selected) {
				document.getElementsByName(i)[0].id = "_div_FLE";
				}
			}
		}
	}
}

function setUserSel(selectedI) {
	document.getElementsByName(selectedI)[0].id = "_div_FLE_2";
	selected = selectedI;
	
	parent.reloadUserForm(Tickers[selected],IDS[selected],UserNames[selected],UserFullNames[selected],UserEmails[selected]);
}


</script> 

</body>
</html>
