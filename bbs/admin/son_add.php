<?php
$title = "添加子板块页";
include_once "skip.login.php";
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
//var_dump($_POST);

if(isset($_POST['sonName'])){
    if($_POST['father_id'] == 0){
        skip('必须选择一个所属父板块,请返回重试','son_add.php');
        exit();
    }
    if($_POST['sonName'] == "" || $_POST['intro'] == ""){
        skip('子版块名称和简介不能为空,请返回重试','son_add.php');
        exit();
    }
    if(!is_numeric($_POST['sort'])){
        skip('排序必须为数字,请返回重试','son_add.php');
        exit();
    }
    if(mb_strlen($_POST['sonName']) > 50){
        skip('板块名称不能大于50个字符,请重新填写','son_add.php');
        exit();
    }
    if(mb_strlen($_POST['intro']) > 50){
        skip('板块简介不能大于300个字符,请重新填写','son_add.php');
        exit();
    }
    $sql = "select * from sansi_son_admin where son_name='{$_POST['sonName']}'";
    $rel = mysqli_query($link,$sql);
//    $date = mysqli_fetch_assoc($rel);
//    var_dump($rel);
    if(mysqli_affected_rows($link) == 1){
        skip('板块名称已存在,请重新输入','son_add.php');
        exit();
    }
    $mysql = "insert into sansi_son_admin(father_id, son_name, intro, vip_id, sort) values({$_POST['father_id']},'{$_POST['sonName']}','{$_POST['intro']}',{$_POST['vip_id']},{$_POST['sort']})";
//    var_dump($mysql);
    $query1 = mysqli_query($link,$mysql);
    if(mysqli_affected_rows($link) == 1){//mysqli_affecthed_rows() /获取操作数据库影响了几行,操作成功返回1 /否则为null
        skip('恭喜你,添加子板块成功!','son_list.php');
    }else{
        skip('很抱歉,添加子板块失败!请返回重试','son_add.php');
    }
}
include_once "header.lnc.php";



?>
<div class="right">
    <div class="title">添加子板块</div>
    <form method="post">
        <table class="list_b">
            <tr>
                <td>所属父板块</td>
                <td>
                    <select name="father_id">
                        <option value="0">======请选择一个父板块======</option>
                        <?php
//                        $link = mysqli_connect('localhost','root','123456','sansi_admin');
                        $sql = "select * from sansi_user_admin";
                        $query = mysqli_query($link,$sql);
//                        var_dump($link);
                        while($date = mysqli_fetch_assoc($query)){
                          echo  "<option value='{$date['id']}'>{$date['name']}</option>";
                        }
                        ?>
                    </select>

                </td>
                <td>必须选择一个父板块</td>
            </tr>
            <tr>
                <td>版块名称</td>
                <td><input type="text" placeholder="请输入子板块名称" name="sonName"></td>
                <td>子板块名称不能为空,最大不能超过50个字符</td>
            </tr>
            <tr>
                <td>版块简介</td>
                <td><textarea rows="5" cols="40" name="intro"></textarea></td>
                <td>子板块名称简介,最大不能超过300个字符</td>
            </tr>
            <tr>
                <td>版主</td>
                <td>
                    <select name="vip_id">
                        <option value="0">====请选择一个会员作为版主====</option>
                    </select>
                </td>
                <td>你可以在这里选择一个会员做为版主</td>
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
