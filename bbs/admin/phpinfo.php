<?php
include_once 'skip.login.php';
//var_dump(is_login());exit();
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
echo phpinfo();


?>