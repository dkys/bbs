<?php
include_once 'skip.login.php';
//var_dump(is_login());exit();
if(is_login()==true){
        skip('您已经登录过了亲!','father_admin.php');
        exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        skip('管理员名称不能为空!','login.php');
        exit();
    }
     if(strlen($_POST['pw'])<6){
        skip('密码不得小于6个字符!','login.php');
        exit();
    }
    session_start();
    if(!$_POST['vcode']==$_SESSION['vcode']){
        skip('验证码错误!','login.php');
        exit();
    }
    $sql = "select * from sansi_manage WHERE name='{$_POST['name']}'";
    $query = $link->query($sql);
    $rel = $query->fetch(PDO::FETCH_ASSOC);
    if($rel['pw']==md5($_POST['pw'])){
        setcookie('sansi[name]',$_POST['name'],time()+3600);
        setcookie('sansi[pw]',md5($_POST['pw']),time()+3600);
        setcookie('sansi[level]',$rel['level'],time()+3600);
        setcookie('sansi[id]',$rel['id'],time()+3600);
        skip('登录成功!','index.php');
        exit();
    }else{
        skip('登录失败!','login.php');
        exit();
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        .content {
            /*clear: both;*/
            width: 500px;
            margin: 10px auto;
            padding-bottom:50px;
            background: white;
        }
        .titless{
            margin-top: 55px;
        }
        .titless h2 {
            border-bottom: 1px solid #ededed;
            color: #666;
            font-size: 16px;
            padding: 10px 15px;
        }
        label{
            display:block;
            float:right;
            margin:25px 50px 0 0;
            color:#333333;
        }
        form label input {
            width: 230px;
            height: 18px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 2px #f0f0f0 inset;
            color: #333;
            font-family: inherit;
            font-size: 100%;
            line-height: 18px;
            margin-left: 5px;
            padding: 4px;
            vertical-align: middle;
        }
        span{
            display:inline-block;
            width:50px;
            margin:0 0 0 5px;
            color:#666;
        }
        .btn{
            display: block;
            margin-left:154px;
            margin-top:20px;
            background: #1b75b6;
            height: 30px;
            border: 0;
            color:white;
            width: 50px;
        }
        .content img{
            display:block;
            margin:20px 154px;
        }

    </style>
    <title>管理中心</title>
</head>
<body>
<div class="top">
    <div class="logo">
        管理中心
    </div>
    <a href="">
        <li>三思</li>
    </a>
    <a href="">
        <li>三思</li>
    </a>
    <div class="top_right">
        <a href="" style="color:white">网站首页</a>&nbsp;|&nbsp; 管理员: <?php if(is_login()==true){echo $_COOKIE['sansi']['name']."<a href=''>[注销]</a>";}else{echo "<a href=''>登录管理中心</a>";} ?>

    </div>
</div>
<div class="content">
    <div class="titless">
        <h2>管理员登录</h2>
    </div>
<form method="post">
    <label>用户名:<input type="text" name="name" placeholder="请填写用户名/手机号/邮箱"><span></span></label>
    <label>密码:<input type="password" name="pw" placeholder="请输入密码"><span></span></label>
    <label>验证码:<input type="text" name="vcode" placeholder="请输入下方的验证码"><span></span></label>
    <div style="clear:both;"></div>
    <img class="vcode" src="/bbs/front/show_code.php">
    <input class="btn" type="submit" value="登录" name="submit">
</form>
</div>
</body>
</html>