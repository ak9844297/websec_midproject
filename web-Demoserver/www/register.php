<?php
session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body style="text-align: center;">
<h2>輸入要註冊的帳號和密碼</h2>
<form method="POST" action="sign.php">
    <input id="token" name="token"type="hidden" value="<?php echo $_SESSION['csrftoken']?>">
    <input id="username" placeholder="帳號" required="" autofocus="" type="text" name="username">
    <input id="password" placeholder="密碼" required="" type="password" name="password">
    <button  type="submit">註冊</button>
</form>
<a href='index.php'>回到登入介面</a>
</body>
</html>