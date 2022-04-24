<?php
# 檢查檔案是否上傳成功
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
function file_get_contents_curl($url) {
    $ch = curl_init();
  
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
  
    $data = curl_exec($ch);
    curl_close($ch);
  
    return $data;
}
$dest=$_POST['my_url'];
$data = file_get_contents_curl($dest);      
    $fp = $_SESSION['id'].'.png';   
    file_put_contents('photo/'.$fp, $data );
    header("refresh:1,url=welcome.php");
    echo "上傳頭貼成功";
?>