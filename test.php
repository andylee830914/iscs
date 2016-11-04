<?php
include("connect.php");
$stdjson = file_get_contents("student.json");
$stdarray= json_decode($stdjson);
for ($i=0; $i < 48; $i++) {
    $ipnum=51+$i; 
    $ip="140.116.21.".$ipnum;
    $std=$stdarray[$i]->id;
    $sql="INSERT INTO ip(ip,room,moodleid) values('".$ip."','a','".$std."')";
    mysql_query($sql);
}
for ($i=48; $i < 53; $i++) {
    $ipnum=53+$i; 
    $ip="140.116.21.".$ipnum;
    $std=$stdarray[$i]->id;
    $sql="INSERT INTO ip(ip,room,moodleid) values('".$ip."','a','".$std."')";
    mysql_query($sql);
}
for ($i=53; $i < 64; $i++) {
    $ipnum=148+$i; 
    $ip="140.116.21.".$ipnum;
    $std=$stdarray[$i]->id;
    $sql="INSERT INTO ip(ip,room,moodleid) values('".$ip."','a','".$std."')";
    mysql_query($sql);
}
for ($i=64; $i < 79; $i++) {
    $ipnum=$i-53; 
    $ip="140.116.21.".$ipnum;
    if($stdarray[$i]){
        $std=$stdarray[$i]->id;    
    }else{
        $std="10000";
    }
    $sql="INSERT INTO ip(ip,room,moodleid) values('".$ip."','b','".$std."')";
    mysql_query($sql);
}
?>