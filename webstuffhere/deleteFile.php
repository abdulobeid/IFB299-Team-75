<?php


	
	//$config = parse_ini_file('../../../config.ini');
	//$dbConnection = mysqli_connect('localhost', $config['username'],$config['password'],$config['dbname']); 
	
	include("connect.php");  
	# Connect to the database


	$conn = db_connect();
	if ($_POST['fle_ACT'] == "no") {

		$placeMake = 'fileForm.php';
	} else {
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