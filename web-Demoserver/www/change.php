<?php
session_start();
if(!isset($_SESSION["adloggedin"]) || $_SESSION["adloggedin"] === false){
    header("refresh:1,url=welcome.php");
    echo"真是佩服你能來到這裡呢 沒正常登入還想搞阿";
}
else{
$myfile = fopen("title.txt", "w") or die("Unable to open file!");
$txt = $_POST['newtitle'];
fwrite($myfile, $txt);
header("Location: admin.html");
}
?>