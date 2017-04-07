<?php
include_once "skip.login.php";
$title = "子版块列表";
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
if(isset($_POST['submit'])){
    foreach($_POST['sort'] as $key=>$value){
        if(!is_numeric($value)){
            skip('输入不合法,排序号只能为数字','son_list.php');
            exit();
        }
        $sql1 = "update sansi_son_admin set sort={$value} where id={$key}";
        $query = mysqli_query($link,$sql1);
    }
    if(mysqli_affected_rows($link)){
        skip('恭喜,排序修改成功!','son_list.php');
        exit();
    }else{
        skip('对不起,修改失败!','son_list.php');
        exit();
    }
}

$sql = "select ssm.id,son_name,vip_id,ssm.sort,name from sansi_son_admin ssm,sansi_user_admin sfm where ssm.father_id=sfm.id order by sfm.id";
$rsutl = mysqli_query($link,$sql);
include_once "header.lnc.php";
?>
<div class="right">
    <div class="title">子版块列表</div>
    <form method="post">
    <table class="list_a">
        <tr>
            <th>排序</th>
            <th>板块名称</th>
            <th>所属父板块</th>
            <th>版主</th>
            <th>操作</th>
        </tr>
        <?php
        while($rel = mysqli_fetch_assoc($rsutl)){
//				son_delete.php?id={$rel['id']} /这是真实的删除url地址
            $name = $rel['son_name'];
            $url = urlencode("son_delete.php?id={$rel['id']}");//urlencode:对url进行编码
            $delete_url = "son_delete_tz.php?url=$url&&name=$name";
            $html = <<<A
			<tr>
				<td><input type="text" name="sort[{$rel['id']}]" value="{$rel['sort']}"></td>
				<td>{$rel['son_name']}[id:{$rel['id']}]</td>
				<td>{$rel['name']}</td>
				<td>{$rel['vip_id']}</td>
				<td><a href="">[访问]</a><a href="son_update.php?id={$rel['id']}">[编辑]</a><a href="{$delete_url}">[删除]</a></td>
			</tr>
A;
            echo $html;
        }

        ?>
    </table>
    <input type="submit" name="submit" class="btn" value="排序">
    </form>
</div>
<?php include_once "dibu.inc.php";?>
