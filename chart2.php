
<!DOCTYPE html>
<html style="height: 100%">
   <head>
       <meta charset="utf-8">
   </head>
   <body style="height: 100%; margin: 0">
       <div id="container" style="height: 100%"></div>
       <script type="text/javascript" src="echarts.min.js"></script>
       <script type="text/javascript">
       
<?php
header("Content-Type: text/html; charset=utf-8");
$con = mysql_connect("localhost","sdutiotc_iot","FmUv1jOE");
mysql_select_db("sdutiotc_iot", $con);
mysql_query('SET NAMES UTF-8'); 
mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=utf8", $con);
echo "var dataday=[";
$records=0;
$recordss=0;
$data=array();
$dataday=array();
$pep=array();
$result = mysql_query("SELECT date,count(*) FROM checkin group by date ORDER BY date ASC limit 365");
while($row = mysql_fetch_array($result))
{
	$dataday[$records]=$row['date'];
	$data[$records++]=$row['count(*)'];
}
$result = mysql_query("SELECT count(*) from( SELECT DISTINCT id,date FROM checkin ORDER BY date ASC )as res GROUP by date");
while($row = mysql_fetch_array($result))
{
	$pep[$recordss++]=$row['count(*)'];
}
for($i=0;$i<$records;$i++)
{
	echo "'".$dataday[$i]."',";
}
echo "];var data=[";
for($i=0;$i<$records;$i++)
{
	echo "'".$data[$i]."',";
}
echo "];var pep=[";
for($i=0;$i<$recordss;$i++)
{
	echo "'".$pep[$i]."',";
}
echo "];";
?>
		var dom = document.getElementById("container");
		var myChart = echarts.init(dom);
		var app = {};
		option = null;
		option = {
title: {
        text: '签到统计图'
    },
		tooltip : {
		    trigger: 'axis'
		},
		toolbox: {
		    feature: {
		        saveAsImage: {}
		    }
		},
		grid: {
		    left: '3%',
		    right: '4%',
		    bottom: '3%',
		    containLabel: true
		},
		xAxis : [
		    {
		        type : 'category',
		        boundaryGap : false,
		        data :dataday
		    }
		],
		yAxis : [
		    {
		        type : 'value'
		    }
		],
		series : [
		    {
		        name:'当日签到次数',
		        type:'line',
		        areaStyle: {normal: {}},
		        data:data
		    },
                    {
		        name:'当日净签到人数',
		        type:'line',
		        areaStyle: {normal: {}},
		        data:pep
		    }
		]
		};
		myChart.setOption(option, true);
       </script>
   </body>
</html>