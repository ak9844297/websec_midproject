<?php
session_start();
$token=$_SESSION['token'];
$token2=$_POST['token'];
if(!$token||$token2!=$token){
    echo"$token $token2";
    echo"wrongtoken";
}
else{
$_SESSION = array(); 
session_destroy(); 
header('location:index.php');
}
?>