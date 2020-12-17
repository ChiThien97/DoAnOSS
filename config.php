<?php
// define('DB_SERVER','localhost');
// define('DB_USER','id14366606_root');
// define('DB_PASS' ,'Thien!@#3003');
// // define('DB_NAME','id14366606_newsdb');
// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS' ,'');
// define('DB_NAME','BaoDayDB');
$con = mysqli_connect('localhost','root','','BaoDayDB');
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>