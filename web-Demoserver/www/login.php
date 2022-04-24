<?php
if( !isset($_POST['username']) || !isset($_POST['password']) || $_POST['username']=="" || $_POST['password']=="" ){
    header("Location: index.php");
}
$username = $_POST['username'];
$password = $_POST['password'];

require_once('config.php');
$sql=('SELECT * FROM `users` WHERE `username` = ? and `password` = ?');
$adm=('SELECT * FROM `admin` WHERE `name` = ? and `pass` = ?');
$res=$link->prepare($sql);
$res->bind_param('ss',$username,$password);
$res->execute();
$result=$res->get_result();
//$sql = "SELECT * FROM `users` WHERE `username` = '$username' and `password` = '$password';";
//$adm="SELECT * FROM `admin` WHERE `name` = '$username' and `pass` = '$password';";
//$res2=$link->prepare($sql);
//$res2->bind_param('ss',$username,$password);
$username = $_POST['username'];
$password = $_POST['password'];
$tmp=$link->prepare($adm);
$tmp->bind_param('ss',$username,$password);
$tmp->execute();
$res2=$tmp->get_result();
mysqli_close($link);
try {
    $row = mysqli_fetch_array($result);
    $isad= mysqli_fetch_array($res2);   
    if($isad){
        session_start();
        $_SESSION["adloggedin"] = true;
        header("location:admin.html");
    }
    else if($row){ 
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION['token']=md5(uniqid(mt_rand(),true));
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        header("location:welcome.php");
        
    }else{
        header("refresh:1,url=index.php");
        echo '登入失敗';
    }
}
catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), '<br>';
    echo 'Check credentials in config file at: ', $Mysql_config_location, '\n';
}
?>