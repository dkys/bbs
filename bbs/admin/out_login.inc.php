<?php
include_once 'skip.login.php';
if(is_login()==true){
    setcookie('sansi[name]','',time()-1);
    setcookie('sansi[pw]','',time()-1);
    setcookie('sansi[level]','',time()-1);
    skip('退出成功!','login.php');
    exit();
}






?>