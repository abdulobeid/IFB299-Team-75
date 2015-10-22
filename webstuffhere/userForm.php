<?php
    // Start the session
    session_start();
?>

<?php

include("connect.php"); 
# Connect to the database


$conn = db_connect();

if (isset($_POST['userName']) && isset($_POST['userFullName']) && isset($_POST['userEmail'])) {

	$sql = "UPDATE tableUsers SET columnUsername='".$_POST['userName']."' WHERE columnID=".$_POST['userID'];

	if ($conn->query($sql) === TRUE) {} else {}

	$sql = "UPDATE tableUsers SET columnFullName='".$_POST['userFullName']."' WHERE columnID=".$_POST['userID'];

	if ($conn->query($sql) === TRUE) {} else {}
	
	$sql = "UPDATE tableUsers SET columnEmail='".$_POST['userEmail']."' WHERE columnID=".$_POST['userID'];

	if ($conn->query($sql) === TRUE) {} else {}
	
	echo '<script type="text/javascript">'
	   , 'parent.updateUserStuff();'
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
		User Editing
	</p>
	<form id="fileForm" action=userForm.php method=post>
	<div id="_div_FTR_BOX">
		Update Username:
		<p>
		<input name="userName" id="_inp_TXT_2">
	</div>
	
	<div id="_div_FTR_BOX">
		Update Full Name:
		<p>
		<input name="userFullName" id="_inp_TXT_3">
	</div>
	
	<div id="_div_FTR_BOX">
		Update Email:
		<p>
		<input name="userEmail" id="_inp_TXT_4">
	</div>
	
	<input type="hidden" name="userID" >
	
	<input type="hidden" name="fileType" >
	<input id="_inp_BTN_2" type="submit" value="Save Details">
	</form>
	<div id = 'fileId2'></div>	
	
	<form id="deleteForm" action=deleteUser.php method=post>
	<input name="usr_IDS" type="hidden">
	<input name="usr_ACT" type="hidden">
	<input id="_inp_BTN_DELETE" type="submit" onclick=deleteConfirmation() value="Delete User">
	</form>
	</div>
	<iframe id="my_iframe" style="display:none;"></iframe>
>

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
		if (confirm("Confirm that you wish to delete this user")) {
			document.deleteForm.submit();
			document.getElementsByName("usr_ACT")[0].value = "yes";
		} else {
			document.getElementsByName("usr_ACT")[0].value = "no";
		}
	}
	
	function setAttributesOf(attuIDS,attuUser,attuName,attuEmail) {
		document.getElementById("_inp_TXT_2").value = attuUser;
		document.getElementById("_inp_TXT_3").value = attuName;
		document.getElementById("_inp_TXT_4").value = attuEmail;
		document.getElementsByName("userID")[0].value = attuIDS;
		
		document.getElementsByName("usr_IDS")[0].value = attuIDS;
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
		console.log(document.getElementsByName("userID")[0].value);
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
