<?php
    // Start the session
    session_start();
?>

<?php

include("connect.php"); 
# Connect to the database


$conn = db_connect();

if (isset($_POST['fileID']) && isset($_POST['fileName']) && isset($_POST['fileType'])) {

	$sql = "UPDATE tableFiles SET columnName='".$_POST['fileName']."' WHERE columnID=".$_POST['fileID'];

	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
	} else {
		//echo "Error updating record: " . $conn->error;
	}

	$sql = "UPDATE tableFiles SET columnType='".$_POST['fileType']."' WHERE columnID=".$_POST['fileID'];

	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
	} else {
		//echo "Error updating record: " . $conn->error;
	}
	
	echo '<script type="text/javascript">'
	   , 'parent.updateFileStuff();'
	   , '</script>'
	;
}
	//header("Refresh:0");
	
	/*if(isset($_POST['delete'])){
    $queryDelete = "DELETE FROM tableFiles WHERE columnID=".$_POST['fileID'];
	$filename = "/var/www/html/uploads/{$_POST['fileName']}";
	echo $filename;
	if (unlink($filename)) {
		mysqli_query($conn, $queryDelete);
        echo 'File <strong>'.$filename.'</strong>has been deleted.';
        } else {
            echo 'File cannot be deleted.';
        }
    }*/

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
	File Details 
	</p>
	
	<div id="_div_FTR_BOX">
		Filename: <attributeThing id="ATT_NME"> </attributeThing>
	<p>
		File Type: <attributeThing id="ATT_TYP"> </attributeThing>
	<p>
		Date Added: <attributeThing id="ATT_DTE"> </attributeThing>
	<br>
	</div>
	<div id="_div_FTR_BOX_VEW">
		<input id="_inp_BTN_2" type="submit" onclick= "clicked()" value="View Online">  
		<input id="_inp_BTN_2" type="submit" onclick=downloadStuff() value="Download">
	</div>	
	
	
	<form id="fileForm" action=fileForm.php method=post>
		<input name="fileName" type="hidden" id="_inp_TXT_2">
	
	
	<input type="hidden" name="fileID" >
	
	<input type="hidden" name="fileType" >
	<div id = 'fileId2'></div>	
	
	<form id="deleteForm" action=deleteFile.php method=post>
	<input name="fle_NME" type="hidden">
	<input name="fle_IDS" type="hidden">
	<input name="fle_ACT" type="hidden">
	</form>
	</div>
	<iframe id="my_iframe" style="display:none;"></iframe>
	
	
	
	
	
	
	
	
	
	
<script>
	var UserNames = [];
<?php
	$queryUsers = "SELECT * FROM tableUsers";
	$queryResultUsers = mysqli_query($conn, $queryUsers) or die('Error connecting to database') ;
	while ($row = mysqli_fetch_array($queryResultUsers )) {
?>
		UserNames[<?php echo $row['columnID'] ?>] = <?php echo "'".$row['columnFullName']."'" ?>;
<?php 
	} 
?>

	var FLE_NME_TAKE = "";
	
	function downloadStuff() {
		var win = window.open(FLE_NME_TAKE, '_blank');
		win.focus();
	}
	
	function deleteConfirmation() {
		if (confirm("Confirm that you wish to delete this file")) {
			document.deleteForm.submit();
			document.getElementsByName("fle_ACT")[0].value = "yes";
		} else {
			document.getElementsByName("fle_ACT")[0].value = "no";
		}
	}

	function setAttributesOf(IDS,Name,Type,Time,Colr,Rname,User) {
		document.getElementById("ATT_NME").innerHTML = Name;
		document.getElementById("ATT_TYP").innerHTML = Type;
		document.getElementById("ATT_DTE").innerHTML = Time;
		document.getElementById("_inp_TXT_2").value = Name;
		document.getElementsByName("fileID")[0].value = IDS;
		document.getElementById("fileId2").value = Rname;
		document.getElementsByName("fle_IDS")[0].value = IDS;
		document.getElementsByName("fle_NME")[0].value = Rname;
		document.getElementsByName("fileType")[0].value = Colr;
		FLE_NME_TAKE = Rname;
		document.getElementById("ATT_USR").innerHTML = User;
		tagColSetDifferent(Colr);
	}

	function tagColSetDifferent(col) { 
		for (i = 0; i <= 8; i ++) {
			document.getElementsByName("INP_COL")[i].className = "_N_SEL";
		}
		filterCOL = col;
		document.getElementsByName("INP_COL")[col].className = "_SEL";
	}
 
	function tagColSet(col,item) { 
		for (i = 0; i <= 8; i ++) {
			document.getElementsByName("INP_COL")[i].className = "_N_SEL";
		}
		filterCOL = col;
		item.className = '_SEL';
		document.getElementsByName("fileType")[0].value = col;
	}
 
	function alertNotYet() {
		window.alert("This feature has not yet been implemented. Stick around for the second release.");
	}
	// Shows the div in index.html that houses the viewing of content
	// Changes the content of the div in index.html to be the currently viewed file 
	function clicked(){
		// Reset the content div
		window.top.document.getElementById("popImage").src = ("");
		
		// Write values to console for testing purposes
		console.log(document.getElementById("ATT_TYP").innerHTML);
		console.log(document.getElementById("ATT_NME").innerHTML);
		console.log(document.getElementById("ATT_DTE").innerHTML);
		console.log(document.getElementById("_inp_TXT_2").value);
		console.log(document.getElementsByName("fileID")[0].value);
		console.log(document.getElementsByName("fileType")[0].value);

		// window.top references the top level of the iframe which is index.html
		function Show(Type){
			if (Type != 'Video'){
				window.top.document.getElementById("popVideo").width = ("0");
				window.top.document.getElementById("popVideo").height = ("0");
			} else {
				window.top.document.getElementById("popVideo").width = ("500");
				window.top.document.getElementById("popVideo").height = ("500");
			}
			window.top.document.getElementById('light').style.display='block';
			window.top.document.getElementById('fade').style.display='block';
		}

		//	window.top.document.getElementById('light').style.display='block';
		//	window.top.document.getElementById('fade').style.display='block';
		if (document.getElementById("ATT_TYP").innerHTML == "\".jpg\" file type" || document.getElementById("ATT_TYP").innerHTML == "\".png\" file type" || document.getElementById("ATT_TYP").innerHTML == "\".gif\" file type" 
			|| document.getElementById("ATT_TYP").innerHTML == "\".jpeg\" file type" || document.getElementById("ATT_TYP").innerHTML == "\".bmp\" file type"){
			console.log("This is an image");
			window.top.document.getElementById("popImage").src = (fileId2.value);
			Show('Image');
		} else if (document.getElementById("ATT_TYP").innerHTML == "\".mp4\" file type") {
			console.log("This is an video");
			window.top.document.getElementById("popVideo").src = (fileId2.value);
			Show('Video');
		} else {
			Show('Blank');	
		}
		//	window.top.document.getElementById("popImage").src = (fileId2.value);
	}
</script>