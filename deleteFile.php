<?php

    session_start();	
	//$config = parse_ini_file('../../../config.ini');
	//$dbConnection = mysqli_connect('localhost', $config['username'],$config['password'],$config['dbname']); 
	
	include("connect.php");  
	# Connect to the database
	
	$user = $_SESSION["userID"];
	$objectName = $_POST['fle_NME'];
	$sqldate = date("Y-m-d H:i:s");
	$feedStatus = "removed " . $objectName . " from the vault.";
	$sql_feed = "INSERT INTO tableFeed (columnUserID, columnStatus, columnDate) VALUES ('$user', '$feedStatus', '$sqldate')";
	
	$conn = db_connect();
	if ($_POST['fle_ACT'] == "no") {

		$placeMake = 'fileForm.php';
	} else {
			$conn->query($sql_feed);		
			$query = "DELETE FROM tableFiles WHERE columnID =".$_POST['fle_IDS'];
			
	$filename = "/var/www/html/".$_POST['fle_NME'];

	
	unlink($filename);
	mysqli_query($conn, $query);
		$placeMake = 'filterForm.php';
	}
?>

<script> 
	window.onload = function() {
	  refreshOther();
	};


	function refreshOther() { 
		var place = <?php echo "'".$placeMake."'" ?>;
		parent.alertReload();
		window.location.href = place;
	}	
</script>;