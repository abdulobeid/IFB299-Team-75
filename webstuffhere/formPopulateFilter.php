<html>
<head>
    <title>Media Library</title>
</head>
<body>
<h1>Media Library Filter View</h1>

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
    

$query = "SELECT * FROM tableFiles" . $queryAdd ;
$queryresult = mysqli_query($conn, $query) or die('Error connecting to database') ;

if(isset($_POST['delete'])){
    $queryDelete = "DELETE FROM tableFiles WHERE columnID=$_POST[hidden]";
	$filename = "/var/www/html/uploads/{$_POST[fname]}";
	echo $filename;
    echo $queryDelete;
	if (unlink($filename)) {
		mysqli_query($conn, $queryDelete);
        echo 'File "<strong>'.$filename.'</strong>" has been deleted.';
        header("Refresh:0");
        } else {
            echo 'File cannot be deleted.';
        }
    }
    
    //selected="selected"

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
    </p>';
 
echo "<table>";
echo "<tr><th>Folder</th><th>File</th><th>Uploaded</th><th>Type</th></tr>";
    
while ($row = mysqli_fetch_array($queryresult)) {
   echo "<form action=formPopulateFilter.php method=post>";
   echo "<tr>" ;
	echo '<input type=hidden name="hidden" value=' . $row['columnID'] . '>';
    echo '<input type=hidden name="fname" value=' . $row['columnName'] . '>';
	echo "<td>" . "<valURL>" . $row['columnFileURL'] . "</valURL>" . " </td>";
	echo "<td>" . "<valTTL>" . $row['columnName']    . "</valTTL>" . " </td>";
	echo "<td>" . "<valCRT>" . $row['columnCreated'] . "</valCRT>" . " </td>";
	echo "<td>" . "<valTYP>" . $row['columnType']    . "</valTYP>" . " </td>";
	echo "<td>" . "<button type=submit name=delete>Delete</button> </td>";
   echo "</tr>" ;
	echo "</form>";
}

echo "</table>";

# }

?>

</body>
</html>
