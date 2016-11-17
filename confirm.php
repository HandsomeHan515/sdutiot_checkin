<?php include 'database.php';?>
<?php
    header("Content-Type:text/html; charset=utf-8");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name =$_POST["username"];
      $password = $_POST["password"];
      $ip=$_SERVER["REMOTE_ADDR"];
    }
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://gw.open.1688.com/openapi/param2/1/system/currentTime/0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec($ch);
curl_close($ch);
$year=substr($output,1,4);
$month=substr($output,5,2);
$day=substr($output,7,2);
$hour=substr($output,9,2);
$min=substr($output,11,2);
$sec=substr($output,13,2);
if($sec=="")
{echo "<script>alert('服务器错误，请重试！');window.location='./index.php';</script>";}
else{
$time=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec;
$tt=$time;


    $time = substr($tt,11,2);
    $nowtime = substr($tt,11,8);
    $day = substr($tt,0,10);
    $checkined=false;
    $whatday=date('w');
    $weeks=date('W');
    if($time>=0&&$time<=12)
    {
      $duration="上午";
    }
    if($time>=13&&$time<=18)
    {
      $duration="下午";
    }
    if($time>=19&&$time<=23)
    {
      $duration="晚上";
    }
    $exist=false;
$second=false;
    $sql="SELECT * FROM week_date where date = '".$day."'";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result))
    {
        $exist=true;
    }
    if(!$exist)
    {
        $sql_insert="INSERT INTO week_date (date,whatday,weeks) VALUES ('"
        .$day.
        "','"
       .$whatday.
        "','"
       .$weeks.
        "')";
        mysql_query($sql_insert);
    }


    $sql="SELECT * FROM iot_ucenter_members where username = '".$name."'";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result))
    {
      if(md5(md5($password).$row['salt'])==$row['password'])
      {$logined=true;}
    }
    if ($logined) {
      $sql="SELECT * FROM checkin where id = '".$name."' and duration = '".$duration."'and date = '".$day."'";
      $result = mysql_query($sql);
      while($row = mysql_fetch_array($result))
      {
        $start=$row['start'];
        $checkined=true;
if($row['end']!="未签退"){$second=false;}
      }
      if(!$checkined)
      {
        
        $sql_insert="INSERT INTO checkin (id, start, duration, ip, date) VALUES ('"
          .$name.
          "','"
          .$nowtime.
          "','"
          .$duration.
          "','"
          .$ip.
          "','"
          .$day.
          "')";
        mysql_query($sql_insert);
        //echo $sql_insert;
        $sqls="SELECT * FROM checkin_times WHERE id LIKE '".$name."'";
        $result = mysql_query($sqls); 
        $flag=0;
        while($row = mysql_fetch_array($result))
        {
             $flag=1;
        }
        if(!$flag)
        {
             mysql_query("INSERT INTO checkin_times (id) VALUES ('".$name."')");
        }
        else
        {
          mysql_query("UPDATE checkin_times SET times = times+1 WHERE id = '".$name."'");
        }
        echo "<script>alert('".$duration."好,签到成功！不要忘记签退哦。');window.location='./result.php';</script>";
      }
      else
      {if(!$second){
        $end=$nowtime;
        $HH=substr($start,0,2);
        $hh=substr($end,0,2);
        $MM=substr($start,3,2);
        $mm=substr($end,3,2);
        $SS=substr($start,6,2);
        $ss=substr($end,6,2);
        $stay_time=$hh*60*60+$mm*60+$ss- ($HH*60*60+$MM*60+$SS);
        //$HH=($stay_time/3600)%100;
        //$MM=(($stay_time%3600)/60)%60;
        $stay_time=($stay_time/60)%600;//=$HH."小时".$MM."分";
        $sql_insert="UPDATE checkin set end='".$nowtime."' ,stay_time='".$stay_time."' where id = '".$name."' and duration = '".$duration."'and date = '".$day."'";
        //echo $sql_insert;
        mysql_query($sql_insert);
        echo "<script>alert('签退成功！');window.location='./result.php';</script>";
       }else{echo "<script>alert('刚才已签退！');window.location='./result.php';</script>";}
      }

      //if() 
    } else {
      echo "<script>alert('密码或账号错误！');window.location='./index.php';</script>";
    }
    mysql_close($con);
}
?>