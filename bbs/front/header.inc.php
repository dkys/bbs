<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./style/fegister.css">
    <link rel="stylesheet" href="/bbs/front/style/index.css">
    <link rel="stylesheet" href="/bbs/front/style/father_list.css">
</head>

<body>
<div class="top">
    <div class="top1">
        <div class="top_left">
            <a href="" class="logo">sansi</a>
            <a href="index.php">首页</a>
            <a href="">新帖</a>
            <a href="">话题</a>
        </div>
        <div class="serch">
        <form action="search.php" method="get">
            <input type="text" class="btn_top1" name="keywords" value="<?php if(isset($_GET['keywords'])){echo $_GET['keywords'];}  ?>" placeholder="搜索其实很简单"><input type="submit" class="btn_top bth_top2" value>
        </form>
        </div>
        <div class="top_right">
            <?php

            if($memeber_id){?>

                <a href="member.php?memberid=<?php echo $memeber_id; ?>" target="_blank">您好!<?php echo $_COOKIE['sansi']['name']; ?></a>
                <a href="loginout.php">退出</a>
              <?php
            }else{?>
                <a href="login.php" target="_block">登录</a>
                <a href="register.php">注册</a>

            <?php   } ?>

        </div>
    </div>
</div>