<?php
$title = "添加父板块页";
include_once 'skip.login.php';
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
include_once 'header.lnc.php';
?>
<div class="right">
    <div class="title">添加父板块</div>
    <form action="add_father.php" method="post">
    <table class="list_b">
        <tr>
            <td>板块名称</td>
            <td><input type="text" placeholder="请输入父板块名称" name="fatherName"></td>
            <td>父板块名称不能为空,最大不能超过50个字符</td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input type="text" placeholder="请输入一个数字" name="sort"></td>
            <td>输入数字即可</td>
        </tr>
    </table>
    <input type="submit" name="submit" class="btn" value="添加">
    </form>
</div>
<?php include_once 'dibu.inc.php'; ?>