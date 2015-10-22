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
$retainFilterType = 8;
$retainFilterWord = "";
$retainFilterDD = "";
$retainFilterMM = "";
$retainFilterYY = "";
$queryStandIn = " WHERE ";

if(isset($_SESSION["userInsight"])){
	if ($_SESSION["userInsight"] == 35) {
		//$queryAdd = $queryAdd . $queryStandIn . "userID = %";
	} else {
		$queryAdd = $queryAdd . $queryStandIn . "userID = ".$_SESSION["userInsight"];
		$queryStandIn = " AND ";
	}
    
    //$retainFilterYY = $filterYYTXT;
    
}    

if(isset($_POST['filterType']) && htmlspecialchars($_POST['filterType']) != "8"){
    $filterTypeINT = htmlspecialchars($_POST['filterType']);
    $queryAdd = $queryAdd . $queryStandIn . "columnType = " . $filterTypeINT;
    $retainFilterType = $filterTypeINT;
    $queryStandIn = " AND ";
}
    
if(isset($_POST['filterWord'])){
    $filterWordTXT = htmlspecialchars($_POST['filterWord']);
    $queryAdd = $queryAdd . $queryStandIn . "columnName LIKE '%" . $filterWordTXT . "%'";
    $retainFilterWord = $filterWordTXT;
    $queryStandIn = " AND ";
}
    
if(isset($_POST['filterDD']) && (htmlspecialchars($_POST['filterDD']) != '')){
    $filterDDTXT = htmlspecialchars($_POST['filterDD']);
    $queryAdd = $queryAdd . $queryStandIn . "SUBSTRING(CAST(columnCreated AS DATE),9,10) = " . $filterDDTXT;
    $retainFilterDD = $filterDDTXT;
    $queryStandIn = " AND ";
}
    
if(isset($_POST['filterMM']) && (htmlspecialchars($_POST['filterMM']) != '')){
    $filterMMTXT = htmlspecialchars($_POST['filterMM']);
    $queryAdd = $queryAdd . $queryStandIn . "SUBSTRING(CAST(columnCreated AS DATE),6,7) = " . $filterMMTXT;
    $retainFilterMM = $filterMMTXT;
    $queryStandIn = " AND ";
}
    
if(isset($_POST['filterYY']) && (htmlspecialchars($_POST['filterYY']) != '')){
    $filterYYTXT = htmlspecialchars($_POST['filterYY']);
    $queryAdd = $queryAdd . $queryStandIn . "SUBSTRING(CAST(columnCreated AS DATE),1,4) = " . $filterYYTXT;
    $retainFilterYY = $filterYYTXT;
    $queryStandIn = " AND ";
}

if(isset($_POST['filterFile']) && (htmlspecialchars($_POST['filterFile']) != '')){
    $filterFileTXT = htmlspecialchars($_POST['filterFile']);
	
	switch ($filterFileTXT) { 
		case 'PIC' : $textAdd = "(columnName LIKE '%.png%' OR columnName LIKE '%.jpeg%' OR columnName LIKE '%.jpg%' OR columnName LIKE '%.bmp%'".
								" OR columnName LIKE '%.svg%' OR columnName LIKE '%.gif%' OR columnName LIKE '%.psd%')"; break ;
		case 'TXT' : $textAdd = "(columnName LIKE '%.txt%' OR columnName LIKE '%.rtf%' OR columnName LIKE '%.doc%'".
								" OR columnName LIKE '%.docx%' OR columnName LIKE '%.pages%')"; break ;
		case 'VID' : $textAdd = "(columnName LIKE '%.avi%' OR columnName LIKE '%.flv%' OR columnName LIKE '%.wmv%'".
								" OR columnName LIKE '%.mov%' OR columnName LIKE '%.mp4%')"; break ;
		case 'MSC' : $textAdd = "(columnName LIKE '%.mp3%' OR columnName LIKE '%.aac%' OR columnName LIKE '%.m4a%'".
								" OR columnName LIKE '%.flac%' OR columnName LIKE '%.wav%' OR columnName LIKE '%.mid%' OR columnName LIKE '%.ogg%')"; break ;
		case 'UNK' : $textAdd = 
		"(columnName NOT LIKE '%.png%' AND columnName NOT LIKE '%.jpeg%' AND columnName NOT LIKE '%.jpg%' AND columnName NOT LIKE '%.bmp%' AND columnName NOT LIKE '%.svg%' AND columnName NOT LIKE '%.gif%' AND columnName NOT LIKE '%.psd%' ".
		"AND columnName NOT LIKE '%.txt%' AND columnName NOT LIKE '%.rtf%' AND columnName NOT LIKE '%.doc%' AND columnName NOT LIKE '%.docx%' AND columnName NOT LIKE '%.pages%' ".
		"AND columnName NOT LIKE '%.avi%' AND columnName NOT LIKE '%.flv%' AND columnName NOT LIKE '%.wmv%' AND columnName NOT LIKE '%.mov%' AND columnName NOT LIKE '%.mp4%' ".
		"AND columnName NOT LIKE '%.mp3%' AND columnName NOT LIKE '%.aac%' AND columnName NOT LIKE '%.m4a%' AND columnName NOT LIKE '%.flac%' AND columnName NOT LIKE '%.wav%' AND columnName NOT LIKE '%.mid%' AND columnName NOT LIKE '%.ogg%')"
		; break;
		case 'NNE' : $textAdd = "columnName LIKE '%'";;
	}
	
	$queryAdd = $queryAdd . $queryStandIn . $textAdd;
    $queryStandIn = " AND ";
}



