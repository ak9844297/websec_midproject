<?php
session_start();
if(!$_SESSION['csrftoken']){
$_SESSION['csrftoken']=md5(uniqid(mt_rand(),true));
}
if(isset($_SESSION["adloggedin"]) && $_SESSION["adloggedin"] === true){
    header("locaton:admin.php");
    exit;
}
else if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit; 
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留言板登入處</title>
<style>
    .center {
  margin-left: auto;
  margin-right: auto;
}
 </style>
</head>
<body style="text-align : center">
    <h1>😭拜託各位30cm金城武跟E罩杯女神不要打我😭</h1>
    <h2>選擇登入或是註冊</h2>
<form method="POST" action="login.php">
    <input id="token" name="token"type="hidden" value="<?php echo $_SESSION['csrftoken']?>">
    <input id="username" placeholder="Username" required="" autofocus="" type="text" name="username">
    <input id="password" placeholder="Password" required="" type="password" name="password">
    <button  type="submit">登入</button>
</form>
<form method='post' action="register.php">
     還沒有帳號ㄇ 請註冊
    <button type='submit'>註冊</button>
</body>
</form>
</html>