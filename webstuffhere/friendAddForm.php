<?php
    // Start the session
    session_start();
	
	include("connect.php"); 
	# Connect to the database

	$errorText = "";

	$conn = db_connect();

	if (isset($_POST['userName'])) {
		
		// Get the user ID of the entered user
		$query = "SELECT * FROM tableUsers WHERE columnUsername = '".$_POST['userName']."'";

		$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;
		$searchUSERID = -1;
		
		while ($row = mysqli_fetch_array($queryresult)) {
			$searchUSERID = $row['columnID'];
		}
		
		if ($searchUSERID == -1) {
			$errorText = "The username you entered wasn't found in the system.";
		}
		
		// Get the user ID list of all befriended users
		
		$tickerUserFind = 0;
		
		$query = "SELECT * FROM tableFriends WHERE columnUserID1 = " . $_SESSION["userID"];

		$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

		while ($row = mysqli_fetch_array($queryresult)) {
			$UserFriendCodes[$tickerUserFind] = $row['columnUserID2'];
			$tickerUserFind ++;
		}

		$query = "SELECT * FROM tableFriends WHERE columnUserID2 = " . $_SESSION["userID"];

		$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

		while ($row = mysqli_fetch_array($queryresult)) {
			$UserFriendCodes[$tickerUserFind] = $row['columnUserID1'];
			$tickerUserFind ++;
		}

		$countUsers = count($UserFriendCodes);

		$dontProceed = false;
		
		for ($i = 0; $i < $countUsers; $i ++) {
			if ($searchUSERID == $UserFriendCodes[$i]) {
				$dontProceed = true;
				$errorText = "You already have this user as a friend.";
			}
		}
		
		if ((!$dontProceed) && $searchUSERID != -1) {
			
			
			
			
			$sql = "INSERT INTO `databaseMediaVault`.`tableFriends` (`columnID`, `columnUserID1`, `columnUserID2`) VALUES (NULL, '".$_SESSION["userID"]."', '".$searchUSERID."')";

			if ($conn->query($sql) === TRUE) {
				// Record updated successfully
			} else {
				//echo "Error updating record: " . $conn->error;
			}
			
			
		
			echo '<script type="text/javascript">'
			   , 'parent.alertReload();'
			   , '</script>'
			;
		}
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
	Add A Friend
	</p>
	<form action=friendAddForm.php method=post>
	<div id="_div_FTR_BOX">
	Enter their username here:
	<p>
	<input name="userName" id="_inp_TXT_2">
	<p>
	<error><?php echo $errorText; ?></error>
	</p>
	</div>
	<input id="_inp_BTN_2" type="submit"  value="Add Friend">
	</form>
	</div>
</body>

<script>
var commonFileID = "dsadasddsad";
var filterDD = "";
var filterMM = "";
var filterYYYY = "";
var filterCOL = "8";
var filterTXT = "";
var filterFLE = "NNE";
//onclick="mouseOverThisThing()"
 function mouseOverThisThing() { 
	window.alert(commonFileID);
 }
 
 function tagColSet(col,item) { 
	for (i = 0; i <= 8; i ++) {
		document.getElementsByName("INP_COL")[i].className = "_N_SEL";
	}
	filterCOL = col;
	item.className = '_SEL';
 }
 
 function tagFleTyp(fle,item) { 
	
	for (i = 0; i <= 5; i ++) {
		document.getElementsByName("INP_FLE")[i].className = "_N_SEL";
	}
	filterFLE = fle;
	item.className = '_SEL';
 }
</script>