For the 2nd release of our system, I specifically tackled a lot the areas around the news feed and incorporation of friends.

The news feed coding required a table setup that allowed a linked userID from tableUsers to post a status message into a field.  When a user navigates to the news feed, this searches through the mass of logs and queries against the session_HostID and also any friends this user may have and pulls out the logs accordingly.
The key challenge was the incorporation of Karim's friend system, as whilst the table records who are friends it does not duplicate those friends so if UserA is friends with UserB, nowhere in the table does it say UserB is friends with UserA.  This means that when I attempted to write a SQL query to 'get a users friends' to had to check both columns of the table againist each other twice in order to determine if the relationship existed.
This was achieved by storing the results in an array and then imploding this array against the SQL query to get the data I need 
// see line 52;
$queryFeed = "SELECT * FROM tableFeed 
INNER JOIN tableUsers 
ON tableUsers.columnID=tableFeed.columnUserID 
WHERE columnUserID IN (".implode(',',$UserFriendCodes).")";

After I was able to successfully query the array I went into each of the required files and made the changes to allow the website to incorporate this new system.
Updating the login form to change the button link, post to the main frame and reset the sidebar
Updating the upload form to also post a record of what was uploaded to the feed
Updating the delete form to post a record of what was deleted to the feed

Sadly this does have a flaw in that a user will be able to see the feed of a friend before the timestamp of becoming that persons friend, however I was not able to change this in the end as this involved a large undertaking in re-designing the friend system to include these timestamps.

After this I set about updating the burndown charts for the final tutorial presentation and setting up the presentation users and files.