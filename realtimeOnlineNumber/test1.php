<?php
//data	:	2015-
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	
//

date_default_timezone_set("PRC");
require "../connect.php";

//general variable
$port=8788;//array(8888,8788,8688,8588,8488,8388,8887);
$date=date("Y/m/d");
ini_set('memory_limit','-1');
ini_set('max_execution_time','0');
ini_set('max_input_time','0');
set_time_limit(0);
$file = "http://121.201.8.151:8788/gm/getActiveLog?path=/server2/".$date.".log";

readLog($file,$port);

//closeDB
mysql_close($conn);


//read files
function readLog($file,$port){
    
    global $date;
    $data = file($file);
    $tableNmae = $date."online".$port;
    //create everyday's table
    $sql = "CREATE TABLE IF NOT EXISTS `".$tableNmae."` (\n"
        . " `id` int(8) unsigned NOT NULL auto_increment,\n"
        . " `time` varchar(20) NOT NULL,\n"
        . " `name` varchar(7) NOT NULL,\n"
        . " PRIMARY KEY (`id`)\n"
        . ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
    $result = mysql_query($sql) or die(mysql_error());
    insertNewData($data,$tableNmae);  
    realtime($tableName);
}


//insert data
function insertNewData($data,$tableName)
{
    //query old data
    $sql = "SELECT COUNT(*) FROM `".$tableName."`";
    $oldNum = mysql_query($sql) or die(mysql_error());
    $num = count($data)-1;
    
    for($x = $oldNum;$x<$num;$x++)
    {
        $line = $data[$x];
        list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l)= explode(' ',$line);
    	$k=str_replace("'","",$k);
	$g=str_replace("'","",$g);//fix name bug
        $insert = "insert into `".$tableName."`(time,name)values('$b','$k')";
        $insertR = mysql_query($insert) or die(mysql_error());  
    }   
}

function realtime($tableName) 
{
    $hour = date('h');
    $sql  = "SELECT DISTINCT name from`".$tableName."` WHERE time LIKE '".$hour."%'";
    $num  = mysql_num_rows(mysql_query($sql)); 
    $totalData = array(
        'n' => $num,
        'table' => $tableName
    );
    echo $_GET['jsonp'].'('.json_encode($totalData).')';
}
   
?>