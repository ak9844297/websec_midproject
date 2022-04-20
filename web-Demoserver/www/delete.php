<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
if($_SESSION['username']!=$_POST['username']){
    header("Location: index.php");
}
$id=$_POST['id'];

require_once('config.php');
$sql="DELETE FROM messages WHERE id = '$id' ";
$result=mysqli_query($link,$sql);
if($result){
    foreach (glob("file4mesg/$id.*") as $file){
        unlink($file);
        }
    header('refresh:1,url=mesg_board.php');
    echo'刪除成功 1s 後跳轉';
}
else{
    echo"找不到";
}
?>