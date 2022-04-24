<?php
 session_start();
 $token=$_SESSION['token'];
echo"<td><form method=post action=\"logout.php\">";
echo"<input type='hidden' id=\"token\" name=\"token\" value=$token>";
echo"<button type='submit'>登出</button></form></td>";
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ADMIN</title>
<body>
<form method="post" enctype="multipart/form-data" action="change.php">
  <input type="text" id="newtitle" name="newtitle">
  <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
  <input type="submit" value="輸入新首頁標題">
</form>
</body></html>