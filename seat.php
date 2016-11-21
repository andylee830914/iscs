<?php
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}
$totala=64;
$totalb=15;
include("connect.php");
$ip = $_SERVER['REMOTE_ADDR'];
echo $ip;
$quy = "SELECT ip.id,ip.ip,ip.room,user.fullname FROM ip left join user on ip.moodleid=user.moodleid";
$query_result = mysql_query($quy);
$array = array();
while ($row = mysql_fetch_assoc($query_result)) {
    $id=$row['id'];
    if($row['ip']==$ip){
        $h=' class="danger"';
        echo $h;
    }else{
        $h='';
    }
    $array[$id] = array(
        'ip' => substr($row['ip'],11),
        'room' => $row['room'],
        'name' => $row['fullname'],
        'h'    => $h
    );
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include('header.php');?>

  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include('navbar.php');?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="page-header">
      <h2>上機考座位表</h2>
      </div>
      <div class="row container-fluid">
      <center>      
      <h3>大學部電腦教室</h3>  
      </center>
      <div class="col-md-1"></div>          
      <div class="col-md-1">      
        <table class="table  table-bordered">
<?php for ($i=0; $i < 2; $i++) {
          $totala1=$totala;
          echo '<tr><td'.$array[$totala1]['h'].'>'.$array[$totala1]['ip'].'<br>'.$array[$totala1]['name'].'</td></tr>';
          $totala=$totala-1;
}

?>
        </table>
      </div>
        
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 7; $i++) { 
          $totala1=$totala;
          $totala2=$totala-7;      
          echo '<tr><td'.$array[$totala1]['h'].'>'.$array[$totala1]['ip'].'<br>'.$array[$totala1]['name'].'</td><td'.$array[$totala2]['h'].'>'.$array[$totala2]['ip'].'<br>'.$array[$totala2]['name'].'</td></tr>';
          $totala=$totala-1;
}
          $totala=$totala-7;
          
?>
        </table>

      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $totala1=$totala;
          $totala2=$totala-8;
         echo '<tr><td'.$array[$totala1]['h'].'>'.$array[$totala1]['ip'].'<br>'.$array[$totala1]['name'].'</td><td'.$array[$totala2]['h'].'>'.$array[$totala2]['ip'].'<br>'.$array[$totala2]['name'].'</td></tr>';

          $totala=$totala-1;
}
          $totala=$totala-8;

?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $totala1=$totala;
          $totala2=$totala-8;
          echo '<tr><td'.$array[$totala1]['h'].'>'.$array[$totala1]['ip'].'<br>'.$array[$totala1]['name'].'</td><td'.$array[$totala2]['h'].'>'.$array[$totala2]['ip'].'<br>'.$array[$totala2]['name'].'</td></tr>';

          $totala=$totala-1;
}
          $totala=$totala-8;

?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $totala1=$totala;
          $totala2=$totala-8;
         echo '<tr><td'.$array[$totala1]['h'].'>'.$array[$totala1]['ip'].'<br>'.$array[$totala1]['name'].'</td><td'.$array[$totala2]['h'].'>'.$array[$totala2]['ip'].'<br>'.$array[$totala2]['name'].'</td></tr>';

          $totala=$totala-1;
}
$totala=64;
?>
        </table>
      </div>
      <div class="col-md-1"></div>          
      
      </div>

      <div class="row container-fluid">
      <center>      
      <h3>研究生電腦教室</h3>  
      </center>
      <div class="col-md-2"></div>          
        
      <div class="col-md-4">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 4; $i++) { 
          $totalb1=$totalb-14;
          $totalb2=$totalb-10;
          $totalbt1=$totalb1+$totala;
          $totalbt2=$totalb2+$totala;
          
          echo '<tr><td'.$array[$totalb1]['h'].'>'.$array[$totalbt1]['ip'].'<br>'.$array[$totalbt1]['name'].'</td><td'.$array[$totalb1]['h'].'>'.$array[$totalbt2]['ip'].'<br>'.$array[$totalbt2]['name'].'</td></tr>';

          $totalb=$totalb+1;
}
          $totalb=$totalb+4;

?>
        </table>

      </div>
      <div class="col-md-4">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 4; $i++) { 
          $totalb1=$totalb-14;
          $totalb2=$totalb-10;
          $totalbt1=$totalb1+$totala;
          $totalbt2=$totalb2+$totala;
          
          if($totalb2==16){
          echo '<tr><td'.$array[$totalb1]['h'].'>'.$array[$totalbt1]['ip'].'<br>'.$array[$totalbt1]['name'].'</td><td></td></tr>';

            
          }else{
           echo '<tr><td'.$array[$totalb1]['h'].'>'.$array[$totalbt1]['ip'].'<br>'.$array[$totalbt1]['name'].'</td><td'.$array[$totalb1]['h'].'>'.$array[$totalbt2]['ip'].'<br>'.$array[$totalbt2]['name'].'</td></tr>';

          }
          $totalb=$totalb+1;
}

?>
        </table>
      </div>

      <div class="col-md-2"></div>          
      
      </div>
      
  <footer class="footer" ><p>Developed by Lee,Yu-Hsun &copy; NCKU MATH 2016</p> </footer>
      
    </div> <!-- /container -->


  </body>
</html>
