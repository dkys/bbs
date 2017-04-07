<?php
include_once "skip.login.php";
$link = mysqli_connect('localhost','root','123456','sansi_admin');
if(!$memeber_id = is_login($link)) {
    skip('您没有登录,不需要退出!', 'index.php');
    exit();
}else{
    setcookie('sansi[name]','',time()-1);
    setcookie('sansi[pwd]','',time()-1);
    skip('退出成功!','index.php');
}



?>