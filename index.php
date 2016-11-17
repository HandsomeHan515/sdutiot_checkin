<?php
	include 'head.php';
	$IP=$_SERVER["REMOTE_ADDR"];
?>

			<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
				<div class="navbar-header">    
					<a class="navbar-brand" href="index.php">物联网实验室考勤系统 Beta</a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse-01">
					<ul class="nav navbar-nav">

						<li><a href="result.php">近期记录</a></li>
                                                <li><a href="ywresult.php">月周记录</a></li>
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
<?php 
	if(substr($IP,0,11)=="222.175.249"){
?>
		<div class="container" id="show1" style="margin-top:60px;">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="form-group has-success">
						<form action="confirm.php" method="post" name="frm">
						用户名：<input style="font-size: 50px;height: 100px;" type="text" name="username" class="form-control" required><br>
						密码: <input style="font-size: 50px;height: 100px;" type="password" name="password" class="form-control" required><br>
						
                                               
						<button id="search" type="submit" class="btn btn-success" style="width:100%;margin-top:10px;font-size: 35px;">Go !</button>
						<p class="help-block" style="float:right">* 注意：签到/签退都需在此页面输入账号密码！</p></form>
	          		</div>
	          	</div>
	          	<div class="col-md-3"></div>
			</div>
		</div>
<?php }else{ ?>
                <div class="container" id="show1" style="margin-top:60px;">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">请在419/420实验室签到！<img src="./kb.png" align="left"></div>
                                <div class="col-md-3"></div>
			</div>
		</div>

<?php }?>
</body>
</html>