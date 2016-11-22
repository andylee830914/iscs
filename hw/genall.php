<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

include("../connect.php");

$url="../";
  
require_once('../latex/LatexTemplate.php');
require_once('../latex/MATLABTemplate.php');

$stdjson = file_get_contents("../student.json");
$stdarray= json_decode($stdjson);
// print_r($stdarray);
foreach ($stdarray as $key => $value) {

  # code...
$name=$value->idnumber;  
echo $name;
echo '\n';



$midquy="select ip.id,user.moodleid,user.fullname from user left join ip on ip.moodleid=user.moodleid where user.idnumber='".$name."'";
$result=mysql_query($midquy);
$seatid=mysql_result($result,0,0);
$moodleid=mysql_result($result,0,1);
$fullname=mysql_result($result,0,2);
echo $fullname;
$hw=$seatid % 2;
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s');  

//$hw=0;
	// Make the LaTeX file and send it through

	$data = array(
		'idnumber' => $name,
    	'moodleid' => $moodleid,
		'name'	   => $fullname
	);

	try {
		LatexTemplate::export($data, '/home/andylee/mid/mid2_'.$hw.'.tex', $name.'_MID.pdf');
    

    
	} catch(Exception $e) {
		echo $e -> getMessage();
	}

}