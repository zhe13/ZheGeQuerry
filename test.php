<?php
//存储数据用
date_default_timezone_set("PRC");
require "connect.php";

//read files
$date=date("Y/m/d",strtotime("-1 day"));
echo $date."<br/>";
$file = "http://123.57.69.133:8887/gm/getActiveLog?path=/server1/".$date.".log";
ini_set('memory_limit','-1');

$data = file($file);


//create everyday's table
$sql = "CREATE TABLE IF NOT EXISTS `".$date."action` (\n"
    . " `id` int(8) unsigned NOT NULL auto_increment,\n"
    . " `time` varchar(20) NOT NULL,\n"
    . " `name` varchar(20) NOT NULL,\n"
    . " `action` varchar(20) NOT NULL, \n"
    . " `string` text COLLATE utf8_unicode_ci NOT NULL,\n"
    . " PRIMARY KEY (`id`)\n"
    . ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$result = mysql_query($sql) or die(mysql_error());


echo("is writing...");
//insert data
$num = count($data)-1;
for($x = 0;$x<$num;$x++)
{
    $line = $data[$x];
	list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l)= explode(' ',$line);
    $insert = "insert into `".$date."action`(time,name,action,string)values('$b','$k','$f','$g')";
	$insertR = mysql_query($insert) or die(mysql_error());

}
echo("...done!</br>");


//separate the strings&echo
$line = $data[count($data)-1];


$text=iconv("UTF-8","GBK",$line);//convert to GBK
list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l)= explode(' ',$text);
echo "Time: $a,$b;Name: $k;Action: $f;String: $g<br/>";
echo "total number is $num<br/>";

     //closeDB

?>