<?php
$url="../";
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}
include("../connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../header.php');?>
</head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include('../navbar.php');?>

      <!-- Main component for a primary marketing message or call to action -->
      <h2>作業七</h2>
      
      <div class="embed-responsive embed-responsive-4by3">
      <iframe src="https://hackmd.io/s/HJHQ86Fp#1027-課堂作業hw7" scrolling="no"></iframe>
      </div>
    </div> <!-- /container -->


  </body>
</html>
