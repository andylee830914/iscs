<?php 
$total=64;
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
          $total1=$total-1;
          echo '<tr><td>'.$total1.'<br>你的名字</td></tr>';
          $total=$total+1;
}
          $total=$total-3;

?>
        </table>
      </div>
        
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 7; $i++) { 
          $total1=$total-7;
          $total2=$total-14;
          echo '<tr><td>'.$total1.'<br>你的名字</td><td>'.$total2.'<br>你的名字</td></tr>';
          $total=$total+1;
}
          $total=$total-21;

?>
        </table>

      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $total1=$total-8;
          $total2=$total-16;
          echo '<tr><td>'.$total1.'<br>你的名字</td><td>'.$total2.'<br>你的名字</td></tr>';
          $total=$total+1;
}
          $total=$total-24;

?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $total1=$total-8;
          $total2=$total-16;
          echo '<tr><td>'.$total1.'<br>你的名字</td><td>'.$total2.'<br>你的名字</td></tr>';
          $total=$total+1;
}
          $total=$total-24;

?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $total1=$total-8;
          $total2=$total-16;
          echo '<tr><td>'.$total1.'<br>你的名字</td><td>'.$total2.'<br>你的名字</td></tr>';
          $total=$total+1;
}
?>
        </table>
      </div>
      <div class="col-md-1"></div>          
      
      </div>
      
  <footer class="footer" ><p>Developed by Lee,Yu-Hsun &copy; NCKU MATH 2016</p> </footer>
      
    </div> <!-- /container -->


  </body>
</html>
