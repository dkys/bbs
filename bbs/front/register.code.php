<?php
if(empty($_POST['name'])){
skip('用户名不能为空','register.php');
    exit();
}
if(mb_strlen($_POST['name'])>30){
    skip('用户名不能大于30个字符','register.php');
    exit();
}
if(mb_strlen($_POST['pwd'])<6){
    skip('密码不能少于6位字符','register.php');
    exit();
}
if($_POST['pwd'] != $_POST['affirm_pwd']){
    skip('两次密码输入不一致,请重新输入!','register.php');
    exit();
}
if(strtolower($_POST['code']) != strtolower($_SESSION['vcode'])){
    skip('验证码输入错误,请返回重试!','register.php');
    exit();
}
?>