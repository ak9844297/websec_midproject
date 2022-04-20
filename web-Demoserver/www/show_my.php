<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
require_once('config.php');
function showBBcodes($text) {
	$text  = htmlspecialchars($text, ENT_QUOTES, $charset);
	$find = array(
		'~\[b\](.*?)\[/b\]~s',
		'~\[i\](.*?)\[/i\]~s',
		'~\[u\](.*?)\[/u\]~s',
		'~\[quote\](.*?)\[/quote\]~s',
		'~\[size=(.*?)\](.*?)\[/size\]~s',
		'~\[color=(.*?)\](.*?)\[/color\]~s',
		'~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
		'~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
	);
	$replace = array(
		'<b>$1</b>',
		'<i>$1</i>',
		'<span style="text-decoration:underline;">$1</span>',
		'<pre>$1</'.'pre>',
		'<span style="font-size:$1px;">$2</span>',
		'<span style="color:$1;">$2</span>',
		'<a href="$1">$1</a>',
		'<img src="$1" alt="" />'
	);
	return preg_replace($find,$replace,$text);
}
$username=$_SESSION["username"];
$sql = "SELECT * FROM `messages` WHERE `username`='$username';";
$result= mysqli_query($link,$sql);
echo"<p style =\"text-align : center\">看看你留了什麼言~:";
echo"<table class=\"center\" border = '2'><tr style=\"text-align : center\">";
$meta = mysqli_fetch_field($result);
while ($meta = mysqli_fetch_field($result)) {
    echo "<td> $meta->name </td>";
}
echo"<td> 刪除</td>";
echo"</tr>";
while($row=mysqli_fetch_row($result)) {
        echo "<tr></br>";
             echo "<td> $row[1]";
            if(file_exists("photo/$row[1].png"))
    {
echo "<div class=\"circle\"><img src=\"photo/$row[1].png\"/></div></td>";
    }
    else{
        echo"</td>";
    }
    $bbtext = $row[2];
    $htmltext = showBBcodes($bbtext);
    echo "<td> $htmltext </td>";
    echo "<td> $row[3] </td>";
    echo"<td><form method=post action=\"delete.php\">";
    echo"<input type='hidden' id=\"id\" name=\"id\" value=$row[0]>";
    echo"<input type='hidden' id=\"username\" name=\"username\" value=$row[1]>";
    echo"<input type='hidden' id=\"text\" name=\"text\" value=$row[2]>";
    echo"<input type='hidden' id=\"date\" name=\"date\" value=$row[3]>";
    echo"<button type='submit'>刪除此留言</button></form></td>";
}
echo "</table></p>";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>這是你的留言</title>
 <style>
    .center {
  margin-left: auto;
  margin-right: auto;
}
    .circle {
        width: 50px;
        height:50px;
        border-radius:50%; 
        margin-left: auto;
  margin-right: auto;
        overflow:hidden;
    }
    .circle > img{
        width: 100%;
        height: 100%;
    }
 </style>
</head>
<body style="text-align : center">
<form method='post' action="mesg_board.php" >
    <button type='submit'>返回留言板</button>
</form>
</body>
</html>