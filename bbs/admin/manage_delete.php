<?php
include_once 'skip.login.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip("删除失败!返回请重试",'manage.php');
}
if(!$_COOKIE['sansi']['level']==0){
    skip('亲,您权限不足,请联系超级管理员提升权限!','manage.php');
    exit();
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
$sql = "select * from sansi_manage where id={$_GET['id']}";
$rsl = mysqli_query($link,$sql);
//var_dump($_GET['id']);
//var_dump(mysqli_affected_rows($link));
if(mysqli_affected_rows($link) != 1){
    skip("该管理员不存在!",'manage.php');
    exit;
}
$query = "DELETE FROM sansi_manage WHERE id={$_GET['id']}";
$rsutl = mysqli_query($link,$query);
//var_dump($rsutl);
if(mysqli_affected_rows($link) ==1){
//    echo('ok恭喜你删除成功!');
    skip("删除成功!",'manage.php');
}else{
    skip("删除失败!请返回请重试",'manage.php');
}





?>