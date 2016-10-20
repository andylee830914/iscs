<?php
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}
$assignment=$_GET['hw'];
function get_all_assignment($assid){
        $apiurl = "http://moodle.ncku.edu.tw/webservice/rest/server.php";
        $where['wstoken'] = '612375be1cf194cff1e30d8170457ff1';
        $where['wsfunction'] = 'mod_assign_get_submissions';
        $where['moodlewsrestformat']  = 'json';
        $where['assignmentids[0]']=$assid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($where));
        $result=curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result);
        
        return $result->assignments[0]->submissions;
}

$data=get_all_assignment($assignment);
foreach ($data as $key => $value) {
    date_default_timezone_set('Asia/Taipei');
    $index=date('Y-m-d H:00:00', $value->timemodified);
    $time[$index]++;
}
$timekey=array_keys($time);
sort($timekey);
$begin=strtotime($timekey[0]);
$last=strtotime($timekey[count($timekey)-1]);
$hour=ceil(($last-$begin)/ ( 60 * 60 ));
for ($i=0; $i < $hour; $i++) { 
    $nowindex=date('Y-m-d H:00:00', $begin+$i*60*60);
    $newdata[$i]->time = $nowindex;
    $newdata[$i]->total=0;
    
    foreach ($time as $key1 => $value1) {
                    if ($key1==$nowindex) {
                        $newdata[$i]->total= $value1;
                    }
                }
}

$jsondata=json_encode($newdata);
print_r($jsondata);
?>