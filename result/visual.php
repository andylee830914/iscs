<?php
$url="../";
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}

$name=$_COOKIE["user"];
function get_assignment(){
        $apiurl = "http://moodle.ncku.edu.tw/webservice/rest/server.php";
        $where['wstoken'] = '612375be1cf194cff1e30d8170457ff1';
        $where['wsfunction'] = 'mod_assign_get_assignments';
        $where['moodlewsrestformat']  = 'json';
        $where['courseids[0]']='83211';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($where));
        $result=curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result);
        
        return $result->courses[0]->assignments;
}



$assignmment=get_assignment();


if(!$_GET['hw']){
    $nowtitle="請選擇作業！";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../header.php');?>

  <link href="../dist/css/myd3.css" rel="stylesheet">
  <script>
  var api_site_url="http://<?php echo $_SERVER[HTTP_HOST];?>/iscs/result/";
  var nowid='<?php echo $_GET['hw'];?>';
  </script>
  <script src="../dist/js/d3.js"></script>
  <script src="../dist/js/d3.tip.js"></script>
  <script src="../dist/js/mydraw.js"></script>
  
</head> 
  

  
  

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include('../navbar.php');?>
      <h2>作業繳交時間分佈圖 <small><?php echo $nowtitle;?></small></h2>
        <div class="row">
            <div id="analysisd3"></div>
        </div>
            

      <!-- Main component for a primary marketing message or call to action -->
      
    </div> <!-- /container -->

  </body>
</html>