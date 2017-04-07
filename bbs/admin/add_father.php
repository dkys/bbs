<?php
    include_once 'skip.login.php';
    //var_dump($_POST);
    if(isset($_POST['submit'])){
    if($_POST['fatherName'] == "" || !isset($_POST['fatherName'])){
        skip('父版块名称不能为空,请返回重新填写','father_add.php');
        exit();
    }if(!is_numeric($_POST['sort'])){//is_numeric() /判断变量是否为数字
        skip('排序只能为数字,请返回重新填写','father_add.php');
        exit();
    }elseif(mb_strlen($_POST['fatherName']) > 30){
        skip('板块名称不能大于30个字符,请重新填写','father_add.php');
        exit();
    }
    }
    $link = mysqli_connect('localhost','root','123456','sansi_admin');
    $sql_select = "select * from sansi_user_admin where name='{$_POST['fatherName']}'";
    $rel = mysqli_query($link,$sql_select);
//var_dump(mysqli_affected_rows($link));
    if(mysqli_affected_rows($link) == 1){
        skip('板块已存在,请重新输入','father_add.php');
        exit();
    }

//    $_POST = curl_escape($link,$_POST);
    $sql = "insert into sansi_user_admin(name,sort) values('{$_POST['fatherName']}',{$_POST['sort']})";
    $query = mysqli_query($link,$sql);


//    var_dump(mysqli_affected_rows($link));
//    exit;
    if(mysqli_affected_rows($link) == 1){//mysqli_affecthed_rows() /获取操作数据库影响了几行,操作成功返回1 /否则为null
        skip('恭喜你,添加父板块成功!','father_admin.php');
    }else{
        skip('很抱歉,添加父板块失败!请返回重试','father_add.php');
    }
?>