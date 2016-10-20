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


if($_GET['hw']){
    
}



?>
<!DOCTYPE html>
<html lang="en">
  <?php include('../header.php');?>
  <link href="../dist/css/myd3.css" rel="stylesheet">
  <script>
  var api_site_url="http://127.0.0.1/iscs/result/";
  var nowid='<?php echo $_GET['hw'];?>';
  </script>
  <script src="../dist/js/d3.js"></script>
  <script src="../dist/js/d3.tip.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../dist/js/mydraw.js"></script>
  
  

  
  

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include('../navbar.php');?>
      <h2>作業繳交時間分佈圖</h2>
      <div class="row">
        <div class="col-sm-3">      
                <select class="form-control" id="assignment" onchange="window.location.href='?&hw='+this.value">
                <option value="">--</option>      
                <?php 
                foreach ($assignmment as $akey => $avalue) {
                  echo '<option value="'.$avalue->id.'"';
                  if($_GET['hw']==$avalue->id) {echo ' selected="selected"';} 
                  echo '>';
                  echo $avalue->name;
                  echo '</option>';
                }?>
                </select>
        </div>
        </div>
        <div class="row">
            <div id="analysisd3"></div>
        </div>
            

      <!-- Main component for a primary marketing message or call to action -->
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>