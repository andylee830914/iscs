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
          echo '<tr><td>'.$i.'-1</td></tr>';
}
?>
        </table>
      </div>
        
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 7; $i++) { 
          echo '<tr><td>'.$i.'-1</td><td>'.$i.'-2</td></tr>';
}
?>
        </table>

      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          echo '<tr><td>'.$i.'-1</td><td>'.$i.'-2</td></tr>';
}
?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          echo '<tr><td>'.$i.'-1</td><td>'.$i.'-2</td></tr>';
}
?>
        </table>
      </div>
      <div class="col-md-2">
        <table class="table  table-bordered">
<?php for ($i=0; $i < 8; $i++) { 
          echo '<tr><td>'.$i.'-1</td><td>'.$i.'-2</td></tr>';
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
