<!DOCTYPE html>
<html lang='zh-cn'>
    <head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"></meta>
        <title>ZheGeQuery</title>
    </head>
    
    <body>
        <h2>Type in the sever's port you want to query...@example 8888,87888...</h2>
		<form  method="post" action="">
            port:<input type=text name="port"/>
        	<h3>choose the date...@example 1994/03/13</h3>
            date:<input type=text name="date"/>
        	<br/>
			<h3>write down the time start&end</h3>
			startTime:<input type=text name="tSta">
			endTime  :<input type=text name="tEnd">
        	<input type=submit value="Query" />
        </form>
    </body>
</html>
<?php 
//data	:	2015-8-20
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	a query for realtime online number
//
//查询数据库获得每日付费人数和关卡人数用
header('content-type:text/html;charset = utf-8');
date_default_timezone_set("PRC");
require "connect.php";

$tSta=$_POST['tSta'];
$tEnd=$_POST['tEnd'];
$port=$_POST['port'];
//start query
if($_POST['date']){
    $date=$_POST['date'];
}else{
    $date=date("Y/m/d",strtotime("-1 day"));
}
echo("<br/>port:$port<br/>date:$date<br/>");
$sql = "SELECT DISTINCT name FROM `".$date."-".$port."action` BETWEEN ".$tSta."AND".$tEnd." ORDER BY convert(name using gbk)";
$result = mysql_query($sql);
//get num
$rowCount = mysql_num_rows($result);
echo "from $tSta to $tEnd,the number of player is $rowCount<br/>";

listPlayer("RealTimePlayerNum",$result);
getTaskNum();

   

function listPlayer($tableName,$result){
    //list players
    echo "<table border='1'>
    <tr>
    <th>$tableName</th>
    </tr>";

    while($row = mysql_fetch_array($result))
      {
      echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
      echo "</tr>";

      }
    echo "</table>";
}
//查询各个task的留存人数
function getTaskNum(){
    global $date,$port;
    $taskId = file("taskId.log");
    for($x=0;$x<count($taskId);$x++){
        $task = rtrim($taskId[$x]);
        
      	$sql = "SELECT DISTINCT name FROM `".$date."-".$port."action` WHERE string LIKE '%".$task."%'";
        $result = mysql_query($sql) or die(mysql_error());
       
        $playerNum = mysql_num_rows($result);
        echo("$task:$playerNum<br/>");
    }
    //echo count($row);//check sum

    
}

    
mysql_close($conn);
?>
