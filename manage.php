<?php
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
include("connect.php");
$name=$_COOKIE["user"];
$name1=$_COOKIE["role"];
if ($name1==md5("L16054075iscs2016")||$name1==md5("C1039iscs2016")||$name1==md5("L16041056iscs2016")) {
  $string = file_get_contents("user.json");
  $json = json_decode($string, true);
  $quy="select * from user order by moodleid";
  $result=mysql_query($quy);
}else{
  echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
}

foreach ($json as $key => $value) {
  $quy1="select id from user where idnumber='".$value['idnumber']."'";
  $result1=mysql_query($quy1);
  $sqlid=mysql_result($result1,0,0);
  if(!$sqlid){
  $quy2="INSERT INTO user (moodleid, idnumber, fullname) VALUES ('".$value['id']."', '".$value['idnumber']."',  '".$value['fullname']."')";
  echo $quy2;
  mysql_query($quy2);
  }
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
      <h2>課程成員</h2>
      <table class="table table-bordered">
      <?php while($rows=mysql_fetch_array($result)){;
      echo "<tr>";
      echo '<td class="col-md-3">';
      echo $rows['moodleid'];
      echo '</td>';
      echo '<td class="col-md-3">';
      echo $rows['idnumber'];
      echo '</td>';
      echo '<td class="col-md-3">';
      echo $rows['fullname'];
      echo '</td>';
      echo '</tr>';
      }

      ?>
      </table>

      
      
      
    </div> <!-- /container -->


  </body>
</html>
