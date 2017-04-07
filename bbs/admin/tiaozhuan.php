<?php
$name = $_GET['name'];
$url = $_GET['url'];//urldecode:对已经编码的url进行解码/但是到这个页面浏览器自动为其解码 也就不需要在操作解码
//echo $name.$url;
if(!isset($name) || !isset($url)){
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>跳转页面</title>
    <style>
        a{
            text-decoration: none;
        }
        .div1{
            width:100%;
            text-align: center;
            margin-top: 20px;
            border-top:1px solid #ededed;
            border-bottom: 1px solid #ededed;
            padding:15px 0px;
        }
        span{
            display:inline-block;
            width:16px;
            height:16px;
            background: url('/bbs/img/small.png') -60px 0 no-repeat;
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
    <span></span>你确定要删除:"<?php echo $name; ?> 这个版块"吗?
    <a class="a1" href="<?php echo $url; ?>">确定</a>|<a href="father_admin.php">取消</a>
</div>
</body>
</html>
