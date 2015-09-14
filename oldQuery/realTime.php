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
            <br/>
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
if($_POST['tEnd']){
    $tEnd=$_POST['tEnd'];
}else{
    $tEnd=$tSta;
}

$port=$_POST['port'];
//start query
if($_POST['date']){
    $date=$_POST['date'];
}else{
    $date=date("Y/m/d",strtotime("-1 day"));
}
echo("<br/>port:$port<br/>date:$date<br/>");
$sql = "SELECT DISTINCT name FROM `".$date."-".$port."action` WHERE time LIKE '$tSta%' OR time LIKE '$tEnd'";
$result = mysql_query($sql);
//get num
$rowCount = mysql_num_rows($result);
echo "from $tSta to $tEnd,the number of player is $rowCount<br/><br/><br/>";

listPlayer("RealTimePlayerNum",$result);


   

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

 
mysql_close($conn);
?>
