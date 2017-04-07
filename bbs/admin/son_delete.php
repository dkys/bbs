<?php
include 'skip.login.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip("删除失败!返回请重试",'father_admin.php');
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
$query = "DELETE FROM `sansi_son_admin` WHERE id={$_GET['id']}";
$rsutl = mysqli_query($link,$query);
//var_dump($rsutl);
if($rsutl){
//    echo('ok恭喜你删除成功!');
    skip("ok恭喜你删除成功!",'son_list.php');
}else{
    skip("删除失败!返回请重试",'son_list.php');
}


?>