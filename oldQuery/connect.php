<?php
$hostname = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'zhegedb';
//connect to db
$conn = mysql_connect($hostname, $dbuser, $dbpass)
    or die(mysql_error());
echo 'Connected successfully<br/>';
//select db
mysql_select_db($dbname, $conn) or die ('Can\'t use dbname : ' . mysql_error());
echo 'Select db '.$dbname.' successfully<br/>';
//mysql_close($conn);

?>
