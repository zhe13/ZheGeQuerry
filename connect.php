<?php
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
//connect to db
$conn = mysql_connect($hostname, $dbuser, $dbpass)
    or die(mysql_error());
echo 'Connected successfully<br/>';
//select db
mysql_select_db($dbname, $conn) or die ('Can\'t use dbname : ' . mysql_error());
echo 'Select db '.$dbname.' successfully<br/>';
//mysql_close($conn);

?>