$query = "SELECT * FROM tableFiles" . $queryAdd ;
//echo $query;
$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

    
    //selected="selected"
	
/*
echo '
    
    <form action=formPopulateFilter.php method=post>
    <p>
    <label for="filterType">Type:</label>
    <select name="filterType">';
    
    for ($i = 0; $i <= 8; $i ++) {
        
        echo '<option value="'.$i.'"';
        
        if ($retainFilterType == $i) {
            echo ' selected="selected"';
        }
        
        switch ($i) {
            case 0 : echo '>RED</option>'; break ;
            case 1 : echo '>ORANGE</option>'; break ;
            case 2 : echo '>YELLOW</option>'; break ;
            case 3 : echo '>GREEN</option>'; break ;
            case 4 : echo '>AQUA</option>'; break ;
            case 5 : echo '>NAVY</option>'; break ;
            case 6 : echo '>PURPLE</option>'; break ;
            case 7 : echo '>PINK</option>'; break ;
            case 8 : echo '>NONE</option>'; break ;
        }
    }
    
   echo '</select>';
 
    echo
    '
    <label for="filterDD">DD:</label>
    <input type="text" name="filterDD" maxlength="2" size="2" value='.$retainFilterDD.' >
    <label for="filterMM">MM:</label>
    <input type="text" name="filterMM" maxlength="2" size="2" value='.$retainFilterMM.' >
    <label for="filterYY">YYYY:</label>
    <input type="text" name="filterYY" maxlength="4" size="4" value='.$retainFilterYY.' >
    </p>
    <p>
    <label for="filterWord">Sub-String:</label>
    <input type=text name="filterWord" value='.$retainFilterWord.' >
    <button type=submit>Filter</button>
    </p>';*/
 
//echo "<table>";
//echo "<tr><th>Folder</th><th>File</th><th>Uploaded</th><th>Type</th></tr>";



















echo '<div id="_div_BBM_FLB" onmouseover="mouseOverFile('."'-1'".')"  onclick="mouseClickFile('."'-1'".')" >';

$ticker = 0;

while ($row = mysqli_fetch_array($queryresult)) {
	$ticker ++;
	$cStr = $row['columnName'];
	echo '<div id="_div_FLE" name="'.$ticker.'" onmouseover="mouseOverFile('."'".$ticker."'".')"  onclick="mouseClickFile('."'".$ticker."'".')">';
   echo "<form action=formPopulateFilter.php method=post>";
   
   $cStrLen = strlen($cStr);
   
   switch (substr($cStr, strrpos($cStr,'.'),$cStrLen-1)) {
	   case '.png' : $fType = 'picture'; break; // Accepted Image Files
	   case '.jpeg' : $fType = 'picture'; break;
	   case '.jpg' : $fType = 'picture'; break;
	   case '.bmp' : $fType = 'picture'; break;
	   case '.svg' : $fType = 'picture'; break;
	   case '.gif' : $fType = 'picture'; break;
	   case '.psd' : $fType = 'picture'; break;
	   
	   case '.txt' : $fType = 'text'; break; // Accepted Text Files
	   case '.rtf' : $fType = 'text'; break;
	   case '.doc' : $fType = 'text'; break;
	   case '.docx' : $fType = 'text'; break;
	   case '.pages' : $fType = 'text'; break;
	   
	   case '.avi' : $fType = 'video'; break; // Accepted Video Files
	   case '.flv' : $fType = 'video'; break;
	   case '.wmv' : $fType = 'video'; break;
	   case '.mov' : $fType = 'video'; break;
	   case '.mp4' : $fType = 'video'; break;
	   
	   case '.mp3' : $fType = 'music'; break; // Accepted Music Files
	   case '.aac' : $fType = 'music'; break;
	   case '.m4a' : $fType = 'music'; break;
	   case '.flac' : $fType = 'music'; break;
	   case '.wav' : $fType = 'music'; break;
	   case '.mid' : $fType = 'music'; break;
	   case '.ogg' : $fType = 'music'; break;
	   
	   default : $fType = 'unknown'; ; break ;
   }
   
	echo '<img id="_div_FLE_IMG" src="images/F_'.$fType.'.fw.png">';
	
	switch ($row['columnType']) {
            case 0 : $tagColor = 'RED'; break ;
            case 1 : $tagColor =  'ORANGE'; break ;
            case 2 : $tagColor =  'YELLOW'; break ;
            case 3 : $tagColor =  'GREEN'; break ;
            case 4 : $tagColor =  'AQUA'; break ;
            case 5 : $tagColor =  'NAVY'; break ;
            case 6 : $tagColor =  'PURPLE'; break ;
            case 7 : $tagColor =  'PINK'; break ;
            case 8 : $tagColor =  'NONE'; break ;
        }
	
	echo '<div id="_div_FLE_TAG_'.$tagColor.'" > </div><p>';
	echo $cStr;
	echo "</form>";
	echo '</div>';
	$arrayFileTickers[$ticker] = $ticker;
	$arrayFileIDS[$ticker] = $row['columnID'];
	$arrayFileNames[$ticker] = $cStr;
	$arrayFileTypes[$ticker] = '"'.substr($cStr, strrpos($cStr,'.'),$cStrLen-1).'" file type';
	$arrayFileTimes[$ticker] = $row['columnCreated'];
	$arrayFileColrs[$ticker] = $row['columnType'];
	$arrayFileRName[$ticker] = $row['columnFileURL'];
	$arrayFileUser[$ticker] = $row['userID'];
}

