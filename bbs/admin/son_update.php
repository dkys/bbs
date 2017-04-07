<?php
include_once 'skip.login.php';
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
$title = "修改子版块";
include_once "header.lnc.php";
$link = mysqli_connect('localhost','root','123456','sansi_admin');
$sql = "select * from sansi_son_admin where id ={$_GET['id']}";
$query = mysqli_query($link,$sql);
$date = mysqli_fetch_assoc($query);
if($date){
}else {
    skip('您访问的页面不存在,请返回重试', 'son_list.php');
    exit();

}
if(isset($_POST['subimt'])){
    $sql_select = "select * from sansi_son_admin where son_name='{$_POST['sonName']}'";
    $rel = mysqli_query($link, $sql_select);
//var_dump(mysqli_affected_rows($link));
    if (mysqli_affected_rows($link) == 1) {
        skip('板块已存在,请重新输入', 'father_add.php');
        exit();
    }
    $link1 = mysqli_connect('localhost','root','123456','sansi_admin');
//    $sqli = "update sansi_user_admin set name='{$_POST['fatherName']}',sort={$_POST['sort']} where id={$_GET['id']}";
    $sqli = "update sansi_son_admin set father_id={$_POST['father_id']},son_name='{$_POST['sonName']}',intro='{$_POST['intro']}',sort={$_POST['sort']},vip_id={$_POST['vip_id']} where id={$_GET['id']}";
    $query2 = mysqli_query($link1,$sqli);
//    var_dump($query2);
    if(mysqli_affected_rows($link1) == 1){
        skip('恭喜你,子板块修改成功!','son_list.php');
        exit();
    }else{
        skip('对不起,子板块修改失败,请返回重试!','son_list.php');
        exit();
    }
}


?>
<div class="right">
    <div class="title">添加子板块 - <?php echo $date['son_name']; ?></div>
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
                        while($date1 = mysqli_fetch_assoc($query)){
                            if($date1['id'] == $date['father_id']){
                                echo  "<option selected='selected' value='{$date1['id']}'>{$date1['name']}</option>";
                            }else{
                                echo  "<option value='{$date1['id']}'>{$date1['name']}</option>";
                            }
                        }
                        ?>
                </td>
                <td>必须选择一个父板块</td>
            </tr>
            <tr>
                <td>版块名称</td>
                <td><input type="text" placeholder="请输入子板块名称" name="sonName" value="<?php echo $date['son_name']; ?>"></td>
                <td>子板块名称不能为空,最大不能超过50个字符</td>
            </tr>
            <tr>
                <td>版块简介</td>
                <td><textarea rows="5" cols="40" name="intro"><?php echo "{$date['intro']}"; ?></textarea></td>
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
                <td><input type="text" placeholder="请输入一个数字" name="sort" value="<?php echo $date['sort']; ?>"></td>
                <td>输入数字即可</td>
            </tr>
        </table>
        <input type="submit" name="subimt" class="btn" value="确定修改">
    </form>
</div>
<?php include "dibu.inc.php"; ?>
