<?php
$title = "欢迎登录";
session_start();
include_once "skip.login.php";
$link = mysqli_connect('localhost','root','123456','sansi_admin');
if($memeber_id = is_login($link)){
    skip('您已登录,请不要重复登录!','index.php');
    exit();
}
include_once "header.inc.php";
if(isset($_POST['submit'])){
   include_once "login.inc.php";
//    mysqli_query($link,$_POST);
    $sql = "select * from sansi_members where name='{$_POST['name']}' and pwd=md5('{$_POST['pwd']}')";
    $query = mysqli_query($link,$sql);
    if(mysqli_num_rows($query) == 1){
        setcookie('sansi[name]',$_POST['name'],time()+$_POST['time']);
        setcookie('sansi[pwd]',sha1(md5($_POST['pwd'])),time()+$_POST['time']);
        skip('登录成功!','index.php');
        exit();
    }else{
        skip('sorry,用户名或密码错误,请重新登录!','login.php');
        exit();
    }
}
?>
<div class="content">
    <div class="title">
        <h2>欢迎登录三思</h2>
    </div>
    <form method="post">
        <label>用户名:<input type="text" name="name" placeholder="请填写用户名/手机号/邮箱"><span></span></label>
        <label>密码:<input type="password" name="pwd" placeholder="请输入密码"><span></span></label>
        <label>验证码:<input type="text" name="vcode" placeholder="请输入下方的验证码"><span></span></label>
        <div style="clear:both;"></div>
        <img class="vcode" src="show_code.php">
        <lebel>自动登录:
        <select name="time">
            <option value="3600">1小时内</option>
            <option value="86400">24小时内</option>
            <option value="259200">3天内</option>
            <option value="604800">7天内</option>
        </select>
            <span>*公共电脑上请勿长期自动登录</span>
        </lebel>
        <input class="btn" type="submit" value="确定登录" name="submit">
    </form>
</div>
<?php include_once "footer.inc.php"; ?>