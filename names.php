<?php include 'head.php';?>
		<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
		  <div class="navbar-header">    
		    <a class="navbar-brand" href="index.php">物联网实验室考勤系统 Beta</a>
		  </div>
	  
		  <div class="collapse navbar-collapse" id="navbar-collapse-01">
	 <ul class="nav navbar-nav">
		  
			  <li><a href="result.php">近期记录</a></li>
                                                <li><a href="ywresult.php">月周记录</a></li>
						<li><a href="times.php">签到次数</a></li>
						<li><a href="http://sdutiot.com/">返回首页</a></li>
			
		    </ul>
		    <form class="navbar-form navbar-right" action="#" role="search">
		      <div class="form-group">
		        <div class="input-group">
		          <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
		          <span class="input-group-btn">
		            <button type="submit" class="btn"><span class="fui-search"></span></button>
		          </span>
		        </div>
		      </div>
		    </form>
		  </div><!-- /.navbar-collapse -->
		</nav><!-- /navbar -->
<?php
header("Content-Type: text/html; charset=utf-8");
$con = mysql_connect("localhost","sdutiotc_iot","FmUv1jOE");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$sql="";
if(isset($_GET["name"])&&(!isset($_GET["week"]))&&(!isset($_GET["month"])))
{echo "<h1>".$_GET["name"]."的记录：</h1>";
    $sql="SELECT * FROM checkin where id = '".$_GET["name"]."' order by date desc,start";
}
else if(isset($_GET["name"])&&(isset($_GET["week"]))&&(!isset($_GET["month"])))
{echo "<h1>".$_GET["name"]."在第".$_GET["week"]."周的记录：</h1>";
    $sql="SELECT id,start,end,stay_time,duration,checkin.date,ip from week_date,checkin where weeks= '".$_GET["week"]."' and week_date.date = checkin.date and id='".$_GET["name"]."'";
}
else if(isset($_GET["name"])&&(!isset($_GET["week"]))&&(isset($_GET["month"])))
{echo "<h1>".$_GET["name"]."在".$_GET["month"]."的记录：</h1>";
    $sql="SELECT * FROM checkin where id = '".$_GET["name"]."' and date like '".$_GET["month"]."%' order by date desc,start";
}
//echo $sql;
mysql_select_db("sdutiotc_iot", $con);
mysql_query('SET NAMES UTF-8'); 
mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=utf8", $con);
$result = mysql_query($sql);
echo "<div class='col-md-2'></div>";
echo "<div class='col-md-8'>";
echo "<table class='table table-bordered table-striped table-hover'>";
echo "<thead><tr><th>姓名</th><th>签到时间</th><th>签退时间</th><th>签到时长</th><th>时间段</th><th>日期</th><th>IP</th></tr></thead><tbody>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>".$row['id']."</td><td>".$row['start']."</td><td>".$row['end']."</td><td>".(($row['stay_time']/60)%10)."小时".($row['stay_time']%60)."分钟</td><td>".$row['duration']."</td><td>".$row['date']."</td><td>".$row['ip']."</td></tr>";
  }
echo "</tbody></table>";
echo "</div>";
echo "<div class='col-md-2'></div>";
mysql_close($con);
?>