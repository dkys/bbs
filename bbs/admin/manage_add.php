<?php
include_once "skip.login.php";
$title = "管理员添加页";
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
if(!$_COOKIE['sansi']['level']==0){
    skip('亲,您权限不足,请联系超级管理员提升权限!',$_SERVER['HTTP_REFERER']);
    exit();
}
if(isset($_POST['submit'])){
//    var_dump($_POST);exit();
    if(strlen($_POST['name'])>32){
        skip('管理员名称不等大于32个字符,请返回重试!','manage_add.php');
        exit();
    }
if(empty($_POST['name'])){
        skip('管理员名称不能为空,请返回重试!','manage_add.php');
        exit();
    }
    if(strlen($_POST['pw'])<6){
        skip('管理员密码不能小于6个字符,请返回重试!','manage_add.php');
        exit();
    }
    if(empty($_POST['pw'])){
        skip('管理员密码不能为空,请返回重试!','manage_add.php');
        exit();
    }
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
    $sql = "select * from sansi_manage WHERE name='{$_POST['name']}'";
    $query = $link->query($sql);
    $rel = $query->fetch(PDO::FETCH_ASSOC);
    if($_POST['name'] == $rel['name']){
        skip('这个名称已经存在了,请换一个!','manage_add.php');
        exit();
    }
if(!isset($_POST['level']) || $_POST['level']>2 || $_POST['level']<0){
    $_POST['level']=1;
}
    $insertsql = "insert INTO sansi_manage(name,pw,level) VALUES('{$_POST['name']}',md5('{$_POST['pw']}'),{$_POST['level']})";
    $queryin = $link->exec($insertsql);
    if($queryin==1){
        skip('管理员添加成功!','manage_add.php');
        exit();
    }else{
        skip('管理员添加失败,请返回重试!','manage_add.php');
        exit();
    }
}

include_once "header.lnc.php";







?>
    <div class="right">
        <div class="title">添加管理员</div>
        <form action="" method="post">
            <table class="list_b">
                <tr>
                    <td>管理员名称</td>
                    <td><input type="text" placeholder="管理员账号" name="name"></td>
                    <td>管理员名称不能为空,不能超过32个字符</td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input type="text" placeholder="密码" name="pw"></td>
                    <td>密码不能为空,最大不能小于6个字符</td>
                </tr>
                <tr>
                    <td>level</td>
                    <td>
                        <select name="level" style="width: 300px;">
                            <option value="1">==============普通管理员=============</option>
                            <option value="0">==============超级管理员=============</option>
                        </select>
                    </td>
                    <td>请选择等级,默认为普通管理员</td>
                </tr>
            </table>
            <input type="submit" name="submit" class="btn" value="添加">
        </form>
    </div>
<?php include_once 'dibu.inc.php';?>