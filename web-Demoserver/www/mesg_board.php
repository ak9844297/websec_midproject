<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("Location: index.php");
}
require_once('config.php');
$sql = "SELECT * FROM `messages`;";
$result= mysqli_query($link,$sql);
function showBBcodes($text) {
	$text  = htmlspecialchars($text, ENT_NOQUOTES, $charset);
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
		'<img style="max-height:200px; max-width:200px;" src="$1" alt="" />'
	);
	return preg_replace($find,$replace,$text);
}
$num=mysqli_num_rows($result);
if(!$num){
    echo"<p style=\"text-align : center\">還沒有人留言喔!!!!</p>";
}
else{
echo"<table class=\"center\" border = '2'><tr style=\"text-align : center\">";
$meta = mysqli_fetch_field($result);
while ($meta = mysqli_fetch_field($result)) {
    echo "<td> $meta->name </td>";
}
echo"<td> 查看</td>";
echo"</tr>";

while($row=mysqli_fetch_row($result)) {

        echo "<tr></br>";
        $f=$row[1];
        $row[1]  = htmlspecialchars($row[1], ENT_QUOTES, $charset);
        $sql2 = ('SELECT * FROM `users` WHERE `username` = ?');
        $res2=$link->prepare($sql2);
        $res2->bind_param('s',$f);
        $res2->execute();
        $result2=$res2->get_result();
        $res2=mysqli_fetch_row($result2);
             echo "<td> $row[1]";
            if(file_exists("photo/$row[1].png"))
    {
echo "<div class=\"circle\"><img src=\"photo/$row[1].png\"/></div></td>";
    }
    else if(file_exists("photo/$res2[0].png"))
    {
echo "<div class=\"circle\"><img src=\"photo/$res2[0].png\"/></div></td>";
    }
    else{
        echo"</td>";
    }
    //$row[2]=htmlspecialchars_decode(row[2]);
    $bbtext = $row[2];
    $htmltext = showBBcodes($bbtext);
    echo "<td> $htmltext </td>";
    echo "<td> $row[3] </td>";
    echo"<td><form method=post action=\"one_mesg.php\">";
    echo"<input type='hidden' id=\"id\" name=\"id\" value=$row[0]>";
    echo"<input type='hidden' id=\"date\" name=\"date\" value=$row[3]>";
    echo"<button type='submit'>查看此留言</button></form></td>";
}
echo "</table></p>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>這是留言板</title>
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
<form method='post' action="leave_comment.php" >
        想要說些甚麼嗎?
<button type='submit'>留下留言</button>
</form>
<form method='post' action="show_my.php" >
        看看你說了什麼
    <button type='submit'>查看留言</button>
</form>
<form method='post' action="welcome.php" >
    回到開始介面
    <button type='submit'>返回</button>
</form>
</body>
</html>