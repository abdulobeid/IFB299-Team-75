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

<div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
	<img id = 'popImage' src = '#' alt='error' width='100%'></img>
	</div>
<div id="fade" class="black_overlay"></div>

		<?php
			if ($_SESSION["username"] == ''){
				echo '
				<div id="_div_SBX">
					<form action="login.php" method="post">
						<p>
						<h1>Log In</h1>
						</p>
						
						<p>
						Please enter your details below...
						</p>
						
						<p>
						Username:
						<input id="_inp_TXT" type="text" name="Username" value="'.$_SESSION["busername"].'"> <error>'.$_SESSION["berror"].'</error>
						</p>
						 
						<p>
						Password:
						<input id="_inp_TXT" type="password" name="Password" value="'.$_SESSION["bpassword"].'"> <error>'.$_SESSION["berror"].'</error>
						</p>
						
						<p>
						<input id="_inp_BTN" type="submit" value="Submit">
						</p>
					</form>
				</div>
				<div id="_div_SIN">
					<div id="_div_SLF">
					<p>
						<form action="registration_form.php">
						<input id="_inp_BTN" type="submit" value="Register Account">
						</form>
					</p>
					</div>
					<div id="_div_SRG">
					<p>
						<form action="recover_password.php">
						<input id="_inp_BTN" type="submit" value="Forgot Password?">
						</form>
					</p>
					</div> 
				</div>
				';
				
			} else {
				echo '
				<div id="_div_BCN">
					<div id="_div_BBL">
					<p>
					Welcome '.$_SESSION["username"].'
					</p>
					<p>
					<input id="_inp_BTN" type="button" value="Upload a File" onclick="UploadFrame();">
					</p>
					<p>
					<input id="_inp_BTN" type="button" value="File Browser" onclick="changeToFileBrowser();">
					</p>
					<p>
					<input id="_inp_BTN" type="button" value="News Feed" onclick="alertNotYet();">
					</p>
					<p>
					<input id="_inp_BTN" type="button" value="Friends List" onclick="alertNotYet();">
					</p>
					<p>
					<input id="_inp_BTN" type="button" value="Settings" onclick="alertNotYet();">
					</p>
					<form action="logout.php">
					<p>
					<input id="_inp_BTN" type="submit" value="Log Out">
					</p>
					</form>
					</div> 
					
					<div id="_div_BBM">
						<p>
						My Files
						</p>
						<iframe id="_div_CTT_MID" onload=setFileForm() src="formPopulateFilter.php"></iframe>
					</div> 
					
					<div id="_div_BBR">
						<iframe id="_div_CTT_RGT" src="filterForm.php"></iframe>
					</div> 
				</div>
				';
			}
		?>
</body>
</html>

<script>
var attName = "";
var attType = "";
var attTime = "";
var attColr = "";
var filterCOL = "8";
var filterFLE = "NNE";
var attIDS = "";
var attSelFile = "-1";
var attRName = "";
 
function launchFileForm(Tickers,IDS,Name,Type,Time,Colr,RName){ 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" onload=setFileForm() src="fileForm.php"></iframe>';
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr;
	attSelFile = Tickers;
	attRName = RName;
 }
 
 function reloadFileForm(Tickers,IDS,Name,Type,Time,Colr,RName){ 
	//document.getElementById("_div_CTT_RGT").contentWindow.location.reload();
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr; 
	attSelFile = Tickers;
	attRName = RName;
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName);
 }
 
 function setFileForm(){ 
	document.getElementById("_div_CTT_MID").contentWindow.setFileSel(attSelFile);
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName);
 }
 

  // Filter stuff
 function sendParameters(filterDD,filterMM,filterYYYY,filterTXT,filterFLE,filterCOL) {
	 document.getElementById("_div_CTT_MID").contentWindow.alertEM(filterDD,filterMM,filterYYYY,filterTXT,filterFLE,filterCOL);
 }
 
function launchFilterForm() { 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="filterForm.php"></iframe>';
 }
 
 function updateFileStuff(fileI) {
	 document.getElementById("_div_CTT_MID").contentWindow.location.reload();
	 document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName);
 }
 
  function updateFileFormStuff(Tickers,IDS,Name,Type,Time,Colr,RName) {
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr;
	attSelFile = Tickers;
	attRName = RName;
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName);
 }
 
 function UploadFrame() {
 document.getElementById("_div_BBM").innerHTML = '<p>My Files</p> <iframe id="_div_CTT_MID" src="upload_form.php"></iframe>';
 }
 
 function alertReload() {
	 document.getElementById("_div_CTT_MID").contentWindow.location.reload();
 }
 
 function alertNotYet() {
	 window.alert("This feature has not yet been implemented. Stick around for the second release.");
 }
 
 function changeToFileBrowser() {
	 //document.getElementById("_div_CTT_MID").contentWindow.location.reload();
	 document.getElementById("_div_BBM").innerHTML = '<p>My Files</p> <iframe id="_div_CTT_MID" src="formPopulateFilter.php"></iframe>';
 }
</script>

