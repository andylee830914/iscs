<?php $url="";?>
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
      <div class="jumbotron">
        <h1>科學計算軟體</h1>
        <p>成功大學數學系 105學年度「科學計算軟體」課程</p>
        <p>
          <?php
            if(!isset($_COOKIE["token"])) {
          ?>
          <a class="btn btn-lg btn-primary" href="login.php" role="button">登入 &raquo;</a>
          <?php
              }
          ?>
        </p>
      </div>
  <footer class="footer" ><p>Developed by Lee,Yu-Hsun &copy; NCKU MATH 2016</p> </footer>
      
    </div> <!-- /container -->


  </body>
</html>
