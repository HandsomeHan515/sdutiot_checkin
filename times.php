<?php include 'head.php';?>
		<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
		  <div class="navbar-header">    
		    <a class="navbar-brand" href="index.php">物联网实验室考勤系统 Beta</a>
		  </div>
	  
		  <div class="collapse navbar-collapse" id="navbar-collapse-01">
	 <ul class="nav navbar-nav">
		  
			  <li><a href="result.php">近期记录</a></li>
                                                <li><a href="ywresult.php">月周记录</a></li>
						<li class="active"><a href="times.php">签到统计</a></li>
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
<iframe src="chart2.php" width="100%" height="500" frameborder="no" border="0" allowtransparency="yes"> 
</iframe> 
<?php
header("Content-Type: text/html; charset=utf-8");
$con = mysql_connect("localhost","sdutiotc_iot","FmUv1jOE");


mysql_select_db("sdutiotc_iot", $con);
mysql_query('SET NAMES UTF-8'); 
mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=utf8", $con);
$result = mysql_query("select id,count(*),SUM(stay_time),count(case when end='未签退' then 1 else null end) unsign, count(case when end<>'未签退' then 1 else null end) signed from checkin group by id order by count(*) desc,SUM(stay_time) desc");
echo "<div class='col-md-2'></div>";
echo "<div class='col-md-8'>";
echo "<table class='table table-bordered table-striped table-hover'>";
echo "<thead><tr><th>#</th><th>姓名</th><th>签到累计次数</th><th>净签到次数</th><th>未签退次数</th><th>记忆力</th><th>签到累计时长</th></tr></thead><tbody>";
$line=1;
while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>".$line++."</td><td><a href='name.php?name=".$row['id']."'>".$row['id']."</a></td><td>".$row['count(*)']."</td><td>".$row['signed']."</td><td>".$row['unsign']."</td><td>".((($row['signed']/$row['count(*)'])*100)%101)."%</td><td>".(($row['SUM(stay_time)']/60)%100000)."小时".($row['SUM(stay_time)']%60)."分钟</td></tr>";
  }
echo "</tbody></table>";
echo "</div>";
echo "<div class='col-md-2'></div>";
mysql_close($con);
?>
