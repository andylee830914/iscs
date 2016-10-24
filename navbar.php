<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $url;?>index.php">科學計算軟體</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo $url;?>about.php">關於</a></li>
              <?php
              //auth zone
              if(isset($_COOKIE["token"])) {
              ?> 
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">作業 <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo $url;?>hw/hw1.php">作業一</a></li>
                    <li><a href="<?php echo $url;?>hw/hw2.php">作業二</a></li>
                    <li><a href="<?php echo $url;?>hw/hw3.php">作業三</a></li>
                    <li><a href="<?php echo $url;?>hw/hw4.php">作業四</a></li>
                    <li><a href="<?php echo $url;?>hw/hw6.php">作業六</a></li>
                  </ul>
              </li>   
              <?php if($_SERVER['SCRIPT_NAME']=="/iscs/result/visual.php"){?>
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">繳交情況 <span class="caret"></span></a>
               <ul class="dropdown-menu">
                <?php 
                foreach ($assignmment as $akey => $avalue) {
                  echo '<li><a href="?hw='.$avalue->id.'"';
                  if($_GET['hw']==$avalue->id) {
                    $nowtitle=$avalue->name;
                    echo ' selected="selected"';
                  } 
                  echo '>';
                  echo $avalue->name;
                  echo '</a></li>';
                }?>
                </ul>
              </li>                   
              <?php }else{?>
              <li><a href="<?php echo $url;?>result/visual.php">繳交情況</a></li>              
              <?php }?>

              <?php }?>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
              
              <!--<li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>-->
              <?php
              if(isset($_COOKIE["token"])) {
              ?>  
                  <li><a ><?php echo $_COOKIE["user"];?>，您好！</a></li>
                  <li><a href="<?php echo $url;?>logout.php">登出</a></li>
              <?php
              }else{
              ?>
                  <li><a href="<?php echo $url;?>login.php">登入</a></li>
              
              <?php
              }
              ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>