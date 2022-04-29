<?php
# 檢查檔案是否上傳成功
session_start();
$token=$_SESSION['token'];
$token2=$_POST['token'];
if(!$token||$token2!=$token){
    echo"wrongtoken";
}
{
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
$d=$_POST['my_url'];
function validate_url($url) {
    $path         = parse_url($url, PHP_URL_PATH);
    $encoded_path = array_map('urlencode', explode('/', $path));
    $url          = str_replace($path, implode('/', $encoded_path), $url);
    return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
}
$a=strpos($d,"https://");
$b=strpos($d,"http://");
if($a===false){
    header("refresh:1,url=welcome.php");
    echo "$dest $a 上傳頭貼失敗 url 不合法";
}
else if($b===false){
    header("refresh:1,url=welcome.php");
    echo "$dest $a 上傳頭貼失敗 url 不合法";
}
else{
$data = file_get_contents_curl($dest);      
    $fp = $_SESSION['id'].'.png';   
    file_put_contents('photo/'.$fp, $data );
    header("refresh:1,url=welcome.php");
    echo "上傳頭貼成功";
}
}
?>