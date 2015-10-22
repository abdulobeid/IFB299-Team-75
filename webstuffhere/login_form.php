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
					<div id="_div_BBL">';
						if(isset($_SESSION["userID"]) && $_SESSION["userID"] == 35){ 
							echo '<input id="_inp_BTN" type="button" value="User Browser" onclick="UserFrame();">'; 
							}
							
					echo 
					'
					
					<input id="_inp_BTN" type="button" value="Upload a File" onclick="UploadFrame();">
					<input id="_inp_BTN" type="button" value="File Browser" onclick="changeToFileBrowser();">
					<input id="_inp_BTN" type="button" value="News Feed" onclick="NewsFeedFrame();">
					<input id="_inp_BTN" type="button" value="Friends" onclick="FriendsFrame();">
					<input id="_inp_BTN" type="button" value="Settings" onclick="alertNotYet();">
					<form action="logout.php">
					<input id="_inp_BTN_L" type="submit" value="Log Out"></form>
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
var attUser = "";

var attuSelUser = "";
var attuIDS = "";
var attuUser = "";
var attuName = "";
var attuEmail = "";

function launchFileFormIns(Tickers,IDS,Name,Type,Time,Colr,RName,User){ 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" onload=setFileForm() src="fileFormIns.php"></iframe>';
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr;
	attSelFile = Tickers;
	attRName = RName;
	attUser = User;
 }

 function reloadFileFormIns(Tickers,IDS,Name,Type,Time,Colr,RName,User){ 
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr; 
	attSelFile = Tickers;
	attRName = RName;
	attUser = User;
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName,attUser);
 }





 
function launchFileForm(Tickers,IDS,Name,Type,Time,Colr,RName,User){ 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" onload=setFileForm() src="fileForm.php"></iframe>';
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr;
	attSelFile = Tickers;
	attRName = RName;
	attUser = User;
 }
 
function launchUserForm(Tickers,IDS,UserNames,UserFullNames,UserEmails){ 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" onload=setUserForm() src="userForm.php"></iframe>';
	attuSelUser = Tickers;
	attuIDS = IDS;
	attuUser = UserNames;
	attuName = UserFullNames;
	attuEmail = UserEmails;
 }
 
 function launchFriendForm(Tickers,IDS,UserNames,UserFullNames,UserEmails){ 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" onload=setFriendForm() src="friendFocusForm.php"></iframe>';
	attuSelUser = Tickers;
	attuIDS = IDS;
	attuUser = UserNames;
	attuName = UserFullNames;
	attuEmail = UserEmails;
 }
 
 
 function reloadFileForm(Tickers,IDS,Name,Type,Time,Colr,RName,User){ 
	//document.getElementById("_div_CTT_RGT").contentWindow.location.reload();
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr; 
	attSelFile = Tickers;
	attRName = RName;
	attUser = User;
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName,attUser);
 }
 
  function reloadUserForm(Tickers,IDS,UserNames,UserFullNames,UserEmails){ 
	//document.getElementById("_div_CTT_RGT").contentWindow.location.reload();
	attuSelUser = Tickers;
	attuIDS = IDS;
	attuUser = UserNames;
	attuName = UserFullNames;
	attuEmail = UserEmails;
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attuIDS,attuUser,attuName,attuEmail);
 }
 
 function setFileForm(){ 
	document.getElementById("_div_CTT_MID").contentWindow.setFileSel(attSelFile);
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName,attUser);
 }
 
  function setUserForm(){ 
	document.getElementById("_div_CTT_MID").contentWindow.setUserSel(attuSelUser);
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attuIDS,attuUser,attuName,attuEmail);
	
 }
 
 function setFriendForm(){ 
	document.getElementById("_div_CTT_MID").contentWindow.setUserSel(attuSelUser);
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attuIDS,attuUser,attuName,attuEmail);
	
 }

  // Filter stuff
 function sendParameters(filterDD,filterMM,filterYYYY,filterTXT,filterFLE,filterCOL) {
	 document.getElementById("_div_CTT_MID").contentWindow.alertEM(filterDD,filterMM,filterYYYY,filterTXT,filterFLE,filterCOL);
 }
 
function launchFilterForm() { 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="filterForm.php"></iframe>';
 }
 function launchNothingForm() { 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="nothing.php"></iframe>';
 }
 
 function launchFriendAddForm() { 
	document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="friendAddForm.php"></iframe>';
 }
 
 
 function updateFileStuff(fileI) {
	 document.getElementById("_div_CTT_MID").contentWindow.location.reload();
	 document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName,attUser);
 }
 
 function updateUserStuff(userI) {
	 document.getElementById("_div_CTT_MID").contentWindow.location.reload();
	 document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attuIDS,attuUser,attuName,attuEmail);
 }
 
  function updateFileFormStuff(Tickers,IDS,Name,Type,Time,Colr,RName,User) {
	attIDS = IDS;
	attName = Name;
	attType = Type;
	attTime = Time;
	attColr = Colr;
	attSelFile = Tickers;
	attRName = RName;
	attUser = User;
	document.getElementById("_div_CTT_RGT").contentWindow.setAttributesOf(attIDS,attName,attType,attTime,attColr,attRName,attUser);
 }
 
 function UploadFrame() {
 document.getElementById("_div_BBM").innerHTML = '<p>Upload a File</p> <iframe id="_div_CTT_MID" src="upload_form.php"></iframe>';
 document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="nothing.php"></iframe>';
 }
 
 function NewsFeedFrame() {
 document.getElementById("_div_BBM").innerHTML = '<p>News Feed</p> <iframe id="_div_CTT_MID" src="formPopulateFilterNewsFeed.php"></iframe>';
  document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="nothing.php"></iframe>';
 }
 
 function FriendsFrame() {
 document.getElementById("_div_BBM").innerHTML = '<p>Friends</p> <iframe id="_div_CTT_MID" src="formPopulateFilterFriends.php"></iframe>';
 document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="friendAddForm.php"></iframe>';
 }
 
 function UserFrame() {
 document.getElementById("_div_BBM").innerHTML = '<p>User Browser</p> <iframe id="_div_CTT_MID" src="formPopulateFilterUsers.php"></iframe>';
 document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="nothing.php"></iframe>';
 }
 
  function launchInsightUser() {
 document.getElementById("_div_BBM").innerHTML = "<p>Friend's Files</p> <iframe "+'id="_div_CTT_MID" src="formPopulateFilterInsight.php"></iframe>';
 document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="filterForm.php"></iframe>';
 }
 
 function alertReload() {
	 document.getElementById("_div_CTT_MID").contentWindow.location.reload();
 }
 
 function alertNotYet() {
	 window.alert("This feature has not yet been implemented. Stick around for the third release hehe ;D");
 }
 
 function changeToFileBrowser() {
	 //document.getElementById("_div_CTT_MID").contentWindow.location.reload();
	 document.getElementById("_div_BBM").innerHTML = '<p>My Files</p> <iframe id="_div_CTT_MID" src="formPopulateFilter.php"></iframe>';
	 document.getElementById("_div_BBR").innerHTML = '<iframe id="_div_CTT_RGT" src="filterForm.php"></iframe>';
 }
</script>

