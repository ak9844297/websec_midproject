
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ADMIN</title>
<body>
<form method="post" enctype="multipart/form-data" action="change.php">
  <input type="text" id="newtitle" name="newtitle">
  <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
  <input type="submit" value="輸入新首頁標題">
</form>
</br><a href='logout.php'>登出</a>
</body></html>