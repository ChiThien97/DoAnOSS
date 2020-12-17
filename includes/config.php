<?php
define('DB_SERVER1','localhost');
define('DB_USER1','id14366606_root');
define('DB_PASS1' ,'Thien!@#3003');
define('DB_NAME1','id14366606_newsdb');
// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS' ,'');
// define('DB_NAME','BaoDayDB');
$con = mysqli_connect(DB_SERVER1,DB_USER1,DB_PASS1,DB_NAME1);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>