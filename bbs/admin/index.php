<?php
$title = '系统信息';
//var_dump($_SERVER);exit;
//var_dump(__FILE__);exit;
include_once 'skip.login.php';
if(!is_login()==true){
    skip('请先登录!','login.php');
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
if(isset($_COOKIE['sansi']['id']) && !empty($_COOKIE['sansi']['id'])){
    $sql = "select * from sansi_manage WHERE id={$_COOKIE['sansi']['id']}";
    $query = $link->query($sql);
    $rel = $query->fetch(PDO::FETCH_ASSOC);
}
$sql_father = "select count(*) from sansi_user_admin";
$query_f = $link->query($sql_father);
$father_num = $query_f->fetchColumn();

$sql_son = "select count(*) from sansi_son_admin";
$query_son = $link->query($sql_son);
$son_num = $query_son->fetchColumn();

$sql_c = "select count(*) from sansi_content";
$query_c = $link->query($sql_c);
$content_num = $query_c->fetchColumn();

$sql_r = "select count(*) from sansi_reply";
$query_r = $link->query($sql_r);
$reply_num = $query_r->fetchColumn();

$sql_m = "select count(*) from sansi_members";
$query_m = $link->query($sql_m);
$member_num = $query_m->fetchColumn();

$sql_manage = "select count(*) from sansi_manage";
$query_manage = $link->query($sql_manage);
$manage_num = $query_manage->fetchColumn();
$connt = mysqli_connect('localhost','root','123456');
include_once 'header.lnc.php';
?>
<div class="right">
    <div class="title">系统信息</div>
    <ul>
        <li>|-您好,<?php echo $rel['name']; ?></li>
        <li>|-所属角色:<?php if($rel['level']==0){echo '超级管理员';}else{echo '普通管理员';} ?></li>
        <li>|-创建时间:<?php echo $rel['create_time']; ?></li>
    </ul>
    <ul>
        <li>|-父板块(<?php echo $father_num; ?>)
            子版块(<?php echo $son_num; ?>)
            帖子(<?php echo $content_num; ?>)
            回复(<?php echo $reply_num;  ?>)
            会员(<?php echo $member_num; ?>)
            管理员(<?php echo $manage_num; ?>)</li>
    </ul>
    <ul>
        <li>|-服务器操作系统:<?php echo PHP_OS;?></li>
        <li>|-服务器软件:<?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
        <li>|-mysql版本:<?php echo mysqli_get_server_info($connt);?></li>
        <li>|-最大上传文件:<?php echo ini_get('upload_max_filesize'); ?></li>
        <li>|-内存限制:<?php echo ini_get('memory_limit'); ?></li>
        <li>|-<a href="phpinfo.php">PHP配置信息</a></li>
    </ul>
    <ul>
        <li>|-程序安装位置(绝对路径):<?php echo $_SERVER['DOCUMENT_ROOT'] ?></li>
        <li>|-程序在WBE根目录的位置(首页的URl地址):<?php echo dirname(dirname($_SERVER['SCRIPT_NAME'])).'/'; ?></li>
        <li>|-程序版本:bbs V1.0 <a href="">[查看最新版本]</a></li>
        <li>|-程序作者:陈文超</li>
        <li>|-网站:http://www.sansi.com</li>
    </ul>
</div>
<?php include_once 'dibu.inc.php';?>
