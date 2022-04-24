<?php
session_start(); 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留下留言吧</title>
<body>
<form method="post" enctype="multipart/form-data" action="upmesg.php">
<div class="mesgs">
<lable for="content">留言內容<lable>
</br>
<textarea class="form-control" id="content" name="content" rows="10"></textarea>
</div>
<input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
<input type="file" name="my_file">
<input type="submit" value="上傳!">
</form>
<form method='post' action="mesg_board.php" >
    <button type='submit'>返回留言板</button>
</form>
</body></html>