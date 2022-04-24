<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
$nowid=$_SESSION['id'];
//$username2=htmlspecialchars($username2, ENT_QUOTES, $charset);
$id=$_POST['id'];
require_once('config.php');
$sql2 = "SELECT * FROM `messages` WHERE `id`=?";
$res2=$link->prepare($sql2);
$res2->bind_param('s',$id);
$res2->execute();
$res2=$res2->get_result();
//$res2= mysqli_query($link,$sql2);
$result2=mysqli_fetch_row($res2);
$sql3 = "SELECT * FROM `users` WHERE `username`=?";
$res3=$link->prepare($sql3);
$res3->bind_param('s',$result2[1]);
$res3->execute();
$res3=$res3->get_result();
$result3=mysqli_fetch_row($res3);
if($nowid!=$result3[0]){
    header('refresh:1,url=mesg_board.php');
    echo'請不要嘗試刪除別人的留言';
}
else{
$sql="DELETE FROM messages WHERE id = ? ";
$res=$link->prepare($sql);
$res->bind_param('s',$id);
$res->execute();
$result=$res->get_result();
//$result=mysqli_query($link,$sql);
    foreach (glob("file4mesg/$id.*") as $file){
        unlink($file);
        }
    header('refresh:1,url=mesg_board.php');
    echo'刪除成功 1s 後跳轉';

}
?>