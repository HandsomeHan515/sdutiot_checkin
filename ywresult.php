<?php
	include 'head.php';
?>
			<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
				<div class="navbar-header">    
					<a class="navbar-brand" href="index.php">物联网实验室考勤系统 Beta</a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse-01">
					<ul class="nav navbar-nav">

						<li><a href="result.php">近期记录</a></li>
                                                <li class="active"><a href="ywresult.php">月周记录</a></li>
						<li><a href="times.php">签到统计</a></li>
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
                <div class="container" id="show1" style="margin-top:120px;"><div class="row"><div class="col-md-3"></div><div class="col-md-6">
			<div class="row">
				<form name="input" action="week_result.php" method="post">
				<div class="col-md-9">周查询:<input style="font-size: 50px;height: 100px;" name="weeks" class="form-control" required=""></div>
                                <div class="col-md-3"><button id="search" type="submit" class="btn btn-success" style="margin-top: 30px;width:100%;font-size: 35px;height:100px">Go !</button></div>
			</form></div>
<div class="row" style="margin-top:20px">
				<form name="input" action="month_result.php" method="post">
				<div class="col-md-9">模糊查询:<input style="font-size: 50px;height: 100px;" name="ymonth" class="form-control" required=""></div>
                                <div class="col-md-3"><button id="search" type="submit" class="btn btn-success" style="margin-top: 30px;width:100%;font-size: 35px;height:100px">Go !</button></div>
			
</form></div><p class="help-block" style="">* 注意：<br>周查询（一年的第几周；如第12周，则输入12）;<br>模糊查询（格式：年-月-日；年-月；年；如：2016-03-26；2016-03；2016）</p></div><div class="col-md-3"></div>
		</div>

</body>
</html>