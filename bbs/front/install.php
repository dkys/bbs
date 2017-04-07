<?php
//var_dump($_POST);
if(isset($_POST['submit'])){
//    var_dump($table_sql);
    if(empty($_POST['db_host'])){
        exit('数据库主机地址不能为空!<a href="install.php">点击返回</a>');
    }
     if(empty($_POST['db_port'])){
        exit('端口号不能为空!<a href="install.php">点击返回</a>');
    }
    if(empty($_POST['db_user'])){
        exit('数据库用户名不能为空!<a href="install.php">点击返回</a>');
    }
     if(empty($_POST['db_pwd'])){
        exit('密码不能为空!<a href="install.php">点击返回</a>');
    }
    if(empty($_POST['db_name'])){
        exit('数据库名称不能为空!<a href="install.php">点击返回</a>');
    }
    $_POST['manage_name']='admin';
    if(empty($_POST['manage_pwd'])){
        exit('管理员密码不能为空!<a href="install.php">点击返回</a>');
    }
    if(strlen($_POST['manage_pwd'])<6){
        exit('管理员密码不得少于6个字符!<a href="install.php">点击返回</a>');
    }
    if($_POST['manage_pwd']!=$_POST['manage_pwd_confirm']){
        exit('两次输入的密码不相符!<a href="install.php">点击返回</a>');
    }
$link = @mysqli_connect($_POST['db_host'],$_POST['db_user'],$_POST['db_pwd'],'',$_POST['db_port']);
    if(mysqli_connect_errno()){
        exit('数据库连接失败,请填写正确的数据库信息!<a href="install.php">点击返回</a>');
    }
    mysqli_set_charset($link,'utf8');
    if(!mysqli_select_db($link,$_POST['db_name'])){
        $sql = "CREATE DATABASE IF NOT EXISTS `{$_POST['db_name']}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
        mysqli_query($link,$sql);
        if(mysqli_error($link)){
            exit('数据库创建失败,请检查数据库账户权限!<a href="install.php">点击返回</a>');
        }
    }
    $table_sql = array();
    $table_sql['sansi_content']="
        CREATE TABLE IF NOT EXISTS `sansi_content` (
          `id` int(10) UNSIGNED NOT NULL COMMENT '帖子的id',
          `son_id` int(10) UNSIGNED NOT NULL COMMENT '子板块id',
          `title` varchar(255) NOT NULL COMMENT '帖子标题',
          `content` text NOT NULL COMMENT '帖子内容',
          `time` datetime NOT NULL COMMENT '发帖时间',
          `member_id` int(11) NOT NULL COMMENT '会员id',
          `times` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子浏览次数'
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='发帖信息'
    ";
    $table_sql['sansi_info']="
        CREATE TABLE IF NOT EXISTS `sansi_info` (
          `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
          `title` varchar(255) DEFAULT NULL COMMENT '网站标题',
          `keywords` varchar(255) DEFAULT NULL COMMENT '网站关键字',
          `description` varchar(255) DEFAULT NULL COMMENT '网站描述'
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站设置表'
    ";
    $table_sql['sansi_manage']="
        CREATE TABLE IF NOT EXISTS `sansi_manage` (
          `id` int(10) UNSIGNED NOT NULL COMMENT '管理员id',
          `name` varchar(32) NOT NULL COMMENT '管理员账号',
          `pw` varchar(32) NOT NULL COMMENT '管理员密码',
          `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '管理员创建时间',
          `level` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '管理员权限1:普通管理员0:超级管理员'
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员信息表'
    ";
    $table_sql['sansi_members']="
        CREATE TABLE IF NOT EXISTS `sansi_members` (
          `id` int(10) UNSIGNED NOT NULL COMMENT '会员id号',
          `name` varchar(30) NOT NULL COMMENT '会员登录账号',
          `pwd` varchar(32) NOT NULL COMMENT '会员登录密码',
          `photo` blob,
          `register_time` datetime NOT NULL COMMENT '注册时间',
          `last_time` datetime NOT NULL COMMENT '最后登录时间'
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员信息表'
    ";
    $table_sql['sansi_reply']="
        CREATE TABLE IF NOT EXISTS `sansi_reply` (
          `re_id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
          `content_id` int(10) UNSIGNED NOT NULL COMMENT '帖子的id',
          `quote_id` int(10) UNSIGNED NOT NULL COMMENT '回复的对象id',
          `recontent` varchar(5000) DEFAULT NULL COMMENT '回复内容',
          `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '回复时间',
          `member_id` int(10) UNSIGNED NOT NULL
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子回复表'
    ";
    $table_sql['sansi_son_admin']="
        CREATE TABLE IF NOT EXISTS `sansi_son_admin` (
          `id` int(10) UNSIGNED NOT NULL COMMENT '子版块id',
          `father_id` int(10) UNSIGNED NOT NULL COMMENT '父板块外键',
          `son_name` varchar(50) NOT NULL COMMENT '子版块名称',
          `intro` varchar(300) NOT NULL COMMENT '子版块简介',
          `vip_id` int(10) UNSIGNED NOT NULL COMMENT '会员id',
          `sort` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='子板块'
    ";
    $table_sql['sansi_user_admin']="
        CREATE TABLE IF NOT EXISTS `sansi_user_admin` (
          `id` int(11) NOT NULL COMMENT '板块id',
          `name` varchar(30) NOT NULL COMMENT '父板块名称',
          `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='父板块'
    ";
    foreach($table_sql as $key=>$value){
        mysqli_query($link,$value);
        if(mysqli_error($link)){
            echo "{$key}数据表创建失败,请检查数据库是否有创建表的权限!<a href=\"install.php\">点击返回</a>";
        }
    }
    $sql = "select * from sansi_manage WHERE name='admin'";
    $query = mysqli_query($link,$sql);
    if(mysqli_num_rows($query) !=1){
        $sql = "insert into sansi_manage(name,pw,level) VALUES ('{$_POST['manage_name']}',md5({$_POST['manage_pwd']}),0)";
//        var_dump($sql);
        mysqli_query($link,$sql);
        if(mysqli_error($link)){
            exit('管理员创建失败,请检查数据表sansi_manage是否有写入权限!<a href="install.php">点击返回</a>');
        }
    }
}




?>












<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎使用 本引导程序</title>
    <style>
        body{
            background: #f4f4f4;
            margin: 0;
            padding: 30px 0;
        }
        .center{
            padding: 10px 30px;
            width:900px;
            margin: 0 auto;
            background: white;
        }
        .banner{
            /*margin:10px;*/
            border-bottom: 1px dashed #ddd;
            padding-bottom: 10px;
        }
        .banner span{
            /*text-align:center;*/
            height: 30px;
            font-size: 20px;
            line-height: 30px;
        }
        .table,.table2{
            /*border: 1px #006cff solid;*/
            margin: 0 auto;
            margin-right: 300px;
            width: 400px;
            text-align: right;
        }
        .table2{
            margin-top: 30px;
        }
        .table input{
            width: 250px;
            height: 30px;
            margin:5px 0 ;
        }
        .table2 input{
            width: 250px;
            height: 30px;
            margin:5px 0 ;
        }
    </style>
</head>
<body>
<div class="center">
    <div class="banner">
        <span>欢迎使用 本引导程序</span>
    </div>
    <form action="" method="post">
    <table class="table">
    <tr>
        <td>数据库地址:</td>
        <td><input type="text" name="db_host" placeholder="请输入数据库地址"></td>
    </tr>
    <tr>
        <td>端口号:</td>
        <td><input type="text" name="db_port" placeholder="请输入数据库端口号"></td>
    </tr>
    <tr>
        <td>数据库用户名:</td>
        <td><input type="text" name="db_user" placeholder="请输入数据库用户名"></td>
    </tr>
    <tr>
        <td>数据库密码:</td>
        <td><input type="password" name="db_pwd" placeholder="请输入数据库登录密码"></td>
    </tr>
    <tr>
        <td>数据库名称:</td>
        <td><input type="text" name="db_name" placeholder="请输入要使用的数据库名称"></td>
    </tr>
    </table>
    <table class="table2">
    <tr>
        <td>后台管理员名称:</td>
        <td><input type="text" name="manage_name" readonly="readonly" value="admin" placeholder="请输入管理员名称"></td>
    </tr>
    <tr>
        <td>密码:</td>
        <td><input type="password" name="manage_pwd" placeholder="管理员密码"></td>
    </tr>
    <tr>
        <td>确认密码:</td>
        <td><input type="password" name="manage_pwd_confirm" placeholder="确认密码"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" style="width:254px;height: 34px;" value="确认安装"></td>
    </tr>
    </table>
    </form>
</div>
</body>
</html>