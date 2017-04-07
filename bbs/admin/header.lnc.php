<?php
//var_dump($_SERVER);

//if(basename($_SERVER["SCRIPT_NAME"])== ""){echo "class='dian'";}else{echo "class='dian1'";} //basename():从路径中取出文件名
//$_SERVER 是一个超全局变量 里面涵盖了很信息 //

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="index.css">
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
        <a href="/bbs/front/index.php" style="color:white">网站首页</a>&nbsp;|&nbsp;<?php if(is_login()==true){echo " 管理员:{$_COOKIE['sansi']['name']} <a href='out_login.inc.php'>[注销]</a>";}else{echo "<a href='login.php'>登录管理中心</a>";} ?>
    </div>
</div>
<div class="left">
    <div class="list_1">系统</div>
    <ul class="list_a">
        <li id="ss"><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "index.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="index.php">系统信息</a></li>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "manage.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="manage.php">管理员</a></li>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "manage_add.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="manage_add.php">添加管理员</a></li>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "web_set.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="web_set.php">站点设置</a></li>
    </ul>
    <div class="list_2">内容管理</div>
    <ul class="list_b">
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "father_admin.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="father_admin.php">父板块列表</a></li>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "father_add.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="father_add.php">添加父板块</a></li>

        <?php if(basename($_SERVER["SCRIPT_NAME"])== "father_update.php"){echo "<li><a class='dian' href=''>编辑父板块</a></li>";} ?>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "son_list.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="son_list.php">子版块列表</a></li>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== "son_add.php"){echo "class='dian'";}else{echo "class='dian1'";} ?> href="son_add.php">添加子版块</a></li>
        <?php if(basename($_SERVER["SCRIPT_NAME"])== "son_update.php"){echo "<li><a class='dian' href=''>编辑子板块</a></li>";} ?>
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== ""){echo "class='dian'";}else{echo "class='dian1'";} ?> href="/bbs/front/index.php?admim=<?php echo is_login(); ?>" target="_blank">帖子管理</a></li>
    </ul>
    <div class="list_3">用户管理</div>
    <ul class="list_c">
        <li><a <?php if(basename($_SERVER["SCRIPT_NAME"])== ""){echo "class='dian'";}else{echo "class='dian1'";} ?> href="">用户列表</a></li>
    </ul>
</div>