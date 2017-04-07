<?php
session_start();
include_once "skip.login.php";
if(is_login($link)){
    skip('您已经登录,请不要重复登录!','register.php');
    exit();
}
//var_dump($_COOKIE);
if(isset($_POST['submit'])){
    include_once "register.code.php";
    $link = mysqli_connect('localhost','root','123456','sansi_admin');
    $sql1 = "select * from sansi_members where name='{$_POST['name']}'";
    $query = mysqli_query($link,$sql1);
    if(mysqli_affected_rows($link) == 1){
        skip('用户名已存在,请换一个!','register.php');
        exit();
    }
    $sql = "insert into sansi_members(name, pwd, register_time) values ('{$_POST['name']}',md5('{$_POST['pwd']}'),now())";
    $query = mysqli_query($link,$sql);
    if(mysqli_affected_rows($link) == 1){
		setcookie('sansi[name]',$_POST['name']);
		setcookie('sansi[pwd]',sha1(md5($_POST['pwd'])));
        skip('恭喜你注册成功!','index1.php');
    }else{
        skip('sorry,注册失败!请重试!','register.php');
    }
}
//curl_escape()对特殊字符进行转义



?>






<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>欢迎注册</title>
    <link rel="stylesheet" href="./style/fegister.css">
</head>

<body>
	<div class="top">
		<div class="top1">
			<div class="top_left">
				<a href="" class="logo">sansi</a>
				<a href="">首页</a>
				<a href="">新帖</a>
				<a href="">话题</a>
			</div>
			<div class="serch">
			<form action="">
				<input type="text" class="btn_top1" placeholder="搜索其实很简单"><input type="submit" class="btn_top bth_top2" value>
			</form>
			</div>
			<div class="top_right">
				<a href="">登录</a>
				<a href="">注册</a>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="title">
			<h2>欢迎注册成为 三思会员</h2>
		</div>
		<form method="post">
			<label>用户名:<input type="text" name="name" placeholder="请填写用户名/手机号/邮箱"><span>*用户名不能为空，并且不能超过30个字符</span></label>
			<label>密码:<input type="password" name="pwd" placeholder="请输入密码"><span>*密码不能少于6位</span></label>
			<label>确认密码:<input type="password" name="affirm_pwd" placeholder="请重复输入密码"><span>*请输入与上方一致</span></label>
			<label>验证码:<input type="text" name="code" placeholder="请输入验证码"><span>*请输入下方验证码</span></label>
            <div style="clear:both;"></div>
            <img class="vcode" src="show_code.php">
			<input class="btn" type="submit" value="确定注册" name="submit">
		</form>
	</div>
</body>

</html>