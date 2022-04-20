<?php
if( !isset($_POST['username']) || !isset($_POST['password']) || $_POST['username']=="" || $_POST['password']=="" ){
    header("Location: register.html");
}
$username = $_POST['username'];
$password = $_POST['password'];

require_once('config.php');
$sql = ('SELECT * FROM `users` WHERE `username` = ?');
$res=$link->prepare($sql);
$res->bind_param('s',$username);
$res->execute();
$result=$res->get_result();
//$result1=mysqli_query($link,$sql);
try {
    $row = mysqli_fetch_array($result);     
    if($row){
        echo '已經存在此帳號';
    }else{
        $sql2=('INSERT INTO `users` (`username`, `password`) VALUES (?, ?)');
        $res2=$link->prepare($sql2);
        $res2->bind_param('ss',$username,$password);
        $res2->execute();
        header('refresh:1,url=index.php');
        echo'註冊成功 1s 後跳轉';
       // mysqli_query($link,"INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$password');");
    }
    mysqli_close($link);
}
catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), '<br>';
    echo 'Check credentials in config file at: ', $Mysql_config_location, '\n';
}
?>

