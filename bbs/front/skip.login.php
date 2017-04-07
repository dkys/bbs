<?php
function skip($message,$url){
$html =<<<A
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url={$url}">
    <title>正在跳转中...</title>
    <style>
        a{
            text-decoration: none;
        }
        .div1{
            width:100%;
            text-align: center;
            margin-top: 50px;
            border-top:1px solid #ededed;
            border-bottom: 1px solid #ededed;
            padding:15px 0px;
        }
        span{
            display:inline-block;
            width:16px;
            height:16px;
            background: url('/bbs/img/small.png') -40px -20px no-repeat;
        }
        .div1 .a1{
            color:red;
        }
        .div1 a{
            margin: 0px 10px;
        }
    </style>
</head>
<body>
<div class="div1">
    <span></span><bb><a href='publish.php'>{$message}</a><a href="{$url}">3秒后自动跳转</a></bb>
</div>
</body>
</html>
A;
    echo $html;
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
function is_login($link){
    if(isset($_COOKIE['sansi']['name']) && isset($_COOKIE['sansi']['pwd'])){
        $sql2 = "select * from sansi_members where name='{$_COOKIE['sansi']['name']}' and sha1(pwd)='{$_COOKIE['sansi']['pwd']}'";
        $query2 = mysqli_query($link,$sql2);
        if(mysqli_num_rows($query2)==1){
            $date = mysqli_fetch_assoc($query2);
        return $date['id'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}
//skip();

?>