echo '</div>';


if(isset($_POST['delete'])){
    $queryDelete = "DELETE FROM tableFiles WHERE columnID='$_POST[hidden]'";
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

var IDS = []; 
	var Names = [];
	var Types = [];
	var Times = [];
	var Colrs = [];
	var Tickers = [];
	var RNames = [];
	var Users = [];
	
	var a = <?php echo $ticker; ?>;
	<?php $ticker2 = 0; 
	for ($i = 1; $i<= $ticker; $i ++) { ?>
		<?php $ticker2 ++; ?>
		Tickers[<?php echo $i?>] = <?php echo "'".$arrayFileTickers[$ticker2]."';"; ?>
		IDS[<?php echo $i?>] = <?php echo "'".$arrayFileIDS[$ticker2]."';"; ?>
		Names[<?php echo $i?>] = <?php echo "'".$arrayFileNames[$ticker2]."';"; ?>
		Types[<?php echo $i?>] = <?php echo "'".$arrayFileTypes[$ticker2]."';"; ?>
		Times[<?php echo $i?>] = <?php echo "'".$arrayFileTimes[$ticker2]."';"; ?>
		Colrs[<?php echo $i?>] = <?php echo "'".$arrayFileColrs[$ticker2]."';"; ?>
		RNames[<?php echo $i?>] = <?php echo "'".$arrayFileRName[$ticker2]."';"; ?> 
		Users[<?php echo $i?>] = <?php echo "'".$arrayFileUser[$ticker2]."';"; ?>
	<?php } ?>
	

function mouseClickFile(item) { 
	
	if (item != "-1") {
		for (i = 1; i <= a; i ++) {
			document.getElementsByName(i)[0].id = "_div_FLE";
		}
		b = true;
		 document.getElementsByName(item)[0].id = "_div_FLE_2";
		 selected = item;
		 parent.launchFileFormIns(Tickers[selected],IDS[selected],Names[selected],Types[selected],Times[selected],Colrs[selected],RNames[selected],Users[selected]);
	} else {
		if (b == true) {
			b = false;
		} else {
			for (i = 1; i <= a; i ++) {
				document.getElementsByName(i)[0].id = "_div_FLE";
			}
			selected = -1;
			parent.launchFilterForm();
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
function alertEM(DD,MM,YYYY,TXT,FLE,COL) {
	document.getElementsByName("filterDD")[0].value = DD; 
	document.getElementsByName("filterMM")[0].value = MM; 
	document.getElementsByName("filterYY")[0].value = YYYY; 
	document.getElementsByName("filterWord")[0].value = TXT; 
	document.getElementsByName("filterFile")[0].value = FLE; 
	document.getElementsByName("filterType")[0].value = COL; 
	document.getElementsByName("filterUser")[0].value = '@Session["userID"]'; 
	document.getElementById("filterForm").submit();
}

function setFileSel(selectedI) {
	document.getElementsByName(selectedI)[0].id = "_div_FLE_2";
	selected = selectedI;
	
	parent.reloadFileFormIns(Tickers[selected],IDS[selected],Names[selected],Types[selected],Times[selected],Colrs[selected],RNames[selected],Users[selected]);
}
</script> 


	<form id="filterForm" action=formPopulateFilter.php method=post>
	<input type="hidden" name="filterDD" >
	<input type="hidden" name="filterMM" >
	<input type="hidden" name="filterYY" >
	<input type="hidden" name="filterWord" >
	<input type="hidden" name="filterType" >
	<input type="hidden" name="filterFile" >
	<input type="hidden" name="filterUser" >
	</form>


</body>
</html>
