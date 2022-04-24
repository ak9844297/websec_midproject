<?php
session_start(); 
$username=$_SESSION['username'];
$text=$_POST['content'];
$token=$_SESSION['token'];
$token2=$_POST['token'];
if(!$token||$token2!=$token){
    header("Location: index.php");
}
$date=date("Y-m-d");
$text=str_replace("'","\'",$text);
require_once('config.php');
//$text=htmlspecialchars($text, ENT_QUOTES, $charset);
mysqli_query($link,"INSERT INTO `messages` (`username`, `text`, `time`) VALUES ('$username','$text','$date');");
$sql = "SELECT * FROM `messages`;";
$result= mysqli_query($link,$sql);
$num= mysqli_num_rows($result);
for($i=0;$i<$num;$i++){
    $tmp=mysqli_fetch_row($result);
}
$me=$tmp[0];
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK){
    //echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
    //echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
    //echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
    //echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';
    $ext = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION); 
    $_FILES['my_file']['name']=$me.'.'.$ext.'.txt';
    $file = $_FILES['my_file']['tmp_name'];
    $dest = 'file4mesg/' . $_FILES['my_file']['name'];
    move_uploaded_file($file, $dest);
}
//echo"$text";
header("refresh:1,url=welcome.php");
echo "上傳留言成功";

?>