<!DOCTYPE html>
<html lang='zh-cn'>
    <head>
        <title>ZheGeQuery</title>
    </head>
    
    <body>
        <h2>Type in the sever's port you want to query...@example 8888,87888...</h2>
		<form  method="post" action="">
            port:<input type=text name="port"/>
		<br/>
        	<h3>choose the date...@example 1994/03/13</h3>
            date:<input type=text name="date"/>
		<br/>
		<h3>type in the days away from the start</h3>
	    start from<input type=text name="days"/>days ago. 
        	<br/>
        	<input type=submit value="Query" />
        </form>
    </body>
</html>

<?php
//查询数据库获得每日付费人数和关卡人数用
header('content-type:text/html;charset = utf-8');
date_default_timezone_set("PRC");
require "connect.php";
