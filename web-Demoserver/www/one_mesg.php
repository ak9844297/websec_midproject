<?php
$id=$_POST['id'];
$c=$_POST['date'];
require_once('config.php');
//$sql = "SELECT * FROM `messages` WHERE `id`=$id ";
$sql = ('SELECT * FROM `messages` WHERE `id` = ?');
$res=$link->prepare($sql);
$res->bind_param('s',$id);
$res->execute();
$res1=$res->get_result();
//$res1= mysqli_query($link,$sql);
$result=mysqli_fetch_row($res1);
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
		'<img src="$1" alt="" />'
	);
	return preg_replace($find,$replace,$text);
}

$f=$result[1];
        $result[1]  = htmlspecialchars($result[1], ENT_QUOTES, $charset);
        $sql2 = ('SELECT * FROM `users` WHERE `username` = ?');
        $res2=$link->prepare($sql2);
        $res2->bind_param('s',$f);
        $res2->execute();
        $result2=$res2->get_result();
 $res2=mysqli_fetch_row($result2);
$a=$result[1];
echo"<p style =\"text-align : center\">看看你選擇的留言:";
echo"<table class=\"center\" border = '2'><tr style=\"text-align : center\">";
echo "<tr></br>";
echo "<td>$a";
if(file_exists("photo/$a.png"))
{
echo "<div class=\"circle\"><img src=\"photo/$a.png\"/></div></td>";
}
else if(file_exists("photo/$res2[0].png"))
{
echo "<div class=\"circle\"><img src=\"photo/$res2[0].png\"/></div></td>";
}
else{
echo"</td>";
}
$bbtext = $result[2];
$htmltext = showBBcodes($bbtext);
echo "<td> $htmltext </td>";
echo "<td> $c </td>";
echo "</table>";
echo "</br>附加檔案:</br>";
if(glob("file4mesg/$id.*")){
foreach (glob("file4mesg/$id.*") as $file){
   // echo "$file</p>";
    }
    $tmp=$file;
$tmp=substr("$tmp",0,-4);
 echo"<a href=\"https://demo.fangs.works/$file\" download=\"$tmp\">下載附件</a>";
}

else{
	echo"沒有附加檔案";
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>這是單一留言</title>
 <style>
    .center {
  margin-left: auto;
  margin-right: auto;
}
    .circle {
        width: 100px;
        height:100px;
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
</form>
</html>