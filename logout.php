<?php
include("connect.php");
$name=$_COOKIE["user"];
$updateip="UPDATE user set loginip='0.0.0.0' WHERE idnumber='".$name."'";
mysql_query($updateip);
setcookie("user","", time()-3600);
setcookie("token","", time()-3600);
echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
?>