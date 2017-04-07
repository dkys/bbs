<?php
include_once "skip.login.php";
$title = "父板块列表";
if(!is_login()==true){
	skip('亲,您还没有登录哦!','login.php');
	exit();
}
$link = mysqli_connect('localhost','root','123456','sansi_admin');
if(isset($_POST['submit'])){
	foreach($_POST['sort'] as $key=>$value){
		if(!is_numeric($value)){
			skip('所提交参数不合法,排序只能为数字', 'father_admin.php');
			exit();
		}
	$sql = "update sansi_user_admin set sort={$value} where id= {$key}";
	$query1 = mysqli_query($link,$sql);
	}
	if(mysqli_affected_rows($link)){
		skip('恭喜!修改版块排序成功!', 'father_admin.php');
		exit();
	}else{
		skip('抱歉,版块排序修改失败,请返回重试!', 'father_admin.php');
		exit();
	}
}

include_once "header.lnc.php";

$query = "select * from sansi_user_admin";
$rsutl = mysqli_query($link,$query);

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
				<th>排序</th>
				<th>板块名称</th>
				<th>操作</th>
			</tr>
			<?php
			while($rel = mysqli_fetch_assoc($rsutl)){
//				delete.login.php?id={$rel['id']} /这是真实的删除url地址
				$name = $rel['name'];
				$url = urlencode("delete.login.php?id={$rel['id']}");//urlencode:对url进行编码
				$delete_url = "tiaozhuan.php?url=$url&&name=$name";
$html = <<<A
			<tr>
				<td><input type="text" name="sort[{$rel['id']}]" value="{$rel['sort']}"></td>
				<td>{$rel['name']}[id:{$rel['id']}]</td>
				<td><a href="">[访问]</a><a href="father_update.php?id={$rel['id']}">[编辑]</a><a href="$delete_url">[删除]</a></td>
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