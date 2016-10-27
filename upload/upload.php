<?php
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
$attempt=mysql_result($result3,0,4);
 
if (!empty($_FILES)) {
    $tempFile = $_FILES['userfile']['tmp_name'];          //3             
      
    $_FILES['userfile']['attempt']=$attempt+1;  
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds . $name.$ds;  //4
     
    $targetFile =  $targetPath. $_FILES['userfile']['name'];  //5
    

    if(!file_exists($targetPath)){
        mkdir($targetPath, 0777);
    }

    move_uploaded_file($tempFile,$targetFile); //6
    $quy2="INSERT INTO midterm (ip,time, moodleid, attempt,filename) VALUES ('".$ip."','".$date."','".$moodleid."','".$_FILES['userfile']['attempt']."',  '".$_FILES['userfile']['name']."')";
    mysql_query($quy2);
    echo json_encode($_FILES);
     
}
?>  