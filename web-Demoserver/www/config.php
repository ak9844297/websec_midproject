<?php
define('DB_SERVER', 'db');
define('DB_USERNAME', 'B10815052');
define('DB_PASSWORD', 'a24070456');
define('DB_NAME', 'mydatabase');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
