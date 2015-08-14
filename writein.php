<!DOCTYPE html>
<html lang='zh-cn'>
    <head>
        <title>ZheGeDataBase</title>
    </head>
    
    <body>
        <h2>Type in the sever's port you want to write in...@example 8888,87888...</h2>
		<form  method="post" action="">
            port:<input type=text name="port"/>
        	<h3>choose the date...@example 1994/03/13</h3>
            date:<input type=text name="date"/>
        	<br/>
        	<input type=submit value="Insert" />
        </form>
    </body>
</html>

<?php
//data	:	2015-8-14
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	insert data for zhegedb
//
//补时间存储数据用
date_default_timezone_set("PRC");
require "connect.php";

//general variable
$p=$_POST['port'];

if($_POST['date']){
    $date=$_POST['date'];
}else{
    $date=date("Y/m/d",strtotime("-1 day"));
}

echo $date."<br/>";
ini_set('memory_limit','-1');
ini_set('max_execution_time','0');
ini_set('max_input_time','0');
set_time_limit(0);

//foreach ($port as $p){
    switch($p){
        case 8888:
        $f = "http://121.201.8.151:8888/gm/getActiveLog?path=/server1/".$date.".log";
		
        break;
        case 8788:
        $f = "http://121.201.8.151:8788/gm/getActiveLog?path=/server2/".$date.".log";
		
        break;
        case 8688:
        $f = "http://121.201.8.151:8688/gm/getActiveLog?path=/server3/".$date.".log";
		
        break;
        case 8588:
        $f = "http://121.201.8.151:8588/gm/getActiveLog?path=/server4/".$date.".log";
	
        break;
        case 8488:
        //$f = "http://121.201.8.151:8488/gm/getActiveLog?path=/server5/".$date.".log";
		$f = "./logs/8488/".$date."log";//在运维来之前暂时将文件存储到本地
       
        break;
        case 8887:
        $f = "http://123.57.69.133:8887/gm/getActiveLog?path=/server1/".$date.".log";
	
        break;
    	case 8388:
    	$f = "http://121.201.8.151:8388/gm/getActiveLog?path=/server6/".$date.".log";
            
    	break;
    	default:
            echo "The server is not supported now!!!";
    }
    //echo "<br/>$p";
    readLog($f,$p);
//}

    //$file = "http://121.201.8.151:8788/gm/getActiveLog?path=/server2/".$date.".log";





//read files
function readLog($file,$port){
    
    global $date;
    $data = file($file);
     
    //create everyday's table
    $sql = "CREATE TABLE IF NOT EXISTS `".$date."-".$port."action` (\n"
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
    	$k=str_replace("'","",$k);
	$g=str_replace("'","",$g);//fix name bug
        $insert = "insert into `".$date."-".$port."action`(time,name,action,string)values('$b','$k','$f','$g')";
        $insertR = mysql_query($insert) or die(mysql_error());
    
    }
    echo("...done!</br>");
    
    
    //separate the strings&echo
    $line = $data[count($data)-1];
    
    
    $text=iconv("UTF-8","GBK",$line);//convert to GBK
    list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l)= explode(' ',$text);
    echo "Time: $a,$b;Name: $k;Action: $f;String: $g<br/>";
    echo "$port server/'s total number is $num<br/><br/>";
}
     //closeDB
//mysql_close($conn);
?>
