<?php

	include("connect.php");  
	# Connect to the database

	$conn = db_connect();
	if ($_POST['usr_ACT'] == "no") {
		$placeMake = 'userForm.php';
	} else {
		$query = "DELETE FROM tableUsers WHERE columnID =".$_POST['usr_IDS'];
		mysqli_query($conn, $query);
		$placeMake = 'userForm.php';
		
		$queryFiles = "SELECT * FROM tableFiles WHERE userID =".$_POST['usr_IDS'];
		$queryResultFiles = mysqli_query($conn, $queryFiles) or die('Error connecting to database') ;
		while ($row = mysqli_fetch_array($queryResultFiles)) {
			$filename = "/var/www/html/".$row['columnFileURL'];
			$query = "DELETE FROM tableFiles WHERE columnID =".$row['columnID'];
			mysqli_query($conn, $query);
			unlink($filename); 
		} 
	}
	/*$filename = "/var/www/html/".$_POST['fle_NME'];
	
	unlink($filename);
	mysqli_query($conn, $query);
		$placeMake = 'userForm.php';
	}*/
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