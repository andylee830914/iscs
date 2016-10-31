<?php
$url="../";
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}
include("../connect.php");

$name=$_COOKIE["user"];
require_once('../latex/CLatexTemplate.php');
require_once('../latex/MATLABTemplate.php');


$quy="select * from user where idnumber='".$name."'";
$result=mysql_query($quy);
$moodleid=mysql_result($result,0,1);
$quy3="select * from midterm where moodleid='".$moodleid."' ORDER BY time DESC";
$result3=mysql_query($quy3);
if(mysql_num_rows($result3)==0){
  $filename="";
}else{
  $filename=mysql_result($result3,0,5);
  
}
$hw=$moodleid % 2;
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s');  

//$hw=0;
$test = "";
if(isset($_GET['t']) && $_GET['pass']==md5('iscs2016midterm'.$name)) {
	// Make the LaTeX file and send it through

	$test = $_GET['t'];
	$data = array(
			'idnumber' => $name,
      'moodleid' => $moodleid
	);

	try {
		CLatexTemplate::download($data, $url.'latex/mid1/mid1_'.$hw.'.tex', $name.'_MID.pdf');

    $quy2="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','midpdf".$hw."',  '105')";
    mysql_query($quy2);
    
	} catch(Exception $e) {
		echo $e -> getMessage();
	}

}elseif(isset($_GET['t'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url=mid1.php?error>';
}

if (isset($_GET['py'])||isset($_GET['t'])) {
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../header.php');?>
<script src="<?php echo $url;?>js/ajaxfileupload.js"></script>
<script src="<?php echo $url;?>js/uploadpic.js"></script>
<script>
var site_url="<?php echo $url;?>"
</script>
</head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include('../navbar.php');?>

      <!-- Main component for a primary marketing message or call to action -->
      <h2>期中上機考</h2>
      <?php if($_POST['testpass']=="20161023"){?>
      <?php 
  $ip         = $_SERVER['REMOTE_ADDR'];
  $confirm    = $_POST['accept'];
  if(!isset($confirm)){
    $confirm=0;
  }
  $quy3="INSERT INTO sign (moodleid,time, ip, confirm) VALUES ('".$moodleid."','".$date."','".$ip."',  '".$confirm."')";
  mysql_query($quy3);
      
      ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>題目要求</h3>
          <ul>
              <li>請按底下的「下載檔案」，下載本次期中考的題目PDF檔，若有其他需求請當場告知！</li>                           
              <li>上傳規定：
                  <ul>
                  <li>請在底下上傳本次作業，你可以多次上傳。</li>
                  <li>本次考試需將執行指令寫入題目要求的檔案名稱.m檔 (MATLAB script file)</li>                                                   
                  <li>"題目"、所有".m檔"請一起放進資料夾，使用zip壓縮。</li>                                                                                    
                  <li>檔名：<strong>學號_mid.zip</strong></li>               
                  </ul>
              </li>
              <li><h3>考試時間：2016-11-24 13:10~15:00</h3></li>
              <li>
              其他注意事項：              
                  <ul>
                  <li>上傳前請確認壓縮檔內是否有所有檔案，並且用<strong>zip</strong>壓縮（勿使用 .7z、.rar 等其他壓縮格式）。</li>
                  <li>請確認題目檔是否是自己的學號。</li>                                                                                                                          
                  <li>有問題請舉手發問，請不要跟同學交談。</li>
                  </ul>
              </li>               

            
          </ul>
        </div>
      </div>
      <table>
      <tr>
  <td class="col-md-6">
  <form>
    <input type="hidden" name="pass" value="<?php echo md5('iscs2016midterm'.$name);?>"/>
		<input type="hidden" name="t" /> <input type="submit" class="btn btn-primary btn-lg" value="下載題目" />
	</form>
  </td>
  <td class="col-md-6">
  <!--<form>
		<input type="hidden" name="py" /> <input type="submit" class="btn btn-primary btn-lg" value="下載資料" />
	</form>-->
  
    </td>
    </tr>
    <tr>
    
  <td class="col-md-12">
    <h3>檔案上傳區</h3>    
  
    <div>
    <?php
    echo '<div class="form-group ">';
    echo '<div class="col-sm-5">';
    echo '<input  class="form-control" id="pic" name="pic" placeholder="請選擇檔案後，按「上傳」鍵。"
           value="'.$filename.'" readonly>';
    // echo '</div><div class="col-sm-4">';
    // echo '<button class="btn btn-default" id="deletepic"/>刪除圖片</button>' ;
    // echo '</div></div>';
    ?>
    </form>
    </td>
    
    </tr>
    <tr>
  <td class="col-md-12">
    <form>
    <div class="form-group form-inline">
        <div class="col-sm-3">
            <input type="file" name="userfile" size="20" id="userfile"/>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-default" id="mysubmit"/>上傳</button>

        </div>

    </div>
    </td>
    </tr>
    
      </table>

      <?php }elseif(isset($_GET['error'])){?>
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h3 class="panel-title">注意</h3>
        </div>
        <div class="panel-body">
        <h2>請循正常流程下載題目！</h2>
        </div>
      
      </div>
      
      <?php }else{?>  
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>考試說明</h3>
          <ul>
            <li>考試時間：11/24(四)13:10~15:00</li>
            <li>請確認是否坐在指定電腦</li>            
            <li>不得使用個人隨身電子產品，僅能使用電腦室公用電腦</li>
            <li>禁止上網，但可以使用 MATLAB 中的 Documentation</li>
            <li>尊重自己，請勿作弊</li>
            
          </ul>          
          <form class="form-inline" method="post" action="">
          <center><h4><input type="checkbox" id="accept" name="accept" value="1"> 我願意遵守考試規則！</h4></center>
          <center>
            <div class="form-group"><input type="password" class="form-control " name="testpass" placeholder="試卷密碼"></div>
            <button type="submit" class="btn btn-default" id="enter" disabled>進入試卷</button>
          </center>          
          </form>
        </div>
      </div>    
      <?php }?>
    </div> <!-- /container -->


  </body>
  <script>
  $("#accept").click(function(){
    if(document.getElementById('accept').checked){
        $("#enter").removeAttr('disabled');
    }else{
        $("#enter").attr('disabled','disabled');
    }
  });
  </script>
</html>
<?php
}
?>
