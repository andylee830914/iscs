<?php
$url="../";
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url='.$url.'login.php>';
}

include("connect.php");


?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include($url.'header.php');?>

  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <?php include($url.'navbar.php');?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="page-header">
      <h2>期中補考</h2>
      </div>
      <div class="row container-fluid">

             
      
      </div>
      
  <footer class="footer" ><p>Developed by Lee,Yu-Hsun &copy; NCKU MATH 2016</p> </footer>
      
    </div> <!-- /container -->


  </body>
</html>
