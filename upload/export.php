<?php
$url="../";
include("../connect.php");
$stdjson = file_get_contents("../student.json");
$stdarray= json_decode($stdjson);
// print_r($stdarray);
foreach ($stdarray as $key => $value) {
$name=$value->idnumber;  
echo $name;
echo '\n';
$quy="select * from user where idnumber='".$name."'";
$result=mysql_query($quy);
$moodleid=mysql_result($result,0,1);
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s'); 
$ds          = DIRECTORY_SEPARATOR;  //1
$storeFolder = 'midterm';   //2
$quy3="select * from midterm where moodleid='".$moodleid."' ORDER BY time DESC";
$result3=mysql_query($quy3);
if(mysql_num_rows($result3)==0){
  $filename="";
}else{
  $filename=mysql_result($result3,0,5);
}

$targetPath = '/Users/andylee830914/Documents' . $ds. $storeFolder . $ds . $name.$ds;  //4
$targetFile =  $targetPath. $filename;  //5
$path= '/Users/andylee830914/exportmid/'.$name.'/';
echo $targetFile;
$type = "application/zip";
if (file_exists($targetFile)) {
  if(!file_exists($path)){
        mkdir($path, 0777);
        chmod($path, 0775);
    }
    rename($targetFile, '/Users/andylee830914/exportmid/'.$name.'/'.$filename);   
}
}
?>