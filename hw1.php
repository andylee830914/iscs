<?php
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
include("connect.php");
$name=$_COOKIE["user"];
require_once('latex/LatexTemplate.php');
$quy="select * from user where idnumber='".$name."'";
$result=mysql_query($quy);
$moodleid=mysql_result($result,0,1);
$hw=$moodleid % 4;
$test = "";
if(isset($_GET['t'])) {
	// Make the LaTeX file and send it through
	$test = $_GET['t'];
	$data = array(
			'idnumber' => $name,
      'moodleid' => $moodleid
	);

	try {
		LatexTemplate::download($data, 'latex/hw1/hw1_'.$hw.'.tex', $name.'_HW1.pdf');
    $date       = date('Y-m-d H:i:s');
    $quy2="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','".$hw."',  '1')";
    mysql_query($quy2);
	} catch(Exception $e) {
		echo $e -> getMessage();
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
    <link href="dist/css/navbar.css" rel="stylesheet">

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

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">科學計算軟體</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">首頁</a></li>
              <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">作業 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="active"><a href="hw1.php">作業一</a></li>
          </ul>
        </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              
              <!--<li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>-->
              <?php
              if(isset($_COOKIE["token"])) {
              ?>  
                  <li><a ><?php echo $_COOKIE["user"];?>，您好！</a></li>
                  <li><a href="logout.php">登出</a></li>
              <?php
              }else{
              ?>
                  <li><a href="login.php">登入</a></li>
              
              <?php
              }
              ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <h2>作業一</h2>
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>作業要求</h3>
          <ul>
              <li>請按底下的「下載檔案」，下載本次的作業題目PDF檔</li>                           
              <li>上傳規定：
                  <ul>
                  <li>請回 moodle 上傳本次作業。</li>
                  <li>"作業題目"、"MuPAD檔"、"螢幕截圖"、"輸出PDF檔"請一起放進資料夾，使用zip壓縮。</li>
                  <li>請把學號姓名打在MuPAD檔第一行。</li>                                                                                    
                  <li>檔名：<strong>學號_HW1.zip</strong></li>               
                  </ul>
              </li>
              <li>期限：2016-09-26 17:00</li>
              <li>作業請自己寫！不會寫可以跟同學、老師或助教討論！</li>               

            
          </ul>
        </div>
      </div>
  <form>
		<input type="hidden" name="t" /> <input type="submit" class="btn btn-primary btn-lg" value="下載檔案" />
	</form>
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
