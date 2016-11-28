<?php
$url="";
function moodle_check($array){
        $domainname = "http://140.116.21.120";
        $where['username'] = $array['username'];
        $where['password'] = $array['password'];
        // $where['service']  = 'ncku_moodle_app';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $domainname.'/iscs/token.php');
        curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($where));
        $result=curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result);
        //print_r($result);
        if (isset($result->token)) {
            return $result->token;
        }else{
            return NULL;
        }
}
include("connect.php");
if (isset($_POST['username'])) {
  $logindata['username']=$_POST['username'];
  $logindata['password']=$_POST['password'];
  $name=ucfirst($logindata['username'])."iscs2016";
  $quy="SELECT * FROM user where `idnumber`='".$logindata['username']."'";
  $result=mysql_query($quy);
  $ip = $_SERVER['REMOTE_ADDR'];
  $moodleid=mysql_result($result,0,0); 
  if(ucfirst($_POST['username'])=="C12345678" && $_POST['password']=="iscs2016"){
    $token="iamadmin1234";
  }elseif(ucfirst($_POST['username'])=="L16051234" && $_POST['password']=="iscs2016"){
    $token="iamadmin1234";    
  }elseif($moodleid){
    $token=moodle_check($logindata);
  }else{
    $error="您不是本堂課成員，請聯絡助教確認！謝謝！";
  }
  if (isset($token)) {
    setcookie("token",$token, time()+3600*5);
    setcookie("user",ucfirst($logindata['username']), time()+3600*5);
    setcookie("role",md5($name),time()+3600*5);
    $updateip="UPDATE user set loginip='".$ip."' WHERE idnumber='".$logindata['username']."'";
    mysql_query($updateip);
    echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
  }else{
    $error="密碼錯誤！";    
  }
  
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('header.php');?>
  <link href="dist/css/signin.css" rel="stylesheet">
  
</head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="post" action="login.php">
        <h2 class="form-signin-heading">請登入</h2>
        <h4>使用 成大moodle 帳號密碼登入</h4>
        <?php if($error){echo $error;}?>
        <label for="username" class="sr-only">學號</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Student ID" required autofocus>
        <label for="password" class="sr-only">密碼</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
      </form>

    </div> <!-- /container -->


  </body>
</html>
