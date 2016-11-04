<?php 
$totala=64;
$totalb=15;
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
          $totala1=$totala-1;
          echo '<tr><td>'.$totala1.'<br>你的名字</td></tr>';
          $totala=$totala+1;
}
          $totala=$totala-3;

?>
        </table>
      </div>
        
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 7; $i++) { 
          $totala1=$totala-7;
          $totala2=$totala-14;
          echo '<tr><td>'.$totala1.'<br>你的名字</td><td>'.$totala2.'<br>你的名字</td></tr>';
          $totala=$totala+1;
}
          $totala=$totala-21;

?>
        </table>

      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $totala1=$totala-8;
          $totala2=$totala-16;
          echo '<tr><td>'.$totala1.'<br>你的名字</td><td>'.$totala2.'<br>你的名字</td></tr>';
          $totala=$totala+1;
}
          $totala=$totala-24;

?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $totala1=$totala-8;
          $totala2=$totala-16;
          echo '<tr><td>'.$totala1.'<br>你的名字</td><td>'.$totala2.'<br>你的名字</td></tr>';
          $totala=$totala+1;
}
          $totala=$totala-24;

?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          $totala1=$totala-8;
          $totala2=$totala-16;
          echo '<tr><td>'.$totala1.'<br>你的名字</td><td>'.$totala2.'<br>你的名字</td></tr>';
          $totala=$totala+1;
}
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
          echo '<tr><td>'.$totalb1.'<br>你的名字</td><td>'.$totalb2.'<br>你的名字</td></tr>';
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
          if($totalb2==16){
            echo '<tr><td>'.$totalb1.'<br>你的名字</td><td</td></tr>';
            
          }else{
            echo '<tr><td>'.$totalb1.'<br>你的名字</td><td>'.$totalb2.'<br>你的名字</td></tr>';
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
