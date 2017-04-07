<?php
$title = '帖子引用回复';
include_once 'skip.login.php';
if(!$memeber_id = is_login($link)){
    skip('请登录后再回复!','login.php');
    exit();
}
include_once 'header.inc.php';
if(!isset($_GET['contentid']) || !is_numeric($_GET['contentid'])){
    skip('贴子id不合法!','index.php');
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
$sql = "select * from sansi_content,sansi_members WHERE sansi_content.id={$_GET['contentid']} AND sansi_content.member_id=sansi_members.id";
$res = $link->query($sql);

foreach($res as $content){
}
if(empty($content)){
    skip('您访问的帖子不存在!','index.php');
    exit();
}
if(!isset($_GET['replayid']) || !is_numeric($_GET['replayid'])){
    skip('参数错误!','index.php');
    exit();
}

$resql = "select * from sansi_reply WHERE re_id={$_GET['replayid']}";
$requery = $link->query($resql);
foreach($requery as $rerel){
}

if(empty($rerel)){
    skip('您要使用的引用不存在,或者已经删除!','index.php');
    exit();
}

//获取当前是第几楼
$renum = "select count(*) from sansi_reply WHERE content_id={$_GET['contentid']} AND re_id <= {$_GET['replayid']}";
$query = $link->query($renum);
$numre = $query->fetchColumn();

if(isset($_POST['submit'])){
    if(strlen($_POST['recontent'])<=3){
        skip('回复内容不得少于3个字!',$_SERVER['REQUEST_URI']);
        exit();
    }
    $recontent = addslashes($_POST['recontent']);

    $sqlc = "insert into sansi_reply(content_id,quote_id,recontent,member_id) VALUES({$_GET['contentid']},{$_GET['replayid']},'{$recontent}',{$memeber_id})";
//    var_dump($sqlc);exit;
    $queryc = $link->exec($sqlc);
    if($queryc > 0){
        skip('回复成功!返回查看!',"content_show.php?contentid={$_GET['contentid']}");
        exit();
    }else{
        skip('回复失败!返回重试!',$_SERVER['REQUEST_URI']);
        exit();
    }
}

?>

<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;<span>回复帖子</span>
</div>
<div class="content">
    <span style="margin:10px 0 0 28px;">回复来自: <?php echo $content['name'];  ?> 发布的 <?php echo nl2br(htmlspecialchars($content['title'])); ?></span>
    <div style="width: 900px;margin: 0 auto;background: #ddd;">
        <p style="padding: 5px;">引用<?php echo $numre; ?>楼 发表的: <?php echo nl2br(htmlspecialchars($rerel['recontent'])); ?><br>
        http://sansi.php.com
        </p>
    </div>
    <form method="post">
        <textarea name="recontent" style="margin: 0 auto;" cols="126" rows="10" placeholder="请输入要回复的内容"></textarea>
        <input class="submit" name="submit" type="submit" value="回复">
    </form>
</div>


<?php include_once 'footer.inc.php'; ?>
