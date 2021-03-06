<?php
$url="../";
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}
include("../connect.php");

$name=$_COOKIE["user"];
require_once('../latex/LatexTemplate.php');
require_once('../latex/MATLABTemplate.php');


$quy="select * from user where idnumber='".$name."'";
$result=mysql_query($quy);
$moodleid=mysql_result($result,0,1);
$hw=intval(substr($name,5,4)) % 2;
$test = "";
if(isset($_GET['t'])) {
	// Make the LaTeX file and send it through
	$test = $_GET['t'];
	$data = array(
			'idnumber' => $name,
      'moodleid' => $moodleid
	);

	try {
		LatexTemplate::download($data, $url.'latex/hw2/hw2_'.$hw.'.tex', $name.'_HW2.pdf');
    $date       = date('Y-m-d H:i:s');
    $quy2="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','pdf".$hw."',  '2')";
    mysql_query($quy2);
	} catch(Exception $e) {
		echo $e -> getMessage();
	}

}

if(isset($_GET['py'])) {
	// Make the LaTeX file and send it through
	$test = $_GET['t'];
	$data = array(
			'idnumber' => $name,
      'moodleid' => $moodleid
	);

	try {
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    $python="$root/iscs/latex/hw2/pymat.py";    
    MATLABTemplate::download($python,$name,$moodleid);
    //echo 'python /home/www/html/iscs/ta/pymat.py '.$moodleid;
    $date       = date('Y-m-d H:i:s');
    $quy3="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','mat".$hw."',  '2')";
    mysql_query($quy3);
	} catch(Exception $e) {
		echo $e -> getMessage();
	}

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
      <h2>作業二</h2>
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>作業要求</h3>
          <ul>
              <li>請按底下的「下載檔案」及「下載資料」，下載本次的 作業題目PDF檔 與 作業資料mat檔</li>                           
              <li>上傳規定：
                  <ul>
                  <li>請回 moodle 上傳本次作業。</li>
                  <li>本次作業需將執行指令寫入 <strong>學號.m</strong> 檔 (MATLAB script file)</li>                                                   
                  <li>"作業題目"、"data.mat檔"、"學號.m檔"、"螢幕截圖"請一起放進資料夾，使用zip壓縮。</li>                                                                                    
                  <li>檔名：<strong>學號_HW2.zip</strong></li>               
                  </ul>
              </li>
              <li>期限：2016-10-06 17:00</li>
              <li>
              其他注意事項：              
                  <ul>
                  <li>上傳前請確認壓縮檔內是否有四個檔案。</li>
                  <li>請確認題目檔、data.mat是否是自己的學號。</li>                                                    
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
		<input type="hidden" name="t" /> <input type="submit" class="btn btn-primary btn-lg" value="下載題目" />
	</form>
      </td>
      <td class="col-md-6">
  <form>
		<input type="hidden" name="py" /> <input type="submit" class="btn btn-primary btn-lg" value="下載資料" />
	</form>
    </td>
    </tr>
      </table>
      
    </div> <!-- /container -->


  </body>
</html>
<?php
}
?>
