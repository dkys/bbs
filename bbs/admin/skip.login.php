<?php
function skip($message,$url){
//    $message = $_GET['message'];
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
    <span></span><bb>{$message}<a href="{$url}">3秒后自动跳转</a></bb>
</div>
</body>
</html>
A;
    echo $html;
}

function is_login(){
    $link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
    if(isset($_COOKIE['sansi']['name']) && isset($_COOKIE['sansi']['pw'])){
//    var_dump($_COOKIE);exit;
        $sql = "select COUNT(*) from sansi_manage WHERE name='{$_COOKIE['sansi']['name']}' AND pw='{$_COOKIE['sansi']['pw']}'";
//        var_dump($sql);
        $query = $link->query($sql);
//    $rel = $query->fetch()
//        echo $query->fetchColumn();
        if($query->fetchColumn()==1){
            return true;
        }else{
            return false;
        }
    }
}

?>