<?php
session_start();  //很重要，可以用的變數存在session裡
$fpath="title.txt";
$title=file_get_contents($fpath);
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
$username=$_SESSION["username"];
$username=htmlspecialchars($username, ENT_QUOTES, $charset);
$title=htmlspecialchars($title, ENT_QUOTES, $charset);
$name=$_SESSION['id'];
echo "<h1>你好 ".$username."</h1>";
if(file_exists("photo/$username.png"))
{
echo "<img src=\"photo/$username.png\" width=\"300px\" heigh=\"200px\">";
}
else if(file_exists("photo/$name.png"))
{
echo "<img src=\"photo/$name.png\" width=\"300px\" heigh=\"200px\">";
}
else{
  echo '你還沒有大頭貼喔!';
}
echo "</br><a href='logout.php'>登出</a> <a href='mesg_board.php'>前往留言板</a>";
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo$title?></title>
<body>
<form method="post" enctype="multipart/form-data" action="upload.php">
  <input type="file" name="my_file" accept="image/*">
  <input type="submit" value="上傳頭貼檔">
</form>
<form method="post" enctype="multipart/form-data" action="upviaurl.php">
  <input type="url" id="my_url" name="my_url" placeholer='https://example.jpg' required >
  <input type="submit" value="透過網址上傳頭貼">
</form>
</body></html>