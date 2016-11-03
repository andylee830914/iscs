<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("../connect.php");

$url="../";
  
require_once('../latex/ALatexTemplate.php');
require_once('../latex/MATLABTemplate.php');

$stdjson = file_get_contents("../user.json");
$stdarray= json_decode($stdjson);
// print_r($stdarray);
foreach ($stdarray as $key => $value) {

  # code...
$name=$value->idnumber;  
echo $name;
echo '\n';



$quy="select * from user where idnumber='".$name."'";
$result=mysql_query($quy);
$moodleid=mysql_result($result,0,1);
echo $moodleid;
$hw=$moodleid % 2;
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s');  

//$hw=0;
	// Make the LaTeX file and send it through

	$data = array(
			'idnumber' => $name,
      'moodleid' => $moodleid
	);

	try {
		CLatexTemplate::download($data, '/Library/Server/Web/Data/Sites/Default/iscs/latex/mid1/mid1_'.$hw.'.tex', $name.'_MID.pdf');
    

    
	} catch(Exception $e) {
		echo $e -> getMessage();
	}

}