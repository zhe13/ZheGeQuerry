<?php
header("Content-Type:text/html;charset=utf-8"); 
echo '<strong>Hello, SAE!</strong><br>';
echo "UserName".SAE_MYSQL_USER."<br>";
echo "密码：".SAE_MYSQL_PASS."<br>";
echo "端口：".SAE_MYSQL_PORT."<br>";
echo "数据库名".SAE_MYSQL_DB."<br>";

$date=date("Y/m/d",strtotime("-1 day"));
$sql = "CREATE TABLE IF NOT EXISTS `".$date."Xaction` (\n"
    . " `id` int(8) unsigned NOT NULL auto_increment,\n"
    . " `time` varchar(20) NOT NULL,\n"
    . " `name` varchar(20) NOT NULL,\n"
    . " `action` varchar(20) NOT NULL, \n"
    . " `string` text COLLATE utf8_unicode_ci NOT NULL,\n"
    . " PRIMARY KEY (`id`)\n"
    . ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";

//SAE封装好的链接类
$mysql = new SaeMysql();
$mysql->runSql($sql);

$file = "http://123.57.69.133:8887/gm/getActiveLog?path=/server1/".$date.".log";
ini_set('memory_limit','-1');

$data = file($file);
$tempData = $data;

for($x =2;$x<13;$x++)
{	
    $line = $tempData[$x];
    list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l)= explode(' ',$line);
    echo "$x<br>";
    $sqlstr = "insert into `".$date."Xaction`(time,name,action,string)values('$b','$k','$f','$g')";
    $mysql->runSql($sqlstr);
    $line = null;
    
}
echo "done!<br>";
//disconnect db
$mysql->closeDb();
?>