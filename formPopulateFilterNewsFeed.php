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
</head>
<body>
<?php
    // Start the session
    session_start();
?>
<?php
include("connect.php"); 
# Connect to the database

$conn = db_connect();
$tickerUserFind = 0;

$queryFriends1 = "SELECT * FROM tableFriends WHERE columnUserID2 = " . $_SESSION["userID"];
$queryFriendsResult1 = mysqli_query($conn, $queryFriends1) or die('Error connecting to database') ;
while ($row = mysqli_fetch_array($queryFriendsResult1)) {
	$UserFriendCodes[$tickerUserFind] = $row['columnUserID1'];
	$tickerUserFind ++;
}

$queryFriends2 = "SELECT * FROM tableFriends WHERE columnUserID1 = " . $_SESSION["userID"];
$queryFriendsResult2 = mysqli_query($conn, $queryFriends2) or die('Error connecting to database') ;
while ($row = mysqli_fetch_array($queryFriendsResult2)) {
	$UserFriendCodes[$tickerUserFind] = $row['columnUserID2'];
	$tickerUserFind ++;
}

$UserFriendCodes[$tickerUserFind] = $_SESSION["userID"];

/*  To test if the array is storing properly
echo '<ul>';
foreach($UserFriendCodes as $Friend){
	echo '<li>'.htmlspecialchars($Friend).'</li>';
};
echo '</ul>';
echo var_dump($UserFriendCodes);
*/


// Grab all of the feed items from the current sessionID and their friends profiles
$queryFeed = "SELECT * FROM tableFeed INNER JOIN tableUsers ON tableUsers.columnID=tableFeed.columnUserID WHERE columnUserID IN (".implode(',',$UserFriendCodes).")";

$queryFeedResult = $conn->query($queryFeed);

echo '<ul>';
if ($queryFeedResult->num_rows > 0){
	while($row = $queryFeedResult->fetch_assoc()){
		
		//echo '<ul>';
		echo '<li>' . '<i>' . $row['columnDate'] . ":   " . '</i>' . $row['columnFullName'] . " " . $row['columnStatus'] .   '</li>';
		//echo </div>;
	} 
}	else {
		echo "Your profile currently does not have any items in its feed!";
	}	
echo '</ul>';
	
?>
</form>

</body>
</html>
