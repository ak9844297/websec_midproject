<?php
# 檢查檔案是否上傳成功
session_start();
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK){
  //echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
  //echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
  //echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
  //echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';
  # 檢查檔案是否已經存在
  //$name=htmlspecialchars($_SESSION["username"], ENT_QUOTES, $charset);
  $name=$_SESSION['id'];
  $_FILES['my_file']['name']=$name.'.'.'png';
  $ext = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION); 
  if (file_exists('photo/' . $_FILES['my_file']['name'])){
    unlink('photo/'.$_FILES['my_file']['name']);
    $file = $_FILES['my_file']['tmp_name'];
    $dest = 'photo/' . $_FILES['my_file']['name'];
    move_uploaded_file($file, $dest);
    header("refresh:1,url=welcome.php");
    echo "更新頭貼成功";
  } else {
    $file = $_FILES['my_file']['tmp_name'];
    $dest = 'photo/' . $_FILES['my_file']['name'];
    # 將檔案移至指定位置
    move_uploaded_file($file, $dest);
    header("refresh:1,url=welcome.php");
    echo "上傳頭貼成功";
  }
} else {
  echo '錯誤代碼：' . $_FILES['my_file']['error'] . '<br/>';
}
?>