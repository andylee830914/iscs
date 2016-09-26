<?php
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
include("connect.php");
$name=$_COOKIE["user"];
require_once('latex/MATLABTemplate.php');
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
		LatexTemplate::download($data, 'latex/hw2/hw2_'.$hw.'.tex', $name.'_HW1.pdf');
    $date       = date('Y-m-d H:i:s');
    $quy2="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','".$hw."',  '1')";
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
		//echo "hello";
    //chdir(sys_get_temp_dir());
    //
    //print_r(exec('python pymat.py 2>&1'));
    $python="/Library/Server/Web/Data/Sites/Default/iscs/latex/pymat.py";
    MATLABTemplate::download($python,$name,$moodleid);
    //echo 'python /home/www/html/iscs/ta/pymat.py '.$moodleid;
    //$date       = date('Y-m-d H:i:s');
    //$quy2="INSERT INTO download (moodleid,time, download, hw) VALUES ('".$moodleid."','".$date."','".$hw."',  '1')";
    // mysql_query($quy2);
	} catch(Exception $e) {
		echo $e -> getMessage();
	}

}

?>
