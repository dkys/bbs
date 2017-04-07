<?php
include 'skip.login.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip("删除失败!返回请重试",'father_admin.php');
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
$sql = "select * from sansi_son_admin where father_id={$_GET['id']}";
$rsl = mysqli_query($link,$sql);
//var_dump($_GET['id']);
//var_dump(mysqli_affected_rows($link));
if(mysqli_affected_rows($link) == 1){
    skip("请移所属除子版块后,再尝试删除",'father_admin.php');
    exit;
}
$query = "DELETE FROM `sansi_user_admin` WHERE id={$_GET['id']}";
$rsutl = mysqli_query($link,$query);
//var_dump($rsutl);
if(mysqli_affected_rows($link) ==1){
//    echo('ok恭喜你删除成功!');
    skip("ok恭喜你删除成功!",'father_admin.php');
}else{
    skip("删除失败!请返回请重试",'father_admin.php');
}
?>