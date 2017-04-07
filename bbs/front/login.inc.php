<?php
if(empty($_POST['name'])){
    skip('用户名不能为空!','login.php');
    exit();
}
if(mb_strlen($_POST['name'])>30){
    skip('用户名不能超过30个字符!','login.php');
    exit();
}
if(empty($_POST['pwd'])){
    skip('密码不能为空!','login.php');
    exit();
}
if(mb_strlen($_POST['pwd'])<6){
    skip('密码不能少于6个字符!','login.php');
    exit();
}
if(strtolower($_POST['vcode']) != strtolower($_SESSION['vcode'])){
    skip('验证码错误!','login.php');
    exit();
}
if(empty($_POST['time']) || !is_numeric($_POST['time']) || $_POST['time'] > 604800){
    $_POST['time'] = 604800;
}

?>