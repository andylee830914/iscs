<?php
function moodle_check($array){
        $domainname = "http://moodle.ncku.edu.tw";
        $where['username'] = $array['username'];
        $where['password'] = $array['password'];
        $where['service']  = 'ncku_moodle_app';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $domainname.'/login/token.php');
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
  $moodleid=mysql_result($result,0,0); 
  if($moodleid){
    $token=moodle_check($logindata);
  }elseif($_POST['username']=="admin" && $_POST['password']=="iscs2016ta"){
    print_r($_POST);
    $token="iamadmin1234";
  }else{
    $error="您不是本堂課成員，請聯絡助教確認！謝謝！";
  }
  if (isset($token)) {
    setcookie("token",$token, time()+3600*5);
    setcookie("user",ucfirst($logindata['username']), time()+3600*5);
    setcookie("role",md5($name),time()+3600*5);
    echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
  }
  
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>成大數學系-105科學計算軟體</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="post" action="login.php">
        <h2 class="form-signin-heading">請登入</h2>
        <h4>使用 成大moodle 帳號密碼登入</h4>
        <?php if($error){echo $error;}?>
        <label for="username" class="sr-only">學號</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Email address" required autofocus>
        <label for="password" class="sr-only">密碼</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
