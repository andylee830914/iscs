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
$hw=$moodleid % 2;
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
    $date       = date('Y-m-d H:i:s');
    $quy2="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','pdf".$hw."',  '4')";
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
</head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include('../navbar.php');?>

      <!-- Main component for a primary marketing message or call to action -->
      <h2>期中上機考</h2>
      <?php if($_POST['testpass']=="20161023"){?>
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>作業要求</h3>
          <ul>
              <li>請按底下的「下載檔案」，下載本次的 作業題目PDF檔</li>                           
              <li>上傳規定：
                  <ul>
                  <li>請回 moodle 上傳本次作業。</li>
                  <li>本次作業需將執行指令寫入 <strong>學號.m</strong> 檔 (MATLAB script file)</li>                                                   
                  <li>"作業題目"、"學號.m檔"、"結果截圖"請一起放進資料夾，使用zip壓縮。</li>                                                                                    
                  <li>檔名：<strong>學號_HW4.zip</strong></li>               
                  </ul>
              </li>
              <li><h3>期限：2016-10-20 13:00 (這次有提早喔！)</h3></li>
              <li>
              其他注意事項：              
                  <ul>
                  <li>本堂課名是「科學計算軟體」，請勿交其他程式課的作業。</li> 
                  <li>上傳前請確認壓縮檔內是否有三個檔案，並且用<strong>zip</strong>壓縮（勿使用 .7z、.rar 等其他壓縮格式）。</li>
                  <li>請確認題目檔是否是自己的學號。</li>                                                                                                                          
                  <li>作業請自己寫！不會寫可以跟同學、老師或助教討論！</li>
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
          <form class="form-inline" method="post" action="">
          <center><h4><input type="checkbox" id="accept"> 我願意遵守考試規則！</h4></center>
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
