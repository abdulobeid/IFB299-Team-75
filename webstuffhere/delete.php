<?php

$querydelete = "DELETE FROM tableFiles WHERE ID={$_POST['columnID']} LIMIT 1";

mysqli_query ($query);

if (mysqli_affected_rows() == 1) { 
?>

            <strong>Contact Has Been Deleted</strong><br /><br />

<?php
 } else { 
?>

            <strong>Deletion Failed</strong><br /><br />


<?php
} 
?>