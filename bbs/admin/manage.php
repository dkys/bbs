<?php
$title = '管理员列表';
include_once 'skip.login.php';
if(!is_login()==true){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
$sql = "select * from sansi_manage";
$query = $link->query($sql);

include_once 'header.lnc.php';
?>
<div class="right">
    <div class="title">功能说明</div>
    <ul>
        <li>1.板块暂未开放</li>
        <li>2.板块暂未开放</li>
        <li>3.板块暂未开放</li>
    </ul>
    <form method="post">
        <table class="list_a">
            <tr>
                <th>管理员名称</th>
                <th>等级</th>
                <th>创建日期</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($query as $rel){
                if($rel['level']==0){
                    $rel['level']='超级管理员';
                }else{
                    $rel['level']='普通管理员';
                }
//				delete.login.php?id={$rel['id']} /这是真实的删除url地址
                $name = $rel['name'];
                $url = urlencode("manage_delete.php?id={$rel['id']}");//urlencode:对url进行编码
                $delete_url = "manage_tiaozhuan.php?url=$url&name=$name";
                $html = <<<A
			<tr>
				<td>{$rel['name']} id:[{$rel['id']}]</td>
				<td>{$rel['level']}</td>
				<td>{$rel['create_time']}</td>
				<td><a href="father_update.php?id={$rel['id']}">[编辑]</a><a href="$delete_url">[删除]</a></td>
			</tr>
A;
                echo $html;
            }
            ?>
        </table>
        <input type="submit" class="btn" name="submit" value="排序">
    </form>
</div>

<?php include_once 'dibu.inc.php'; ?>
