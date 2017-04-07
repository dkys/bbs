<?php
include_once 'skip.login.php';
$title = "父板块修改";
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
include_once "header.lnc.php";
//if($_GET['id'] == ''){
//    skip('数据错误,请返回重试','father_admin.php');
//    exit();
//}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
$sql = "select * from sansi_user_admin where id={$_GET['id']}";
$query = mysqli_query($link,$sql);
$date = mysqli_fetch_assoc($query);
if($date){
}else{
    skip('您访问的页面不存在,请返回重试','father_admin.php');
    exit();
}
//var_dump($_POST);
if(isset($_POST['submit'])) {
    $sql_select = "select * from sansi_user_admin where name='{$_POST['fatherName']}'";
    $rel = mysqli_query($link, $sql_select);
//var_dump(mysqli_affected_rows($link));
    if (mysqli_affected_rows($link) == 1) {
        skip('板块已存在,请重新输入', 'father_add.php');
        exit();
    }
        $link1 = mysqli_connect('localhost', 'root', '123456', 'sansi_admin');
//    $sqli = "update sansi_user_admin set name='{$_POST['fatherName']}',sort={$_POST['sort']} where id={$_GET['id']}";
        $sqli = "update sansi_user_admin set name='{$_POST['fatherName']}',sort={$_POST['sort']} where id={$_GET['id']}";
        $query2 = mysqli_query($link, $sqli);
//    var_dump($query2);
        if (mysqli_affected_rows($link1) == 1) {
            skip('恭喜你,父板块修改成功!', 'father_admin.php');
            exit();
        } else {
            skip('对不起,父板块修改失败,请返回重试!', 'father_admin.php');
            exit();
        }
    }

//var_dump($_POST);
?>
<div class="right">
    <div class="title">修改父板块-<?php echo "{$date['name']}"; ?></div>
    <form method="post">
        <table class="list_b">
            <tr>
                <td>板块名称</td>
                <td><input type="text" placeholder="请输入父板块名称" name="fatherName" value="<?php echo "{$date['name']}"; ?>"></td>
                <td>父板块名称不能为空,最大不能超过50个字符</td>
            </tr>
            <tr>
                <td>排序</td>
                <td><input type="text" placeholder="请输入一个数字" name="sort" value="<?php echo "{$date['sort']}"; ?>"></td>
                <td>输入数字即可</td>
            </tr>
        </table>
        <input type="submit" name="submit" class="btn" value="确定修改">
    </form>

</div>

<?php include_once 'dibu.inc.php'; ?>
