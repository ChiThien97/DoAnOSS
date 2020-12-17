<?php
define('DB_SERVER','localhost');
define('DB_USER','id14366606_root');
define('DB_PASS' ,'Thien!@#3003');
define('DB_NAME','id14366606_newsdb');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>