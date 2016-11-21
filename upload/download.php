<?php
$url="../";
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}
include("../connect.php");
$name=$_COOKIE["user"];
$quy="select * from user where idnumber='".$name."'";
$result=mysql_query($quy);
$moodleid=mysql_result($result,0,1);
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s'); 
$ip         = $_SERVER['REMOTE_ADDR'];
$ds          = DIRECTORY_SEPARATOR;  //1
$storeFolder = 'midterm';   //2
$quy3="select * from midterm where moodleid='".$moodleid."' ORDER BY time DESC";
$result3=mysql_query($quy3);
if(mysql_num_rows($result3)==0){
  $filename="";
}else{
  $filename=mysql_result($result3,0,5);
}

$targetPath = '/home/andylee' . $ds. $storeFolder . $ds . $name.$ds;  //4
$targetFile =  $targetPath. $filename;  //5
$type = "application/zip";
if (file_exists($targetFile)) {
    header("Expires: 0");
    header("Pragma: no-cache");
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
    header("Content-Description: File Transfer");
    header("Content-Type: " . $type);
    header("Content-Length: " .(string)(filesize($targetFile)) );
    header('Content-Disposition: attachment; filename="'.basename($targetFile).'"');
    header("Content-Transfer-Encoding: binary\n");

    readfile($targetFile); // outputs the content of the file

    exit();
}else{
    
}
?>